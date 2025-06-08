<?= $this->extend('layouts/main') ?>

<?= $this->section('title') ?>Home<?= $this->endSection() ?>

<?= $this->section('content') ?>
<!-- Hero Section -->
<section class="hero text-center">
    <div class="container">
        <h1>Welcome to CI4 Shield Starter</h1>
        <p class="lead">A modern starter template for CodeIgniter 4 with Shield authentication</p>
        <?php if (!auth()->loggedIn()): ?>
            <div class="mt-4">
                <a href="<?= site_url('register') ?>" class="btn btn-primary btn-lg me-2">Get Started</a>
                <a href="<?= site_url('login') ?>" class="btn btn-outline-secondary btn-lg">Login</a>
            </div>
        <?php endif; ?>
    </div>
</section>

<!-- Features Section -->
<section class="py-5">
    <div class="container">
        <h2 class="text-center mb-5">Key Features</h2>
        <div class="row g-4">
            <div class="col-md-4">
                <div class="card h-100">
                    <div class="card-body text-center">
                        <i class="bi bi-shield-lock feature-icon"></i>
                        <h3>Secure Authentication</h3>
                        <p>Built with CodeIgniter Shield for robust authentication and authorization.</p>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card h-100">
                    <div class="card-body text-center">
                        <i class="bi bi-bootstrap feature-icon"></i>
                        <h3>Bootstrap 5</h3>
                        <p>Modern responsive design with Bootstrap 5 and jQuery.</p>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card h-100">
                    <div class="card-body text-center">
                        <i class="bi bi-gear feature-icon"></i>
                        <h3>Easy Customization</h3>
                        <p>Modular structure for easy customization and extension.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Call to Action -->
<section class="cta-section text-center">
    <div class="container">
        <h2>Ready to Get Started?</h2>
        <p class="lead">Start building your application with CI4 Shield Starter today.</p>
        <?php if (!auth()->loggedIn()): ?>
            <a href="<?= site_url('register') ?>" class="btn btn-light btn-lg mt-3">Create an Account</a>
        <?php else: ?>
            <a href="<?= site_url('account/settings') ?>" class="btn btn-light btn-lg mt-3">Manage Your Account</a>
        <?php endif; ?>
    </div>
</section>
<?= $this->endSection() ?>
