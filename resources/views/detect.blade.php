<!DOCTYPE html>
<html>

<head>
    <title>Deteksi Objek AI</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>
    <div class="container py-5">
        <h2 class="mb-4">Deteksi Objek AI Laravel 13</h2>
        <form action="/detect" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="mb-3">
                <input type="file" name="image" class="form-control">
            </div>
            <button class="btn btn-primary">Deteksi Objek</button>
        </form>
        @isset($objects)
            <div class="mt-5">
                <h4>Hasil Deteksi:</h4>
                <ul>
                    @foreach($objects as $obj)
                        <li>{{ $obj }}</li>
                    @endforeach
                </ul>
            </div>
        @endisset
    </div>
</body>

</html>