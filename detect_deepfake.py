import os
os.environ['TF_CPP_MIN_LOG_LEVEL'] = '3'

import warnings
warnings.filterwarnings("ignore")

import sys
import json
from deepfake_detector import predict_deepfake  # You must define this separately

if __name__ == "__main__":
    if len(sys.argv) < 2:
        print(json.dumps({"status": "error", "message": "Usage: python detect_deepfake.py <video_path>"}))
        sys.exit(1)

    video_path = sys.argv[1]

    try:
        result = predict_deepfake(video_path)

        # Ensure result is JSON serializable
        result_json = {
            "status": "success",
            "result": result.get("result", "unknown"),
            "fake_percentage": float(result.get("fake_percentage", 0.0))
        }

        print(json.dumps(result_json))
    except Exception as e:
        print(json.dumps({"status": "error", "message": str(e)}))
        sys.exit(1)
