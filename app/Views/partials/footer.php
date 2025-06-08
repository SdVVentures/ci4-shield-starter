<?php if (isset($showFooter) && $showFooter): ?>
    <!-- Footer -->
    <footer class="bg-dark text-white py-4 mt-5">
        <div class="container">
            <div class="row">
                <div class="col-md-6">
                    <h5>CI4 Shield Starter</h5>
                    <p>A starter template for CodeIgniter 4 with Shield authentication.</p>
                </div>
                <div class="col-md-6 text-md-end">
                    <p>&copy; <?= date('Y') ?> CI4 Shield Starter. All rights reserved.</p>
                </div>
            </div>
        </div>
    </footer>
    <?php endif; ?>

    <!-- Bootstrap 5 JS Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    
    <!-- jQuery -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    
    <!-- Custom JS -->
    <script src="<?= base_url('assets/js/custom.js') ?>"></script>
    
    <?= $this->renderSection('scripts') ?>
</body>
</html>
