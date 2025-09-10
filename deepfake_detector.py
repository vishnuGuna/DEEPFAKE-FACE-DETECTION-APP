import os
import sys
import json
import warnings
import torch
import torch.nn as nn
import cv2
from torchvision import transforms, models

# Suppress unnecessary warnings/logs
os.environ['TF_CPP_MIN_LOG_LEVEL'] = '3'
warnings.filterwarnings("ignore")

# ----------------------------------
# ✅ Load the same model you trained (e.g., ResNet18 with modified final layer)
# ----------------------------------
try:
    model = models.resnet18(pretrained=False)
    model.fc = nn.Linear(model.fc.in_features, 2)  # 2 classes: real (0), fake (1)
    model.load_state_dict(torch.load("deepfake_model.pt", map_location="cpu"))
    model.eval()
except Exception as e:
    print(json.dumps({"status": "error", "message": f"Failed to load model: {str(e)}"}))
    sys.exit(1)

# ----------------------------------
# ✅ Define preprocessing transform (must match training)
# ----------------------------------
transform = transforms.Compose([
    transforms.ToPILImage(),
    transforms.Resize((224, 224)),
    transforms.ToTensor(),
    transforms.Normalize([0.5] * 3, [0.5] * 3)
])

# ----------------------------------
# ✅ Main function to predict deepfake from video
# ----------------------------------
def predict_deepfake(video_path, frame_interval=20):
    cap = cv2.VideoCapture(video_path)
    if not cap.isOpened():
        return {"status": "error", "message": "Cannot open video"}

    fake_votes = 0
    real_votes = 0
    total_frames = 0
    frame_number = 0

    while True:
        ret, frame = cap.read()
        if not ret:
            break

        if frame_number % frame_interval == 0:
            try:
                frame = cv2.cvtColor(frame, cv2.COLOR_BGR2RGB)  # Convert BGR to RGB
                img = transform(frame).unsqueeze(0)  # Add batch dimension

                with torch.no_grad():
                    output = model(img)
                    prediction = torch.argmax(output, dim=1).item()

                    if prediction == 1:
                        fake_votes += 1
                    else:
                        real_votes += 1

                    total_frames += 1
            except Exception:
                pass  # Skip corrupted/bad frames

        frame_number += 1

    cap.release()

    if total_frames == 0:
        return {"status": "error", "message": "No frames processed."}

    result = "fake" if fake_votes > real_votes else "real"
    fake_percentage = (fake_votes / total_frames) * 100

    return {
        "status": "success",
        "result": result,
        "fake_percentage": round(100-fake_percentage, 2),
        "frames_checked": total_frames
    }

# ----------------------------------
# ✅ CLI usage for integration with `detect_deepfake.py`
# ----------------------------------
if __name__ == "__main__":
    if len(sys.argv) < 2:
        print(json.dumps({"status": "error", "message": "Usage: python deepfake_detector.py <video_path>"}))
        sys.exit(1)

    video_path = sys.argv[1]
    try:
        result = predict_deepfake(video_path)
        print(json.dumps(result))
    except Exception as e:
        print(json.dumps({"status": "error", "message": str(e)}))
        sys.exit(1)
