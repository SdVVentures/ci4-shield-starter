<?php
$data = [
    'bodyClass' => '',
    'showNavbar' => true,
    'fluidContainer' => false,
    'showFooter' => true
];
echo view('partials/header', $data);
?>

    <!-- Main Content -->
    <main class="container py-4">
        <?= view('partials/alerts') ?>
        
        <?= $this->renderSection('content') ?>
    </main>

<?= view('partials/footer', $data) ?>
