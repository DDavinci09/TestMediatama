<!-- Main Sidebar Container -->
<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="index3.html" class="brand-link">
        <img src="<?= base_url('assets'); ?>/dist/img/AdminLTELogo.png" alt="AdminLTE Logo"
            class="brand-image img-circle elevation-3" style="opacity: .8">
        <span class="brand-text font-weight-light">CMS</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                <li class="nav-header">Menu</li>
                <li class="nav-item">
                    <a href="<?= base_url(); ?>Admin/index" class="nav-link">
                        <i class="nav-icon fas fa-warehouse"></i>
                        <p>
                            Dashboard
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="<?= base_url(); ?>Admin/v_article" class="nav-link">
                        <i class="nav-icon fas fa-book"></i>
                        <p>
                            Article
                        </p>
                    </a>
                </li>
                <li class="nav-header">Logout</li>
                <li class="nav-item">
                    <a href="<?= base_url('auth/logout'); ?>" class="nav-link"
                        onclick="return confirm('Are you sure you want to logout?');">
                        <i class="nav-icon fas fa-columns"></i>
                        <p>Logout</p>
                    </a>
                </li>
            </ul>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>