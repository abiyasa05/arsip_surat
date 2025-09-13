<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Arsip Surat</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

    <style>
        html, body {
            height: 100%;
            margin: 0;
            padding: 0;
        }

        body {
            background-color: #f8f9fa;
        }

        .main-wrapper {
            display: flex;
            flex-direction: column;
            min-height: 100vh;
            width: 100%;
        }

        .content-wrapper {
            flex: 1;
            display: flex;
            width: 100%;
        }

        /* --- Tambahan untuk PDF --- */
        .pdf-wrapper {
            height: 85vh;
            min-height: 400px;
            overflow: auto;
        }

        .pdf-frame {
            border: none;
            width: 100%;
            max-width: 100%;
            height: 100%;
            min-height: 400px;
            display: block;
        }

        /* Responsif biar tetap bagus di HP */
        @media (max-width: 768px) {
            .pdf-wrapper {
                height: 70vh;
            }
        }
    </style>
</head>
<body>
    <div class="main-wrapper">
        <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
            <a class="navbar-brand ms-3" href="{{ route('surat.index') }}">Arsip Surat Karangduren</a>
        </nav>
        <div class="content-wrapper">
            @yield('content')
        </div>
    </div>
</body>
</html>