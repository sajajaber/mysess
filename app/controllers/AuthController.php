
<?php
//fatima code
//i worked through this tutorial to get some login tips https://codeshack.io/secure-login-system-php-mysql/

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
        header("Location: /MySESS_Senior_Project/public/login");
        exit;
    }

    private function goToDashboard($role) {
        if ($role == 'admin') {
            header("Location: /MySESS_Senior_Project/public/admin/dashboard");
        }
        else if ($role == 'teacher') {
            header("Location: /MySESS_Senior_Project/public/teacher/dashboard");
        }
        else if ($role == 'therapist') {
            header("Location: /MySESS_Senior_Project/public/therapist/dashboard");
        }
        else if ($role == 'nurse') {
            header("Location: /MySESS_Senior_Project/public/nurse/dashboard");
        }
        else if ($role == 'parent') {
            header("Location: /MySESS_Senior_Project/public/parent/dashboard");
        }
        else if ($role == 'boarding_staff') {
            header("Location: /MySESS_Senior_Project/public/boarding/dashboard");
        }
        else if ($role == 'security_guard') {
            header("Location: /MySESS_Senior_Project/public/security/dashboard");
        }
        else {
            header("Location: /MySESS_Senior_Project/public/login");
        }
        exit;
    }
}
?>
