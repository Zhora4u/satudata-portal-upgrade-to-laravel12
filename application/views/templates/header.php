<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title><?= $judul; ?></title>
    <link rel="icon" type="image/x-icon" href="<?= base_url() ?>assets/img/favicon2.ico" />

    <link href="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">

    <!------ Include the above in your HEAD tag ---------->

    <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/fancybox/2.1.5/jquery.fancybox.min.css" media="screen">

    <!-- Popper -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>

    <!-- Font Awesome icons (free version)-->
    <script src="https://use.fontawesome.com/releases/v5.15.1/js/all.js" crossorigin="anonymous"></script>
    <!-- Google fonts-->
    <link href="https://fonts.googleapis.com/css?family=Montserrat:400,700" rel="stylesheet" type="text/css" />
    <link href="https://fonts.googleapis.com/css?family=Droid+Serif:400,700,400italic,700italic" rel="stylesheet" type="text/css" />
    <link href="https://fonts.googleapis.com/css?family=Roboto+Slab:400,100,300,700" rel="stylesheet" type="text/css" />
    <!-- Theme style -->
    <link rel="stylesheet" href="<?= base_url(); ?>assets/dist/css/adminlte.min.css">
    <!-- Core theme CSS (includes Bootstrap)-->
    <link href="<?= base_url() ?>css/styles.css" rel="stylesheet" />

    <!-- Bootstrap core JS-->

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js"></script>
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

        .act-btn {
            background: green;
            display: block;
            width: 55px;
            height: 55px;
            line-height: 55px;
            text-align: center;
            align-items: center;
            color: white;
            font-size: 30px;
            font-weight: bold;
            border-radius: 50%;
            -webkit-border-radius: 50%;
            text-decoration: none;
            transition: ease all 0.3s;
            position: fixed;
            right: 30px;
            bottom: 35px;
            z-index: 1;
        }

        .search-icon {
            color: white;
        }

        .search-icon:hover {
            color: yellow;
        }

        .act-btn:hover {
            background: #5b9411;
            border: solid green 1px;
        }

        .MultiCarousel {
            float: left;
            overflow: hidden;
            padding: 5px;
            width: 100%;
            position: relative;
        }

        .MultiCarousel .MultiCarousel-inner {
            transition: 1s ease all;
            float: left;
        }

        .MultiCarousel .MultiCarousel-inner .item {
            float: left;
        }

        .MultiCarousel .MultiCarousel-inner .item>div {
            text-align: center;
            padding: 10px;
            margin: 10px;
            color: #666;
            width: 200px;
        }

        .MultiCarousel .leftLst,
        .MultiCarousel .rightLst {
            position: absolute;
            border-radius: 50%;
            top: calc(50% - 20px);
        }

        .MultiCarousel .leftLst {
            left: 0;
        }

        .MultiCarousel .rightLst {
            right: 0;
        }

        .MultiCarousel .leftLst.over,
        .MultiCarousel .rightLst.over {
            pointer-events: none;
            background: #ccc;
        }

        .pad15 img {
            height: 240px;
            width: 180px;
        }

        .pad15 a {
            font-size: 15px;
            color: black;
        }
    </style>

</head>

<body class="loading" id="page-top">
    <!-- Navigation-->
    <nav class="navbar navbar-expand-lg navbar-dark fixed-top d-flex" id="mainNav">
        <div class="container justify-content-center align-items-center">
            <a class="navbar-brand js-scroll-trigger" href="#page-top"><img src="<?= base_url() ?>assets/img/logo.png" alt="" /></a>
            <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
                Menu
                <i class="fas fa-bars ml-1"></i>
            </button>
            <div class="collapse navbar-collapse" id="navbarResponsive">
                <ul class="navbar-nav text-uppercase ml-auto">
                    <li class="nav-item"><a class="nav-link js-scroll-trigger" href="#page-top">Beranda</a></li>

                    <li class="nav-item dropdown open"><a class="nav-link dropdown-toggle js-scroll-trigger" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" href="">Data</a>

                        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                            <a class="dropdown-item portfolio-link" href="<?= base_url() ?>datasets">Statistik</a>
                            <a class="dropdown-item js-scroll-trigger" href="#services">Geospasial</a>
                        </div>
                    </li>

                    <li class="nav-item"><a class="nav-link js-scroll-trigger" href="#portfolio">Infografis</a></li>
                    <li class="nav-item"><a class="nav-link js-scroll-trigger" href="<?= base_url(); ?>datasets/publikasi">Publikasi</a></li>
                    <li class="nav-item"><a class="nav-link js-scroll-trigger" href="<?= base_url(); ?>datasets/news">Berita</a></li>

                    <li class="nav-item dropdown open"><a class="nav-link dropdown-toggle js-scroll-trigger" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" href="#">Galeri</a>
                        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                            <a class="dropdown-item js-scroll-trigger" href="#galleryfoto">Foto</a>
                            <a class="dropdown-item js-scroll-trigger" href="#galleryvideo">Video</a>
                        </div>
                    </li>

                    <li class="nav-item"><a href="http://simpeldatin.setjen.pertanian.go.id/permintaan_data.php" class="nav-link" target="blank">Permohonan Data</a></li>

                    <li class="nav-item"><a class="nav-link js-scroll-trigger" href="#about">Tentang Kami</a></li>
                    <li class="nav-item dropdown open"><a class="nav-link dropdown-toggle js-scroll-trigger" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" href="#">Link Lainnya</a>

                        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                            <a class="dropdown-item js-scroll-trigger" target="blank" href="https://data.go.id/">Satu Data Indonesia</a>
                            <a class="dropdown-item js-scroll-trigger" target="blank" href="https://www.pertanian.go.id/">Kementerian Pertanian</a>
                            <a class="dropdown-item js-scroll-trigger" target="blank" href="https://api.pertanian.go.id/portal">Portal API</a>
                        </div>
                    </li>
                </ul>
            </div>
        </div>
    </nav>