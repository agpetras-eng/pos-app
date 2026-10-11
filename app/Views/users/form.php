<?= $this->extend('layout') ?>

<?= $this->section('content') ?>

<?php
$errors = session('errors') ?? [];
?>

<div class="page">

    <div class="page-header">
        <h1><?= esc($title) ?></h1>
        <a href="<?= base_url('users') ?>" class="btn btn-ghost"><i class="bi bi-arrow-left"></i> Back to users</a>
    </div>

    <div class="card form-card">
        <!-- enctype is required for file uploads -->
        <form action="<?= $action ?>" method="post" enctype="multipart/form-data">
            <?= csrf_field() ?>

            <div class="field">
                <label for="username">Username *</label>
                <input type="text" id="username" name="username"
                       class="<?= isset($errors['username']) ? 'invalid' : '' ?>"
                       value="<?= old('username', esc($user['username'])) ?>">
                <div class="error"><?= esc($errors['username'] ?? '') ?></div>
            </div>

            <div class="field">
                <label for="full_name">Full name *</label>
                <input type="text" id="full_name" name="full_name"
                       class="<?= isset($errors['full_name']) ? 'invalid' : '' ?>"
                       value="<?= old('full_name', esc($user['full_name'])) ?>">
                <div class="error"><?= esc($errors['full_name'] ?? '') ?></div>
            </div>

            <?php if ($isEdit): ?>
                <div class="field">
                    <label for="avatar">Profile picture (JPG or PNG, max 2MB)</label>

                    <div class="avatar-current">
                        <?php if (! empty($user['avatar'])): ?>
                            <img class="avatar avatar-large" src="<?= base_url('uploads/thumbs/' . $user['avatar']) ?>" alt="Current avatar">
                        <?php else: ?>
                            <img class="avatar avatar-large" src="<?= base_url('images/placeholder.svg') ?>" alt="No avatar yet">
                        <?php endif; ?>
                        <span>Choose a new file only if you want to replace it.</span>
                    </div>

                    <input type="file" id="avatar" name="avatar"
                           class="<?= isset($errors['avatar']) ? 'invalid' : '' ?>">
                    <div class="error"><?= esc($errors['avatar'] ?? '') ?></div>
                </div>
            <?php endif; ?>

            <div class="form-buttons">
                <button type="submit" class="btn btn-gold">Save user</button>
                <a href="<?= base_url('users') ?>" class="btn btn-ghost">Cancel</a>
            </div>
        </form>
    </div>

</div>

<?= $this->endSection() ?>
