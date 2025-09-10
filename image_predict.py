import sys
import json
import torch
from torchvision import transforms, models
from PIL import Image
import torch.nn as nn

# === Ensure model file matches ===
model = models.resnet18(weights=None)
model.fc = nn.Linear(model.fc.in_features, 2)

# === Correct model filename and path ===
model.load_state_dict(torch.load("deepfake_model_images.pt", map_location=torch.device("cpu")))
model.eval()

# === Match training transforms ===
transform = transforms.Compose([
    transforms.Resize((224, 224)),
    transforms.ToTensor(),
    transforms.Normalize(mean=[0.5, 0.5, 0.5], std=[0.5, 0.5, 0.5])
])

# === Class label mapping ===
idx_to_label = {1: 'real', 0: 'fake'}  # Update based on training

# === Read image ===
try:
    image_path = sys.argv[1]
    image = Image.open(image_path).convert("RGB")
    image_tensor = transform(image).unsqueeze(0)

    with torch.no_grad():
        output = model(image_tensor)
        probs = torch.softmax(output, dim=1)
        confidence, predicted = torch.max(probs, dim=1)

    label = idx_to_label[predicted.item()]
    print(json.dumps({
        "status": "success",
        "result": label,
        "confidence": round(confidence.item()*100, 2)
    }))

except Exception as e:
    print(json.dumps({
        "status": "error",
        "message": str(e)
    }))
