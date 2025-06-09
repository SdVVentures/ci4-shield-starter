<?= $this->extend('layouts/admin') ?>

<?= $this->section('title') ?>Edit User<?= $this->endSection() ?>

<?= $this->section('header') ?>Edit User<?= $this->endSection() ?>

<?= $this->section('breadcrumb') ?>
<li class="breadcrumb-item"><a href="<?= site_url('admin/users') ?>">Users</a></li>
<li class="breadcrumb-item active" aria-current="page">Edit</li>
<?= $this->endSection() ?>

<?= $this->section('content') ?>
<div class="card">
    <div class="card-header">
        <h5 class="card-title mb-0">Edit User: <?= esc($user->username) ?></h5>
    </div>
    <div class="card-body">
        <form action="<?= site_url('admin/users/update/' . $user->id) ?>" method="post" class="needs-validation" novalidate>
            <?= csrf_field() ?>
            
            <div class="mb-3">
                <label for="username" class="form-label">Username</label>
                <input type="text" class="form-control" id="username" name="username" value="<?= old('username', $user->username) ?>" required>
                <div class="invalid-feedback">Please enter a username.</div>
            </div>
            
            <div class="mb-3">
                <label for="email" class="form-label">Email</label>
                <input type="email" class="form-control" id="email" name="email" value="<?= old('email', $user->email) ?>" required>
                <div class="invalid-feedback">Please enter a valid email address.</div>
            </div>
            
            <div class="mb-3">
                <label for="password" class="form-label">Password</label>
                <input type="password" class="form-control" id="password" name="password">
                <div class="form-text">Leave blank to keep current password. New password must be at least 8 characters long and contain a mix of letters, numbers, and symbols.</div>
            </div>
            
            <div class="mb-3">
                <label for="password_confirm" class="form-label">Confirm Password</label>
                <input type="password" class="form-control" id="password_confirm" name="password_confirm">
                <div class="invalid-feedback">Passwords do not match.</div>
            </div>
            
            <div class="mb-3">
                <label class="form-label">User Groups</label>
                <div class="row">
                    <?php foreach ($groups as $group): ?>
                        <div class="col-md-4 mb-2">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" name="groups[]" value="<?= $group['group'] ?>" id="group_<?= $group['group'] ?>" 
                                    <?= in_array($group['group'], old('groups', $userGroups)) ? 'checked' : '' ?>>
                                <label class="form-check-label" for="group_<?= $group['group'] ?>">
                                    <?= esc(ucfirst($group['group'])) ?>
                                    <small class="d-block text-muted"><?= esc($group['group'] == 'admin' ? 'Administrator access' : 'Regular user access') ?></small>
                                </label>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
                <div class="invalid-feedback">Please select at least one group.</div>
            </div>
            
            <div class="d-flex justify-content-between">
                <a href="<?= site_url('admin/users') ?>" class="btn btn-secondary">Cancel</a>
                <button type="submit" class="btn btn-primary">Update User</button>
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
                
                // Check if password and confirm password match
                var password = document.getElementById('password');
                var passwordConfirm = document.getElementById('password_confirm');
                if (password.value !== '' && password.value !== passwordConfirm.value) {
                    event.preventDefault();
                    event.stopPropagation();
                    passwordConfirm.setCustomValidity('Passwords do not match');
                } else {
                    passwordConfirm.setCustomValidity('');
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
