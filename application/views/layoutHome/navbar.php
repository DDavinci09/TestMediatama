<header class="bg-secondary py-4">
    <div class="container d-flex justify-content-between align-items-center">
        <div class="d-flex align-items-center">
            <input type="text" placeholder="Search" class="form-control rounded-pill">
        </div>
        <div class="text-center">
            <h1 class="h3 font-weight-bold">the news dispatch.</h1>
        </div>
        <div class="d-flex align-items-center">
            <a href="<?= base_url() ?>auth/index" class="text-white mr-2 btn btn-success rounded-pill">Login
                Admin</a>
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
                    href="<?= base_url('home/category/' . urlencode($category['id'])); ?>">
                    <?= $category['name']; ?>
                </a>
            </li>
            <?php endforeach; ?>
        </ul>
    </div>
</nav>