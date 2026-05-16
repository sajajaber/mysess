<?php
// Nurse model - Saja 16/5 11:30

require_once __DIR__ . '/../../config/database.php';
class Nurse extends Database {

    //active nurse
    public function getAll() {
        $db = $this->connect();
        $query = $db->prepare("SELECT * FROM users WHERE is_active = 1 AND role = 'nurse' ORDER BY first_name");
        $query->execute();
        return $query->fetchAll(PDO::FETCH_ASSOC);
    }

    // nurse by ID
    public function getById($id) {
        $db = $this->connect();
        $query = $db->prepare("SELECT id, first_name, last_name, email, phone, is_active 
         FROM users 
         WHERE id = ? AND role = 'nurse' AND is_active = 1");
        $query->execute([$id]);
        return $query->fetch(PDO::FETCH_ASSOC);
    }

    // we are not implementing add nurse functionnality, as nurses are added as regular users with role nurse, and they receive an email to set their password and activate their account. -saja 16/5 11:30

    //update nurse info
    public function update($id, $firstName, $lastName, $email, $phone) {
        $db = $this->connect();
        $query = $db->prepare("
        UPDATE users SET first_name = ?, last_name = ?, email = ?, phone = ?
        WHERE id = ? AND role = 'nurse'");
        return $query->execute([$firstName, $lastName, $email, $phone, $id]);
    }

    //deact nurse
    public function delete($id) {
        $db = $this->connect();
        $query = $db->prepare("UPDATE nurses SET is_active = 0 WHERE id = ?");
        return $query->execute([$id]);
    }
}

?>