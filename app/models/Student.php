<?php
//fatima student code
//ref helped a lot to rev abt pdo prepared statements conn-prep-exe-ret tb checked by saja https://www.w3schools.com/php/php_mysql_prepared_statements.asp

require_once __DIR__ . '/../../config/database.php';
class Student extends Database {

    //active std
    public function getAll() {
        $db = $this->connect();
        $query = $db->prepare("SELECT * FROM students WHERE is_active = 1 ORDER BY first_name");
        $query->execute();
        return $query->fetchAll(PDO::FETCH_ASSOC);
    }

    // student byid
    public function getById($id) {
        $db = $this->connect();
        $query = $db->prepare("SELECT * FROM students WHERE id = ? AND is_active = 1");
        $query->execute([$id]);
        return $query->fetch(PDO::FETCH_ASSOC);
    }

    //all std to 1 parent/guardian 
    public function getByGuardian($guardianId) {
        $db = $this->connect();
        $query = $db->prepare("SELECT * FROM students WHERE guardian_id = ? AND is_active = 1");
        $query->execute([$guardianId]);
        return $query->fetchAll(PDO::FETCH_ASSOC);
    }

    //all stds to a specific tth with join
    public function getByStaff($userId) {
        $db = $this->connect();
        $query = $db->prepare("
        SELECT s.* FROM students s
        JOIN student_assignments sa ON s.id = sa.student_id WHERE sa.user_id = ? AND sa.end_date IS NULL AND s.is_active = 1
            ORDER BY s.first_name");
        $query->execute([$userId]);
        return $query->fetchAll(PDO::FETCH_ASSOC);
    }

        //add std
    public function create($firstName, $lastName, $dob, $gender, $diagnosis, $enrollmentDate, $guardianId) {
        $db = $this->connect();
        $query = $db->prepare("
            INSERT INTO students (first_name, last_name, date_of_birth, gender, diagnosis, enrollment_date, guardian_id) 
            VALUES (?, ?, ?, ?, ?, ?, ?)");
        return $query->execute([$firstName, $lastName, $dob, $gender, $diagnosis, $enrollmentDate, $guardianId]);
    }

    //update std info
    public function update($id, $firstName, $lastName, $dob, $gender, $diagnosis) {
        $db = $this->connect();
        $query = $db->prepare("
        UPDATE students SET first_name = ?, last_name = ?, date_of_birth = ?, gender = ?, diagnosis = ?
        WHERE id = ? ");
        return $query->execute([$firstName, $lastName, $dob, $gender, $diagnosis, $id]);
    }

    //deact std
    public function delete($id) {
        $db = $this->connect();
        $query = $db->prepare("UPDATE students SET is_active = 0 WHERE id = ?");
        return $query->execute([$id]);
    }

    //count tot act stds
    public function count() {
        $db = $this->connect();
        $query = $db->query("SELECT COUNT(*) as total FROM students WHERE is_active = 1");
        $result = $query->fetch(PDO::FETCH_ASSOC);
        return $result['total'];
    }

    //assign a t or th to 1 std
    public function assignStaff($studentId, $userId, $roleType) {
        $db = $this->connect();
        $query = $db->prepare("INSERT INTO student_assignments (student_id, user_id, role_type, start_date) VALUES (?, ?, ?, CURDATE())");
        return $query->execute([$studentId, $userId, $roleType]);
    }
}
?>
