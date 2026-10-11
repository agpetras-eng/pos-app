<?= $this->extend('layout') ?>

<?= $this->section('content') ?>

<?php $errors = session('errors') ?? []; ?>

<div class="page">

    <div class="page-header">
        <h1><?= esc($title) ?></h1>
        <a href="<?= base_url('customers') ?>" class="btn btn-ghost"><i class="bi bi-arrow-left"></i> Back to customers</a>
    </div>

    <div class="card form-card">
        <form action="<?= $action ?>" method="post">
            <?= csrf_field() ?>

            <div class="field">
                <label for="full_name">Full name *</label>
                <input type="text" id="full_name" name="full_name"
                       class="<?= isset($errors['full_name']) ? 'invalid' : '' ?>"
                       value="<?= old('full_name', esc($customer['full_name'])) ?>">
                <div class="error"><?= esc($errors['full_name'] ?? '') ?></div>
            </div>

            <div class="field">
                <label for="email">Email *</label>
                <input type="text" id="email" name="email"
                       class="<?= isset($errors['email']) ? 'invalid' : '' ?>"
                       value="<?= old('email', esc($customer['email'])) ?>">
                <div class="error"><?= esc($errors['email'] ?? '') ?></div>
            </div>

            <div class="form-buttons">
                <button type="submit" class="btn btn-gold">Save customer</button>
                <a href="<?= base_url('customers') ?>" class="btn btn-ghost">Cancel</a>
            </div>
        </form>
    </div>

</div>

<?= $this->endSection() ?>
