<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <!-- Bootstrap 4 -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css"
        integrity="sha384-xOolHFLEh07PJGoPkLv1IbcEPTNtaed2xpHsD9ESMhqIYd0nLMwNLD69Npy4HI+N" crossorigin="anonymous">

    <!-- Fontawesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.1/css/all.min.css"
        integrity="sha512-5Hs3dF2AEPkpNAR7UiOHba+lRSJNeM2ECkwxUIxC1Q/FLycGTbNapWXB4tP889k5T5Ju8fs4b1P5z/iB4nMfSQ=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />

    <title>CMS</title>

    <style>
    .nav-item.active {
        border-bottom: 2px solid black;
    }

    .divider {
        border-top: 5px solid black;
        /* Ketebalan dan warna garis */
        margin: 20px 0;
        /* Jarak vertikal antar container */
    }

    .footer {
        background-color: #222;
        color: #f0f0f0;
        padding: 40px 20px;
        font-family: Arial, sans-serif;
    }

    .footer-container {
        display: flex;
        flex-wrap: wrap;
        justify-content: space-between;
        gap: 20px;
        max-width: 1200px;
        margin: 0 auto;
    }

    .footer-section {
        flex: 1 1 300px;
    }

    .footer-section h2,
    .footer-section h3 {
        color: #fff;
        margin-bottom: 15px;
    }

    .footer-section p,
    .footer-section a {
        color: #ddd;
        text-decoration: none;
        font-size: 14px;
    }

    .footer-section a:hover {
        color: #ff9800;
    }

    .social-icons {
        margin-top: 15px;
    }

    .social-icon {
        color: #f0f0f0;
        font-size: 20px;
        margin-right: 10px;
        transition: color 0.3s;
    }

    .social-icon:hover {
        color: #ff9800;
    }

    .links ul {
        list-style: none;
        padding: 0;
    }

    .links ul li {
        margin-bottom: 10px;
    }

    .footer-bottom {
        text-align: center;
        margin-top: 20px;
        font-size: 14px;
        border-top: 1px solid #444;
        padding-top: 10px;
        color: #888;
    }

    .footer-bottom p {
        margin: 0;
    }

    @media (max-width: 768px) {
        .footer-container {
            flex-direction: column;
            align-items: center;
        }

        .footer-section {
            text-align: center;
        }

        .social-icons {
            justify-content: center;
        }
    }
    </style>

</head>

<body class="hold-transition layout-top-nav">
    <div class="wrapper">