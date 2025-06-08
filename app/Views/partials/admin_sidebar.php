<!-- Sidebar -->
<nav id="sidebar" class="col-md-3 col-lg-2 d-md-block bg-light sidebar collapse">
    <div class="position-sticky pt-3">
        <ul class="nav flex-column">
            <li class="nav-item">
                <a class="nav-link <?= current_url() == site_url('admin') ? 'active' : '' ?>" href="<?= site_url('admin') ?>">
                    <i class="bi bi-speedometer2 me-2"></i>
                    Dashboard
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link <?= current_url() == site_url('admin/users') ? 'active' : '' ?>" href="<?= site_url('admin/users') ?>">
                    <i class="bi bi-people me-2"></i>
                    User Management
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link <?= current_url() == site_url('admin/settings') ? 'active' : '' ?>" href="<?= site_url('admin/settings') ?>">
                    <i class="bi bi-gear me-2"></i>
                    Settings
                </a>
            </li>
        </ul>
    </div>
</nav>
