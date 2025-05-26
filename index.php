<?php
require_once 'includes/config.php';
require_once 'templates/header.php';
?>

<section class="banner">
    <h1>Chào mừng đến với VMIEd</h1>
    <?php
    if (isset($_SESSION['user_name'])) {
        echo '<p>User Name: ' . htmlspecialchars($_SESSION['user_name']) . '</p>';
    }
    ?>
    <p>Hệ thống đào tạo trực tuyến hàng đầu</p>
</section>

<?php require_once 'templates/footer.php'; ?>