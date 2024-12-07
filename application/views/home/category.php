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

    <title>NEWS</title>

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

        <header class="bg-secondary py-4">
            <div class="container d-flex justify-content-between align-items-center">
                <div class="d-flex align-items-center">
                    <input type="text" placeholder="Search" class="form-control rounded-pill">
                </div>
                <div class="text-center">
                    <h1 class="h3 font-weight-bold">the news dispatch.</h1>
                </div>
                <div class="d-flex align-items-center">
                    <a href="#" class="text-dark mr-3">Sign in</a>
                    <button class="btn btn-dark rounded-pill">Subscribe</button>
                </div>
            </div>
        </header>

        <nav class="bg-white shadow-sm">
            <div class="container">
                <ul class="nav justify-content-center py-3">
                    <li class="nav-item">
                        <a class="nav-link text-dark" href="<?= base_url() ?>home/index">LATEST</a>
                    </li>
                    <?php foreach ($categories as $category): ?>
                    <li class="nav-item">
                        <a class="nav-link text-secondary"
                            href="<?= base_url('home/category/'); ?><?= $category['id'] ?>">
                            <?= $category['name']; ?>
                        </a>
                    </li>
                    <?php endforeach; ?>
                </ul>
            </div>
        </nav>

        <div class="content-wrapper">
            <!-- Section I -->
            <div class="container mt-5">
                <!-- Header Section -->
                <div class="row align-items-center mb-3">
                    <div class="col">
                        <h4 class="mb-0">Category : <?= $categoryId['name']; ?></h4>
                    </div>
                    <div class="col text-right">
                        <h6 class="mb-0">Total : <?= count($articles); ?></h6>
                    </div>
                </div>
                <!-- Card Section -->
                <div class="row gy-4">
                    <?php foreach ($articles as $article): ?>
                    <div class="col-lg-3 col-md-4 col-sm-6">
                        <img src="https://placehold.co/600x400" class="img-fluid rounded mb-2" alt="" />
                        <h5 class="text-center"><?= $article['categories']; ?></h5>
                        <a href="<?= base_url('home/article/' . urlencode($article['article_id'])); ?>">
                            <h4><?= $article['title']; ?></h4>
                        </a>
                        <p>
                            <?= substr($article['content'], 0, 150); ?>...
                        </p>
                        <div class="d-flex justify-content-between">
                            <p class="mb-0"><strong><?= $article['author_name']; ?></strong></p>
                            <p class="mb-0"><?= $article['tags']; ?></p>
                        </div>
                    </div>
                    <?php endforeach; ?>
                </div>
            </div>
        </div>
    </div>

    <footer class="footer mt-5">
        <div class="footer-container">
            <div class="footer-section brand">
                <h2 class="title">The News Dispatch</h2>
                <p>Your daily dose of news delivered with style.</p>
                <div class="social-icons">
                    <a href="#" class="social-icon"><i class="fab fa-twitter"></i></a>
                    <a href="#" class="social-icon"><i class="fab fa-facebook-f"></i></a>
                    <a href="#" class="social-icon"><i class="fab fa-linkedin-in"></i></a>
                </div>
            </div>
            <div class="footer-section links">
                <h3>Quick Links</h3>
                <ul>
                    <li><a href="#">About</a></li>
                    <li><a href="#">Authors</a></li>
                    <li><a href="#">Archive</a></li>
                    <li><a href="#">Terms and Conditions</a></li>
                    <li><a href="#">Cookie Policy</a></li>
                </ul>
            </div>
            <div class="footer-section contact">
                <h3>Contact Us</h3>
                <p>Email: info@newsdispatch.com</p>
                <p>Phone: +123 456 789</p>
                <p>Address: 123 News St., Dispatch City</p>
            </div>
        </div>
        <div class="footer-bottom">
            <p>© 2024 Uizard News. All rights reserved.</p>
        </div>
    </footer>

</body>

</html>