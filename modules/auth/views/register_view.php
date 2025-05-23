<?php require_once '../../../templates/header.php'; ?>

<div class="auth-container">
    <div class="auth-logo">
        <img src="/assets/images/logo.png" alt="VMIEd Logo">
    </div>
    
    <form class="auth-form" method="POST">
        <h2>Đăng ký tài khoản</h2>
        
        <?php if (!empty($error)): ?>
            <div class="alert alert-danger"><?= htmlspecialchars($error) ?></div>
        <?php endif; ?>

        <div class="form-group">
            <label for="username">Tên đăng nhập</label>
            <input type="text" id="username" name="username" 
                   value="<?= isset($_POST['username']) ? htmlspecialchars($_POST['username']) : '' ?>" required>
        </div>

        <div class="form-group">
            <label for="email">Email</label>
            <input type="email" id="email" name="email" 
                   value="<?= isset($_POST['email']) ? htmlspecialchars($_POST['email']) : '' ?>" required>
        </div>

        <div class="form-group">
            <label for="password">Mật khẩu (tối thiểu 6 ký tự)</label>
            <input type="password" id="password" name="password" required minlength="6">
        </div>

        <div class="form-group">
            <label for="confirm_password">Nhập lại mật khẩu</label>
            <input type="password" id="confirm_password" name="confirm_password" required>
        </div>

        <button type="submit" class="btn-submit">Đăng ký</button>
        
        <div class="auth-footer">
            Đã có tài khoản? <a href="login.php">Đăng nhập ngay</a>
        </div>
    </form>
</div>
<?php require_once __DIR__ . '/../../../templates/header.php'; ?>