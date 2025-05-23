<?php
require_once '../../../includes/config.php';
require_once '../../../includes/auth_functions.php';

class RegisterController {
    private $conn;
    
    public function __construct($conn) {
        $this->conn = $conn;
    }

    public function handleRegister() {
        $error = '';
        
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $username = sanitize_input($_POST['username']);
            $email = sanitize_input($_POST['email']);
            $password = $_POST['password'];
            $confirm_password = $_POST['confirm_password'];

            // Validation
            if (empty($username) || empty($email) || empty($password)) {
                $error = 'Vui lòng điền đầy đủ thông tin';
            } elseif ($password !== $confirm_password) {
                $error = 'Mật khẩu không khớp';
            } else {
                $error = $this->registerUser($username, $email, $password);
                
                if ($error === '') {
                    header('Location: register_success.php');
                    exit();
                }
            }
        }
        
        return $error;
    }

    private function registerUser($username, $email, $password) {
        // Check existing user
        $stmt = $this->conn->prepare("SELECT email FROM accounts WHERE email = ?");
        $stmt->bind_param("s", $email);
        $stmt->execute();
        
        if ($stmt->get_result()->num_rows > 0) {
            return 'Email đã được đăng ký';
        }

        // Insert new user
        $hashed_password = password_hash($password, PASSWORD_DEFAULT);
        $stmt = $this->conn->prepare("INSERT INTO accounts (username, email, password) VALUES (?, ?, ?)");
        $stmt->bind_param("sss", $username, $email, $hashed_password);

        if (!$stmt->execute()) {
            return 'Đăng ký thất bại: ' . $this->conn->error;
        }

        return '';
    }
}

// Khởi tạo và xử lý
$registerController = new RegisterController($conn);
$error = $registerController->handleRegister();

// Hiển thị view
require '../views/register_view.php';
?>