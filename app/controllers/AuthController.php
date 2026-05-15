
<?php
//fatima code
//i worked through this tutorial to get some login tips https://codeshack.io/secure-login-system-php-mysql/

session_start();

require_once __DIR__ . '/../models/User.php';

class AuthController {

    public function showLogin() {
        // check if user logged so we send to his dashboard
        if (isset($_SESSION['user_id'])) {
            $this->goToDashboard($_SESSION['role']);
        }
        require __DIR__ . '/../views/auth/login.php';  // stay in login
    }

    // login form in frontend tba
    public function login() {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            return;
        }

        $email = trim($_POST['email']);  // trim removes extra spaces
        $password = trim($_POST['password']);

        if (empty($email) || empty($password)) {
            $error = "Please fill in your email and password";
            require __DIR__ . '/../views/auth/login.php';
              return; }

        $userModel = new User();
        $user = $userModel->getByEmail($email);

        if (!$user) {
            $error = "Error occured, check your email and password again";
            require __DIR__ . '/../views/auth/login.php';
            return;
        }

        if (!password_verify($password, $user['password'])) {
            $error = "Error occured, check your password";
            require __DIR__ . '/../views/auth/login.php';
            return;
        }

        // save
        $_SESSION['user_id'] = $user['id'];
        $_SESSION['email'] = $user['email'];
        $_SESSION['first_name'] = $user['first_name'];
        $_SESSION['last_name'] = $user['last_name'];
        $_SESSION['role'] = $user['role'];

        $this->goToDashboard($user['role']);
    }

    // logout
    public function logout() {
        $_SESSION = array();
        session_destroy();
        header("Location: /login");
        exit;
    }

    private function goToDashboard($role) {
        if ($role == 'admin') {
            header("Location: /admin/dashboard");
        }
        else if ($role == 'teacher') {
            header("Location: /teacher/dashboard");
        }
        else if ($role == 'therapist') {
            header("Location: /therapist/dashboard");
        }
        else if ($role == 'nurse') {
            header("Location: /nurse/dashboard");
        }
        else if ($role == 'parent') {
            header("Location: /parent/dashboard");
        }
        else if ($role == 'boarding_staff') {
            header("Location: /boarding/dashboard");
        }
        else if ($role == 'security_guard') {
            header("Location: /security/dashboard");
        }
        else {
            header("Location: /login");
        }
        exit;
    }
}
?>
