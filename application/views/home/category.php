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