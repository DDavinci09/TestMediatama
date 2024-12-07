<div class="content-wrapper">

    <!-- Section I -->
    <div class="container py-4">
        <div class="row gy-4">
            <!-- Podcast Section -->
            <div class="col-lg-4 col-md-6 col-sm-12">
                <h5 class="mb-2"><i class="fa-solid fa-headphones"></i> Podcast Episode</h5>
                <h3 class="mb-3">Daily Minute: Reports From Around The Worlds</h3>
                <audio controls class="w-100">
                    <source src="your-audio-file.mp3" type="audio/mpeg">
                    Your browser does not support the audio element.
                </audio>
                <p class="card-text"><strong>Nicola Schulz</strong></p>
                <hr>
                <?php foreach ($random1 as $rd1): ?>
                <img src="https://placehold.co/600x300" class="img-fluid rounded mb-3" alt="">
                <hr>
                <h5><?= $rd1['categories']; ?></h5>
                <a href="<?= base_url('home/article/' . urlencode($rd1['article_id'])); ?>">
                    <h4><?= $rd1['title']; ?></h4>
                </a>
                <p>
                    <?= substr($rd1['content'], 0, 150); ?>...
                </p>
                <div class="d-flex justify-content-between">
                    <p class="mb-0"><strong><?= $rd1['author_name']; ?></strong></p>
                    <p class="mb-0"><?= $rd1['tags']; ?></p>
                </div>
                <?php endforeach; ?>
            </div>
            <!-- Culture Section -->
            <div class="col-lg-4 col-md-6 col-sm-12 text-center">
                <?php foreach ($random2 as $rd2): ?>
                <img src="https://placehold.co/600x400" class="img-fluid rounded mb-3" alt="">
                <h5 class="mb-2"><?= $rd2['categories']; ?></h5>
                <a href="<?= base_url('home/article/' . urlencode($rd2['article_id'])); ?>">
                    <h1><?= $rd2['title']; ?></h1>
                </a>
                <p class="mb-3">
                    <?= substr($rd2['content'], 0, 150); ?>...
                </p>
                <p class="text-muted mb-0">
                    <strong><?= $rd2['author_name']; ?></strong>
                </p>
                <p class="mb-0"><?= $rd2['tags']; ?></p>
                <?php endforeach; ?>
            </div>
            <!-- Additional News Section -->
            <div class="col-lg-4 col-md-6 col-sm-12">
                <?php foreach ($random3 as $rd3): ?>
                <img src="https://placehold.co/600x300" class="img-fluid rounded mb-3" alt="">
                <h5><?= $rd3['categories']; ?></h5>
                <a href="<?= base_url('home/article/' . urlencode($rd3['article_id'])); ?>">
                    <h4><?= $rd3['title']; ?></h4>
                </a>
                <p>
                    <?= substr($rd3['content'], 0, 150); ?>...
                </p>
                <div class="d-flex justify-content-between">
                    <p class="mb-0"><strong><?= $rd3['author_name']; ?></strong></p>
                    <p class="mb-0"><?= $rd3['tags']; ?></p>
                </div>
                <hr>
                <?php endforeach; ?>
            </div>
        </div>
    </div>

    <div class="divider"></div> <!-- Divider -->

    <!-- Section II -->
    <div class="container mt-5">
        <!-- Header Section -->
        <div class="row align-items-center mb-3">
            <div class="col">
                <h4 class="mb-0">Articles</h4>
            </div>
            <div class="col text-right">
                <h6 class="text-primary mb-0">See All</h6>
            </div>
        </div>
        <!-- Card Section -->
        <div class="row gy-4">
            <?php $articles = array_slice($articles, 0, 4); foreach ($articles as $article): ?>
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

    <div class="divider"></div> <!-- Divider -->

    <!-- Section III -->
    <div class="container mt-5">
        <!-- Header Section -->
        <!-- Header Section -->
        <div class="row align-items-center mb-3">
            <div class="col">
                <h4 class="mb-0">Editor's Pick</h4>
            </div>
            <div class="col text-right">
                <h6 class="text-primary mb-0">See All</h6>
            </div>
        </div>
        <!-- Card Section -->
        <div class="row gy-4">
            <?php 
                    $articles = array_slice($articles, 0, 3);
                    $i=1; foreach ($articles as $article): ?>
            <div class="col-lg-4 col-md-6">
                <div class="d-flex align-items-center mb-3">
                    <div class="me-3">
                        <h1 class="mb-0"><?= $i++; ?> </h1>
                    </div>
                    <div class="flex-grow-1">
                        <img src="https://placehold.co/600x400" class="img-fluid rounded" alt="" />
                    </div>
                </div>
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