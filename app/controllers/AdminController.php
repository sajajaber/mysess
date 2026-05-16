<?php
require_once __DIR__ . '/../../core/Session.php';
require_once __DIR__ . '/../models/User.php';
require_once __DIR__ . '/../models/Student.php';

class AdminController {

public function dashboard() {
      Session::check('admin');
        $userModel = new User();
        $studentModel = new Student();
        $totalUsers = $userModel->count();
        $totalStudents = $studentModel->count();
        require __DIR__ . '/../views/admin/dashboard.php';
    }

public function users() {
        Session::check('admin');
        $userModel = new User();
        $users = $userModel->getAll();
        require __DIR__ . '/../views/admin/users/users.php';
    }

 public function students() {
        Session::check('admin');
        $studentModel = new Student();
        $students = $studentModel->getAll();
        require __DIR__ . '/../views/admin/students/students.php';
    }
}
?>