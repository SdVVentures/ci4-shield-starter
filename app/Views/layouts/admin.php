<?php
$data = [
    'bodyClass' => '',
    'showNavbar' => true,
    'fluidContainer' => true,
    'showFooter' => false
];
echo view('partials/header', $data);
?>

    <div class="container-fluid">
        <div class="row">
            <?= view('partials/admin_sidebar') ?>

            <!-- Main Content -->
            <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4 py-4">
                <!-- Breadcrumb -->
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="<?= site_url('admin') ?>">Admin</a></li>
                        <?= $this->renderSection('breadcrumb') ?>
                    </ol>
                </nav>
                
                <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
                    <h1 class="h2"><?= $this->renderSection('header') ?></h1>
                </div>
                
                <?= view('partials/alerts') ?>
                
                <?= $this->renderSection('content') ?>
            </main>
        </div>
    </div>

<?= view('partials/footer', $data) ?>
