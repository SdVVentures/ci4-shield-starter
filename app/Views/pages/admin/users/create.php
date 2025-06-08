<?= $this->extend('layouts/admin') ?>

<?= $this->section('title') ?>Create User<?= $this->endSection() ?>

<?= $this->section('header') ?>Create New User<?= $this->endSection() ?>

<?= $this->section('breadcrumb') ?>
<li class="breadcrumb-item"><a href="<?= site_url('admin/users') ?>">Users</a></li>
<li class="breadcrumb-item active" aria-current="page">Create</li>
<?= $this->endSection() ?>

<?= $this->section('content') ?>
<div class="card">
    <div class="card-header">
        <h5 class="card-title mb-0">User Information</h5>
    </div>
    <div class="card-body">
        <form action="<?= site_url('admin/users/store') ?>" method="post" class="needs-validation" novalidate>
            <?= csrf_field() ?>
            
            <div class="mb-3">
                <label for="username" class="form-label">Username</label>
                <input type="text" class="form-control" id="username" name="username" value="<?= old('username') ?>" required>
                <div class="invalid-feedback">Please enter a username.</div>
            </div>
            
            <div class="mb-3">
                <label for="email" class="form-label">Email</label>
                <input type="email" class="form-control" id="email" name="email" value="<?= old('email') ?>" required>
                <div class="invalid-feedback">Please enter a valid email address.</div>
            </div>
            
            <div class="mb-3">
                <label for="password" class="form-label">Password</label>
                <input type="password" class="form-control" id="password" name="password" required>
                <div class="form-text">Password must be at least 8 characters long and contain a mix of letters, numbers, and symbols.</div>
                <div class="invalid-feedback">Please enter a password.</div>
            </div>
            
            <div class="mb-3">
                <label for="password_confirm" class="form-label">Confirm Password</label>
                <input type="password" class="form-control" id="password_confirm" name="password_confirm" required>
                <div class="invalid-feedback">Please confirm the password.</div>
            </div>
            
            <div class="mb-3">
                <label class="form-label">User Groups</label>
                <div class="row">
                    <?php foreach ($groups as $group): ?>
                        <div class="col-md-4 mb-2">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" name="groups[]" value="<?= $group['name'] ?>" id="group_<?= $group['name'] ?>" <?= in_array($group['name'], old('groups', [])) ? 'checked' : '' ?>>
                                <label class="form-check-label" for="group_<?= $group['name'] ?>">
                                    <?= esc($group['title']) ?>
                                    <small class="d-block text-muted"><?= esc($group['description']) ?></small>
                                </label>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
                <div class="invalid-feedback">Please select at least one group.</div>
            </div>
            
            <div class="d-flex justify-content-between">
                <a href="<?= site_url('admin/users') ?>" class="btn btn-secondary">Cancel</a>
                <button type="submit" class="btn btn-primary">Create User</button>
            </div>
        </form>
    </div>
</div>
<?= $this->endSection() ?>

<?= $this->section('scripts') ?>
<script>
    // Form validation
    (function() {
        'use strict';
        
        // Fetch all the forms we want to apply custom Bootstrap validation styles to
        var forms = document.querySelectorAll('.needs-validation');
        
        // Loop over them and prevent submission
        Array.prototype.slice.call(forms).forEach(function(form) {
            form.addEventListener('submit', function(event) {
                // Check if at least one group is selected
                var groupCheckboxes = form.querySelectorAll('input[name="groups[]"]:checked');
                if (groupCheckboxes.length === 0) {
                    event.preventDefault();
                    event.stopPropagation();
                    form.querySelector('.invalid-feedback').style.display = 'block';
                }
                
                if (!form.checkValidity()) {
                    event.preventDefault();
                    event.stopPropagation();
                }
                
                form.classList.add('was-validated');
            }, false);
        });
    })();
</script>
<?= $this->endSection() ?>
