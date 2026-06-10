from flask import Flask, request, jsonify
from ultralytics import YOLO
from flask import send_file # Digunakan untuk mengirim file gambar ke browser
import cv2 # OpenCV digunakan untuk menyimpan gambar hasil deteksi
import os # Digunakan untuk operasi file dan folder
import uuid # Digunakan untuk membuat nama file unik

app = Flask(__name__)
model = YOLO('yolov8n.pt') 
UPLOAD_FOLDER = 'results'
if not os.path.exists(UPLOAD_FOLDER):
    os.makedirs(UPLOAD_FOLDER)

@app.route('/detect', methods=['POST']) # Endpoint API untuk proses deteksi objek
def detect():
    file = request.files['image']
    filename = str(uuid.uuid4()) + ".jpg" # Membuat nama file unik agar tidak tertimpa
    image_path = os.path.join(UPLOAD_FOLDER, filename) # Menentukan lokasi penyimpanan gambar
    file.save(image_path)
    results = model(image_path)
    objects = [] # Menyimpan daftar nama objek yang ditemukan
    for r in results: # Loop setiap hasil deteksi
        names = r.names
        for c in r.boxes.cls: # Mengambil class yang terdeteksi
            objects.append(names[int(c)])
    # gambar dengan bounding box
    annotated_frame = results[0].plot()
    output_file = os.path.join(
        UPLOAD_FOLDER,
        "detected_" + filename
    )
    cv2.imwrite(output_file, annotated_frame)
    return jsonify({
        "objects": list(set(objects)),
        "image": f"http://127.0.0.1:5000/image/detected_{filename}"
    })

@app.route('/image/<filename>') # Endpoint untuk menampilkan gambar hasil deteksi
def get_image(filename): 
    return send_file(
        os.path.join('results', filename),
        mimetype='image/jpeg'
    )
app.run(port=5000)