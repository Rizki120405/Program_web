<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo isset($title) ? $title : 'Sistem Penggajian Karyawan'; ?></title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link rel="stylesheet" href="../../../public/css/style.css">
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-primary">
        <div class="container">
            <a class="navbar-brand" href="#">Sistem Penggajian</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav me-auto">
                    <?php if (isset($_SESSION['user_id'])): ?>
                        <?php if ($_SESSION['role'] == 'admin'): ?>
                            <li class="nav-item">
                                <a class="nav-link" href="?page=dashboard">Dashboard</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="?page=karyawan">Karyawan</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="?page=absensi">Absensi</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="?page=penggajian">Penggajian</a>
                            </li>
                        <?php else: ?>
                            <li class="nav-item">
                                <a class="nav-link" href="?page=dashboard">Dashboard</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="?page=profile">Profil</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="?page=penggajian">Gaji Saya</a>
                            </li>
                        <?php endif; ?>
                    <?php endif; ?>
                </ul>
                <?php if (isset($_SESSION['user_id'])): ?>
                    <ul class="navbar-nav">
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown">
                                <i class="fas fa-user"></i> <?php echo $_SESSION['username']; ?>
                            </a>
                            <ul class="dropdown-menu">
                                <li><a class="dropdown-item" href="?page=profile">Profil</a></li>
                                <li><hr class="dropdown-divider"></li>
                                <li><a class="dropdown-item" href="../app/controllers/AuthController.php?action=logout">Logout</a></li>
                            </ul>
                        </li>
                    </ul>
                <?php endif; ?>
            </div>
        </div>
    </nav>

    <div class="container mt-4">
        <?php if (isset($message)): ?>
            <div class="alert alert-<?php echo $message['type']; ?> alert-dismissible fade show" role="alert">
                <?php echo $message['text']; ?>
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        <?php endif; ?>

        <?php echo $content; ?>
    </div>

    <footer class="bg-light text-center text-muted py-3 mt-5">
        <div class="container">
            <p>&copy; 2025 Sistem Penggajian Karyawan. All rights reserved.</p>
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="../../../public/js/script.js"></script>
</body>
</html>