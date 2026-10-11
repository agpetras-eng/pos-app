<?= $this->extend('layout') ?>

<?= $this->section('content') ?>

<div class="page">

    <div class="page-header">
        <h1>Customers</h1>
        <div class="header-buttons">
            <a href="<?= base_url('/') ?>" class="btn btn-ghost"><i class="bi bi-house-fill"></i> Home</a>
            <a href="<?= base_url('customers/new') ?>" class="btn btn-gold"><i class="bi bi-plus-lg"></i> New customer</a>
        </div>
    </div>

    <div class="card">
        <div class="table-wrap">
            <table>
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Full name</th>
                        <th>Email</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (empty($customers)): ?>
                        <tr>
                            <td colspan="4" class="empty">No customers yet. Click "New customer" to add one.</td>
                        </tr>
                    <?php endif; ?>

                    <?php foreach ($customers as $customer): ?>
                        <tr>
                            <td><?= $customer['id'] ?></td>
                            <td><?= esc($customer['full_name']) ?></td>
                            <td><?= esc($customer['email']) ?></td>
                            <td>
                                <a href="<?= base_url('customers/edit/' . $customer['id']) ?>" class="btn btn-small btn-ghost">
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
