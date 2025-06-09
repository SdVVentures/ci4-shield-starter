<?= $this->extend('layouts/admin') ?>

<?= $this->section('title') ?>Admin Settings<?= $this->endSection() ?>

<?= $this->section('breadcrumb') ?>
<li class="breadcrumb-item active" aria-current="page">Settings</li>
<?= $this->endSection() ?>

<?= $this->section('header') ?>Settings<?= $this->endSection() ?>

<?= $this->section('content') ?>
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h5 class="card-title">System Settings</h5>
            </div>
            <div class="card-body">
                <form action="<?= site_url('admin/settings/update') ?>" method="post">
                    <?= csrf_field() ?>
                    
                    <div class="mb-3">
                        <label for="site_name" class="form-label">Site Name</label>
                        <input type="text" class="form-control" id="site_name" name="site_name" value="CI4 Shield Starter">
                    </div>
                    
                    <div class="mb-3">
                        <label for="site_description" class="form-label">Site Description</label>
                        <textarea class="form-control" id="site_description" name="site_description" rows="3">A starter application with CodeIgniter 4 and Shield authentication.</textarea>
                    </div>
                    
                    <div class="mb-3">
                        <label for="admin_email" class="form-label">Admin Email</label>
                        <input type="email" class="form-control" id="admin_email" name="admin_email" value="admin@example.com">
                    </div>
                    
                    <div class="mb-3">
                        <label class="form-label">Registration</label>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" id="allow_registration" name="allow_registration" checked>
                            <label class="form-check-label" for="allow_registration">
                                Allow new user registration
                            </label>
                        </div>
                    </div>
                    
                    <div class="mb-3">
                        <label class="form-label">Maintenance Mode</label>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" id="maintenance_mode" name="maintenance_mode">
                            <label class="form-check-label" for="maintenance_mode">
                                Enable maintenance mode
                            </label>
                        </div>
                    </div>
                    
                    <button type="submit" class="btn btn-primary">Save Settings</button>
                </form>
            </div>
        </div>
    </div>
</div>
<?= $this->endSection() ?>
