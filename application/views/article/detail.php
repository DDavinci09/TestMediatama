<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-12 d-flex justify-content-between align-items-center">
                    <h1 class="m-0"><?= $title; ?></h1>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <!-- Main content -->
            <section class="content">
                <div class="container-fluid">
                    <div class="row">
                        <!-- Artikel Utama -->
                        <div class="col-lg-8">
                            <div class="card mb-4 shadow-sm">
                                <div class="card-body">
                                    <!-- Article Image -->
                                    <div class="col-12 text-center mb-4">
                                        <img src="https://placehold.co/500x200" class="img-fluid rounded shadow"
                                            alt="Article Image">
                                    </div>



                                    <!-- Author and Date -->
                                    <div class="d-flex justify-content-between align-items-center mb-4">
                                        <span class="text-muted">
                                            <i class="fas fa-user me-2"></i>
                                            <?= htmlspecialchars($article['author_name']); ?>
                                        </span>
                                        <span class="text-muted">
                                            <i class="fas fa-calendar me-2"></i>
                                            <?= date('j F Y'); ?>
                                        </span>
                                    </div>

                                    <!-- Article Title -->
                                    <h3>
                                        "<?= htmlspecialchars($article['title']); ?>"
                                    </h3>

                                    <!-- Article Content -->
                                    <p class="text-justify" style="line-height: 1.8;">
                                        <?= nl2br(htmlspecialchars($article['content'])); ?>
                                    </p>
                                </div>

                            </div>
                        </div>

                        <!-- Sidebar (Kategori & Tag) -->
                        <div class="col-lg-4">
                            <!-- Categories -->
                            <div class="card mb-3 shadow-sm">
                                <div class="card-body">
                                    <?php if (!empty($article['categories'])): ?>
                                    <h5 class="card-title text-secondary fw-bold">Categories : </h5>
                                    <div>
                                        <?php foreach (explode(',', $article['categories']) as $category): ?>
                                        <span class="badge bg-primary me-1"><?= htmlspecialchars($category); ?></span>
                                        <?php endforeach; ?>
                                    </div>
                                    <?php endif; ?>
                                    <br>
                                    <!-- Tags -->
                                    <?php if (!empty($article['tags'])): ?>
                                    <h5 class="card-title text-secondary fw-bold">Tags : </h5>
                                    <div>
                                        <?php foreach (explode(',', $article['tags']) as $tag): ?>
                                        <span class="badge bg-secondary me-1"><?= htmlspecialchars($tag); ?></span>
                                        <?php endforeach; ?>
                                    </div>
                                    <?php endif; ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div><!-- /.container-fluid -->
            </section>
            <!-- /.content -->

        </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
</div>
<!-- /.content-wrapper -->