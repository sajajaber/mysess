//fatima code
//i worked through this tutorial to get some login tips https://codeshack.io/secure-login-system-php-mysql/

<?php
session_start();
require_once __DIR__ . '/../models/User.php';
class AuthController {
    public function showLogin() {
        //check if user logged so we send to his dashboard
        if (isset($_SESSION['user_id'])) {
            $this->goToDashboard($_SESSION['role']);
        }
        require __DIR__ . '/../views/auth/login.php';  //stay in login
    }

    //login form in frontend tba
    public function login() {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            return;
        }
        $email = trim($_POST['email']);//trim removes extra spaces
        $password = trim($_POST['password']);
        if (empty($email) || empty($password)) {
            return "Please fill in both email and password";
        }

        $userModel = new User();
        $user = $userModel->getByEmail($email);
        if (!$user) {
            return "Invalid email or password";
        }

        if (!password_verify($password, $user['password'])) {
            return "Invalid email or password";
        }

    //save
        $_SESSION['user_id'] = $user['id'];
        $_SESSION['email'] = $user['email'];
        $_SESSION['first_name'] = $user['first_name'];
        $_SESSION['last_name'] = $user['last_name'];
        $_SESSION['role'] = $user['role'];

        $this->goToDashboard($user['role']);
    }
    //logout
    public function logout() {
     $_SESSION = array();
     session_destroy();
        header("Location: /auth/login.php");
        exit;
    }

    private function goToDashboard($role) {
        if ($role == 'admin') {
            header("Location: /admin/dashboard.php");
        }
        else if ($role == 'teacher') {
            header("Location: /teacher/dashboard.php");
        }
        else if ($role == 'therapist') {
            header("Location: /therapist/dashboard.php");
        }
        else if ($role == 'nurse') {
            header("Location: /nurse/dashboard.php");
        }
        else if ($role == 'parent') {
            header("Location: /parent/dashboard.php");
        }
        else if ($role == 'boarding_staff') {
            header("Location: /boarding/dashboard.php");
        }
        else if ($role == 'security_guard') {
            header("Location: /security/dashboard.php");
        }
        else {
            header("Location: /auth/login.php");
        }
        exit;
    }
}
?>