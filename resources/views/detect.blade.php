<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>Deteksi Objek AI</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body class="bg-light">
    <div class="container py-5" style="max-width:700px">
        <div class="card shadow-sm border-0">
            <div class="card-body p-4">
                <h3 class="text-center mb-4">
                    Deteksi Objek Laravel 13 AI
                </h3>
                <form action="/detect" method="POST" enctype="multipart/form-data">
                    @csrf
                    <input type="file" name="image" class="form-control mb-3" required>
                    <button class="btn btn-primary w-100">
                        Deteksi Sekarang
                    </button>
                </form>
                @isset($objects)
                    <hr class="my-4">
                    <img src="{{ $detected_image }}" class="img-fluid rounded mb-3" alt="Hasil Deteksi">
                    <h5>Objek Terdeteksi</h5>
                    <ul class="mb-0">
                        @foreach ($objects as $obj)
                            <li>{{ $obj }}</li>
                        @endforeach
                    </ul>
                @endisset
            </div>
        </div>
    </div>
</body>

</html>