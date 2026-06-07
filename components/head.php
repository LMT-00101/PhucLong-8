<!DOCTYPE html>
<html lang="zxx">

<head>
    <meta charset="UTF-8">
    <meta name="description" content="Ashion Template">
    <meta name="keywords" content="Ashion, unica, creative, html">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Coffe - Trà Sữa - Trà trái cây</title>
    <?php
    if (!defined('BASE_PATH')) {
        require_once __DIR__ . '/../config/paths.php';
    }
    ?>
    <base href="<?= htmlspecialchars(BASE_PATH, ENT_QUOTES, 'UTF-8') ?>">
    <script>window.APP_BASE_PATH = <?= json_encode(BASE_PATH, JSON_UNESCAPED_SLASHES) ?>;</script>

    <!-- Bootstrap + theme (local) -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css" type="text/css">
    <link rel="stylesheet" href="public/css/style.css" type="text/css">

    <!-- Google Font -->
    <link href="https://fonts.googleapis.com/css2?family=Cookie&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;500;600;700;800;900&display=swap"
        rel="stylesheet">

    <!-- Css Styles -->
    <link rel="stylesheet" href="public/css/font-awesome.min.css" type="text/css">
    <link rel="stylesheet" href="public/css/elegant-icons.css" type="text/css">
    <link rel="stylesheet" href="public/css/jquery-ui.min.css" type="text/css">
    <link rel="stylesheet" href="public/css/magnific-popup.css" type="text/css">
    <link rel="stylesheet" href="public/css/owl.carousel.min.css" type="text/css">
    <link rel="stylesheet" href="public/css/slicknav.min.css" type="text/css">
    <link rel="stylesheet" href="public/css/custom.css" type="text/css">

    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.2/css/all.css"
        integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr" crossorigin="anonymous" />

    <!-- Include Toastr CSS and JS files -->
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <script>
    if (!window.jQuery) {
        document.write('<script src="public/js/jquery-3.3.1.min.js"><\/script>');
    }
    </script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
    <!-- Include Toastr CSS and JS files end -->
</head>
