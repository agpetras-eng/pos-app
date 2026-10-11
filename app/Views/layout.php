<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?= esc($pageTitle ?? 'Home') ?> | FEU POS</title>

    <!-- Font and icons -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css">

    <!-- Our own styles -->
    <link rel="stylesheet" href="<?= base_url('css/pos.css') ?>">
</head>
<body>

<!-- ============ TOP BAR ============ -->
<header class="topbar">
    <div class="topbar-left">
        <!-- Change the brand name here -->
        <a class="brand" href="<?= base_url('/') ?>">FEU<span>Pos</span></a>
        <span class="page-label"><?= esc($pageTitle ?? 'Home') ?></span>
    </div>

    <div class="topbar-right">
        <div class="status">
            <i class="bi bi-wifi" id="net-icon"></i>
            <div>
                <strong>Internet</strong>
                <small id="net-text">ONLINE</small>
            </div>
        </div>
        <div class="status">
            <i class="bi bi-hdd-stack-fill"></i>
            <div>
                <strong>Server</strong>
                <small>ONLINE</small>
            </div>
        </div>
        <div class="status">
            <i class="bi bi-person-fill"></i>
            <div>
                <strong>Administrator</strong>
                <small>Signed in</small>
            </div>
        </div>
        <button type="button" class="icon-btn" id="fullscreen-btn" title="Full screen">
            <i class="bi bi-arrows-fullscreen"></i>
        </button>
    </div>
</header>

<!-- ============ PAGE CONTENT ============ -->
<main class="main">

    <?php if (session()->getFlashdata('success')): ?>
        <div class="alert alert-success"><?= esc(session()->getFlashdata('success')) ?></div>
    <?php endif; ?>

    <?php if (session()->getFlashdata('error')): ?>
        <div class="alert alert-error"><?= esc(session()->getFlashdata('error')) ?></div>
    <?php endif; ?>

    <?= $this->renderSection('content') ?>

</main>

<!-- ============ FOOTER ============ -->
<footer class="footer">
    <span>FEU Pos 1.0 &middot; IT0049 TFA3</span>
    <span>Customer and user management</span>
</footer>

<script>
    // Live clock (only runs if the dashboard clock exists on this page)
    function updateClock() {
        var dateBox = document.getElementById('clock-date');
        var timeBox = document.getElementById('clock-time');
        if (dateBox === null || timeBox === null) {
            return;
        }
        var now = new Date();
        dateBox.textContent = now.toLocaleDateString('en-GB', { day: 'numeric', month: 'long', weekday: 'long' });
        timeBox.textContent = now.toLocaleTimeString('en-GB', { hour: '2-digit', minute: '2-digit' });
    }
    updateClock();
    setInterval(updateClock, 1000);

    // Internet status
    function updateNet() {
        var text = document.getElementById('net-text');
        var icon = document.getElementById('net-icon');
        if (navigator.onLine) {
            text.textContent = 'ONLINE';
            text.className = '';
            icon.className = 'bi bi-wifi';
        } else {
            text.textContent = 'OFFLINE';
            text.className = 'offline';
            icon.className = 'bi bi-wifi-off';
        }
    }
    updateNet();
    window.addEventListener('online', updateNet);
    window.addEventListener('offline', updateNet);

    // Full screen button
    document.getElementById('fullscreen-btn').addEventListener('click', function () {
        if (document.fullscreenElement) {
            document.exitFullscreen();
        } else {
            document.documentElement.requestFullscreen();
        }
    });
</script>

</body>
</html>
