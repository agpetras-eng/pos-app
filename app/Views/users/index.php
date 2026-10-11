<?= $this->extend('layout') ?>

<?= $this->section('content') ?>

<div class="page">

    <div class="page-header">
        <h1>User Accounts</h1>
        <div class="header-buttons">
            <a href="<?= base_url('/') ?>" class="btn btn-ghost"><i class="bi bi-house-fill"></i> Home</a>
            <a href="<?= base_url('users/new') ?>" class="btn btn-gold"><i class="bi bi-plus-lg"></i> New user</a>
        </div>
    </div>

    <div class="card">
        <div class="table-wrap">
            <table>
                <thead>
                    <tr>
                        <th>Avatar</th>
                        <th>Username</th>
                        <th>Full name</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (empty($users)): ?>
                        <tr>
                            <td colspan="4" class="empty">No users yet. Click "New user" to add one.</td>
                        </tr>
                    <?php endif; ?>

                    <?php foreach ($users as $user): ?>
                        <tr>
                            <td>
                                <?php if (! empty($user['avatar'])): ?>
                                    <img class="avatar" src="<?= base_url('uploads/thumbs/' . $user['avatar']) ?>" alt="Avatar of <?= esc($user['full_name']) ?>">
                                <?php else: ?>
                                    <img class="avatar" src="<?= base_url('images/placeholder.svg') ?>" alt="No avatar">
                                <?php endif; ?>
                            </td>
                            <td><?= esc($user['username']) ?></td>
                            <td><?= esc($user['full_name']) ?></td>
                            <td>
                                <a href="<?= base_url('users/edit/' . $user['id']) ?>" class="btn btn-small btn-ghost">
                                    <i class="bi bi-pencil-fill"></i> Edit
                                </a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>

</div>

<?= $this->endSection() ?>
