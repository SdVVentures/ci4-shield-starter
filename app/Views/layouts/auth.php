<?php
$data = [
    'bodyClass' => 'bg-light',
    'showNavbar' => false,
    'fluidContainer' => false,
    'showFooter' => false
];
echo view('partials/header', $data);
?>
    <div class="container">
        <div class="row justify-content-center mt-5">
            <div class="col-md-6">
                <div class="text-center mb-4">
                    <a href="<?= site_url() ?>">
                        <h2>CI4 Shield Starter</h2>
                    </a>
                </div>
                
                <div class="card shadow-sm">
                    <div class="card-header bg-primary text-white">
                        <h4 class="card-title mb-0"><?= $this->renderSection('header') ?></h4>
                    </div>
                    <div class="card-body">
                        <?= view('partials/alerts') ?>
                        
                        <?= $this->renderSection('content') ?>
                    </div>
                </div>
                
                <div class="text-center mt-3">
                    <?= $this->renderSection('footer') ?>
                </div>
            </div>
        </div>
    </div>

<?= view('partials/footer', $data) ?>
