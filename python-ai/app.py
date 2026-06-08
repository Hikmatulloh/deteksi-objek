from flask import Flask, request, jsonify
from ultralytics import YOLO

app = Flask(__name__)
model = YOLO('yolov8n.pt')

@app.route('/detect', methods=['POST'])
def detect():
    file = request.files['image']
    path = 'temp.jpg'
    file.save(path)
    results = model(path)
    objects = []

    for r in results:
        names = r.names

        for c in r.boxes.cls:
            objects.append(names[int(c)])

    return jsonify({
        'objects': list(set(objects))
    })

app.run(port=5000)
