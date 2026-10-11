<?= $this->extend('layout') ?>

<?= $this->section('content') ?>

<div class="dashboard">

    <!-- LEFT SIDE: clock + notifications -->
    <aside class="dash-left">
        <div class="clock-date" id="clock-date">&nbsp;</div>
        <div class="clock-time" id="clock-time">--:--</div>

        <h2 class="notif-title"><i class="bi bi-bell-fill"></i> Overview</h2>

        <div class="notif">
            <span class="notif-icon"><i class="bi bi-people-fill"></i></span>
            <div>
                <strong><?= $customer_count ?> customer<?= $customer_count == 1 ? '' : 's' ?> registered</strong>
                <small>In the customer list</small>
            </div>
        </div>

        <div class="notif">
            <span class="notif-icon"><i class="bi bi-person-badge-fill"></i></span>
            <div>
                <strong><?= $user_count ?> user account<?= $user_count == 1 ? '' : 's' ?></strong>
                <small>Registered accounts</small>
            </div>
        </div>

        <div class="notif">
            <span class="notif-icon"><i class="bi bi-person-plus-fill"></i></span>
            <div>
                <?php if ($latest_customer !== null): ?>
                    <strong>Newest: <?= esc($latest_customer['full_name']) ?></strong>
                    <small><?= esc($latest_customer['email']) ?></small>
                <?php else: ?>
                    <strong>No customers yet</strong>
                    <small>Add your first customer</small>
                <?php endif; ?>
            </div>
        </div>
    </aside>

    <!-- RIGHT SIDE: big buttons -->
    <section class="tiles">

        <a class="tile" href="<?= base_url('customers') ?>">
            <span class="tile-icon"><i class="bi bi-people-fill"></i></span>
            <span class="tile-label">Customers</span>
        </a>

        <a class="tile" href="<?= base_url('customers/new') ?>">
            <span class="tile-icon"><i class="bi bi-person-plus-fill"></i></span>
            <span class="tile-label">New Customer</span>
        </a>

        <a class="tile" href="<?= base_url('users') ?>">
            <span class="tile-icon"><i class="bi bi-person-badge-fill"></i></span>
            <span class="tile-label">User Accounts</span>
        </a>

        <a class="tile" href="<?= base_url('users/new') ?>">
            <span class="tile-icon"><i class="bi bi-person-fill-add"></i></span>
            <span class="tile-label">New User</span>
        </a>

        <!-- These four are not built yet. Change href="#" and remove "disabled" when you add them. -->
        <a class="tile disabled" href="#" aria-disabled="true">
            <span class="tile-icon"><i class="bi bi-bag-fill"></i></span>
            <span class="tile-label">Products</span>
            <span class="tile-soon">Coming soon</span>
        </a>

        <a class="tile disabled" href="#" aria-disabled="true">
            <span class="tile-icon"><i class="bi bi-basket-fill"></i></span>
            <span class="tile-label">Sales</span>
            <span class="tile-soon">Coming soon</span>
        </a>

        <a class="tile disabled" href="#" aria-disabled="true">
            <span class="tile-icon"><i class="bi bi-box-seam-fill"></i></span>
            <span class="tile-label">Stocks</span>
            <span class="tile-soon">Coming soon</span>
        </a>

        <a class="tile disabled" href="#" aria-disabled="true">
            <span class="tile-icon"><i class="bi bi-bar-chart-fill"></i></span>
            <span class="tile-label">Reports</span>
            <span class="tile-soon">Coming soon</span>
        </a>

    </section>
</div>

<?= $this->endSection() ?>
