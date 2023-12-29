<!-- resources/views/layouts/app.blade.php -->

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pelayanan BAAK</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Tambahkan stylesheet atau CSS kustom di sini -->
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
</head>
<body>
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-3">
                <!-- Sidebar -->
                <div id="sidebar">
                    <!-- Menu -->
                    <ul class="list-group">
                        <li class="list-group-item"><a href="#">Menu 1</a></li>
                        <li class="list-group-item"><a href="#">Menu 2</a></li>
                        <!-- Tambahkan menu lainnya sesuai kebutuhan -->
                        <!-- Menu untuk username -->
                        <li class="list-group-item username-menu">
                            <a href="#">Profile</a>
                            <a href="#">Settings</a>
                            <a href="#">Logout</a>
                        </li>
                    </ul>
                </div>
            </div>
            <div class="col-md-9">
                <!-- Content -->
                <div id="content">
                    @yield('content')
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap JavaScript -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <!-- Tambahkan script JavaScript di sini jika diperlukan -->
    <script src="{{ asset('js/script.js') }}"></script>
</body>
</html>
