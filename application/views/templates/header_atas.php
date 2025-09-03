<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title><?= $judul ?></title>
    <link rel="icon" type="image/x-icon" href="<?= base_url() ?>assets/img/favicon2.ico" />

    <link href="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
    <!-- Font Awesome icons (free version)-->
    <script src="https://use.fontawesome.com/releases/v5.15.1/js/all.js" crossorigin="anonymous"></script>
    <!-- Google fonts-->
    <link href="https://fonts.googleapis.com/css?family=Montserrat:400,700" rel="stylesheet" type="text/css" />
    <link href="https://fonts.googleapis.com/css?family=Droid+Serif:400,700,400italic,700italic" rel="stylesheet" type="text/css" />
    <link href="https://fonts.googleapis.com/css?family=Roboto+Slab:400,100,300,700" rel="stylesheet" type="text/css" />
    <!-- Theme style -->
    <link rel="stylesheet" href="<?= base_url(); ?>assets/dist/css/adminlte.min.css">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.2/css/bootstrap.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.24/css/dataTables.bootstrap4.min.css">

    <!-- Core theme CSS (includes Bootstrap)-->
    <link href="<?= base_url() ?>css/styles.css" rel="stylesheet" />
    <link href="<?= base_url() ?>css/style.css" rel="stylesheet" />
    <link href="<?= base_url() ?>css/owl.carousel.min.css" rel="stylesheet" />

    <link href="<?= base_url() ?>css/style2.css" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@fancyapps/ui@4.0/dist/fancybox.css" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@fancyapps/ui@4.0/dist/fancybox.css" />

    <style>
        .box {
            margin: 4px;
            padding: 3px;
            border-radius: 2%;
            overflow: hidden;
        }

        .box img {
            width: 180px;
            height: 220px;
            border-radius: 5%;
            display: block;
        }

        .overlay {
            position: absolute;
            border-radius: 2%;
            bottom: 0;
            right: 0;
            left: 0;
            width: 100%;
            overflow: hidden;
            background-color: #097509;
            height: 0;
            transition: .5s ease;
        }

        .box:hover {
            background-color: #097509;
        }

        .box:hover .overlay {
            height: 100%;
        }

        .text-primary {
            position: absolute;
            top: 50%;
            left: 50%;
            -webkit-transform: translate(-50%, -50%);
            -ms-transform: translate(-50%, -50%);
            transform: translate(-50%, -50%);
            text-align: center;
            color: yellow;
            opacity: 1;
        }

        .link-box {
            width: 80%;
            height: auto;
            padding: 2px;
            background-color: yellow;
            position: relative;
            bottom: 0;
            top: 83%;
            left: 50%;
            justify-content: center;
            -webkit-transform: translate(-50%, -50%);
            -ms-transform: translate(-50%, -50%);
            transform: translate(-50%, -50%);
            margin-top: 2px;
        }

        .link-box:hover {
            background-color: yellowgreen;
        }

        .link-box .link:hover {
            cursor: pointer;
        }

        .btn-link {
            border: 1px solid #F5F5F5;
            height: 35px;
            width: 100%;
            margin-right: 10px;
            border-radius: 10px;
            color: black;
            padding: 5px;
            margin-bottom: 7px;
        }

        .search-category::first-letter {
            text-transform: capitalize;
        }

        .link-active {
            background-color: #097509;
            color: white;
            text-decoration: none;
        }

        .btn-link p {
            font-size: 14px;
            font-weight: 500;
            text-decoration: none;
        }

        .btn-link:hover {
            background-color: #097509;
            text-decoration: none;
            color: white
        }

        .title {
            font-size: 18px;
            font-weight: 600
        }

        .title::first-letter {
            text-transform: capitalize;
        }

        .content-section {
            width: 100%;
            min-height: 400px;
            max-height: 100%;
        }
    </style>

</head>

<div style="background-color: #097509; padding: 5px; top: 0;">
    <div class="container-fluid">
        <!--Logo-->
        <div class="navbar-header">
            <a href="#" class="navbar-brand logo">
                <h2 class="text-white"><img src="<?= base_url() ?>assets/img/logo2.png" alt="logo" style="width: 50px; height: 50px;"> Portal Satu Data Pertanian</h2>
            </a>
        </div>
        <!--Logo/-->
        <nav>
            <ul class="nav navbar-nav navbar-right">
                <li class="active"><a href="<?= base_url() ?>home" class="text-white">Kembali ke Home</a></li>
            </ul>
        </nav>
    </div>
</div>