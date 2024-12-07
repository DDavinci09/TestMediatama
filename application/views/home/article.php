<div class="content-wrapper">
    <!-- Section I -->
    <div class="container mt-5">
        <div class="row">
            <!-- Article Image -->
            <div class="col-12 text-center mb-4">
                <img src="https://placehold.co/500x200" class="img-fluid rounded shadow" alt="Article Image">
            </div>

            <!-- Title -->
            <div class="col-12">
                <h1 class="fw-bold mb-3 text-primary"><?= $article['title']; ?></h1>
            </div>

            <!-- Author and Metadata -->
            <div class="col-12 d-flex justify-content-between align-items-center text-muted mb-4">
                <span>
                    <i class="fas fa-user"></i> <strong><?= $article['author_name']; ?></strong>
                </span>
                <span>
                    <?= date('j F Y') ?> <i class="fas fa-calendar"></i>
                </span>
            </div>

            <!-- Article Content -->
            <div class="col-12 mb-2">
                <p class="text-justify fs-5 lh-lg"><?= nl2br($article['content']); ?></p>
            </div>

            <!-- Categories -->
            <?php if (!empty($article['categories'])): ?>
            <div class="col-6 mb-3">
                <h5 class="text-secondary fw-bold">Categories:</h5>
                <div>
                    <?php foreach (explode(',', $article['categories']) as $category): ?>
                    <span class="badge bg-primary me-1"><?= htmlspecialchars($category); ?></span>
                    <?php endforeach; ?>
                </div>
            </div>
            <?php endif; ?>

            <!-- Tags -->
            <?php if (!empty($article['tags'])): ?>
            <div class="col-6 mb-3">
                <h5 class="text-secondary fw-bold">Tags:</h5>
                <div>
                    <?php foreach (explode(',', $article['tags']) as $tag): ?>
                    <span class="badge bg-secondary me-1"><?= htmlspecialchars($tag); ?></span>
                    <?php endforeach; ?>
                </div>
            </div>
            <?php endif; ?>

            <!-- Back Button -->
            <div class="col-12 text-end mt-5">
                <a href="<?= base_url(); ?>home/index" class="btn btn-outline-primary">
                    <i class="fas fa-arrow-left"></i> Back to Home
                </a>
            </div>
        </div>
    </div>
</div>