<?php
// Nurse model - Saja 16/5

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

    // we are not implementing add nurse functionality, as nurses are added as regular users with role nurse, and they receive an email to set their password and activate their account. -saja 16/5

    // Medications - Saja 16/5 

    // get all active medications for a student
    public function getActiveMedicationsByStudentId($student_id) {
        $db = $this->connect();
        $query = $db->prepare("SELECT * FROM medications WHERE student_id = ? AND is_active = 1");
        $query->execute([$student_id]);
        return $query->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getMedicationHistoryByStudentId($student_id) {
        $db = $this->connect();
        $query = $db->prepare("SELECT * FROM medications WHERE student_id = ? ORDER BY created_at DESC");
        $query->execute([$student_id]);
        return $query->fetchAll(PDO::FETCH_ASSOC);
    }   
    
    public function addMedication($student_id, $name, $dosage, $frequency, $notes, $added_by) {
        $db = $this->connect();
        $query = $db->prepare("INSERT INTO medications (student_id, name, dosage, frequency, notes, added_by) VALUES (?, ?, ?, ?, ?, ?)");
        return $query->execute([$student_id, $name, $dosage, $frequency, $notes, $added_by]);
    }

    public function updateMedication($id, $name, $dosage, $frequency, $notes) {
        $db = $this->connect();
        $query = $db->prepare("UPDATE medications SET name = ?, dosage = ?, frequency = ?, notes = ? WHERE id = ?");
        return $query->execute([$name, $dosage, $frequency, $notes, $id]);
    }

    public function deactivateMedication($id) {
        $db = $this->connect();
        $query = $db->prepare("UPDATE medications SET is_active = 0 WHERE id = ?");
        return $query->execute([$id]);
    }

    public function reactivateMedication($id) {
        $db = $this->connect();
        $query = $db->prepare("UPDATE medications SET is_active = 1 WHERE id = ?");
        return $query->execute([$id]);
    }

    public function logDose($medication_id, $administered_by, $administered_at, $notes) {
        $db = $this->connect();
        $query = $db->prepare("INSERT INTO medication_logs (medication_id, administered_by, administered_at, notes) VALUES (?, ?, ?, ?)");
        return $query->execute([$medication_id, $administered_by, $administered_at, $notes]);
    }

    public function getMedicationLogs($medication_id) {
        $db = $this->connect();
        $query = $db->prepare("SELECT * FROM medication_logs WHERE medication_id = ? ORDER BY administered_at DESC");
        $query->execute([$medication_id]);
        return $query->fetchAll(PDO::FETCH_ASSOC);
    }

    public function logHealthEvent($student_id, $description, $severity, $action_taken, $recorded_by) {
        $db = $this->connect();
        $query = $db->prepare("INSERT INTO health_events (student_id, description, severity, action_taken, recorded_by) VALUES (?, ?, ?, ?, ?)");
        return $query->execute([$student_id, $description, $severity, $action_taken, $recorded_by]);
    }

    public function getHealthEventsByStudentId($student_id) {
        $db = $this->connect();
        $query = $db->prepare("SELECT * FROM health_events WHERE student_id = ? ORDER BY recorded_at DESC");
        $query->execute([$student_id]);
        return $query->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getHealthEventById($id) {
        $db = $this->connect();
        $query = $db->prepare("SELECT * FROM health_events WHERE id = ?");
        $query->execute([$id]);
        return $query->fetch(PDO::FETCH_ASSOC);
    }

    // Health records (allergies, medical notes)
    public function getHealthRecordsByStudentId($student_id) {
        $db = $this->connect();
        $query = $db->prepare("SELECT * FROM health_records WHERE student_id = ? ORDER BY recorded_at DESC");
        $query->execute([$student_id]);
        return $query->fetchAll(PDO::FETCH_ASSOC);
    }

    // Health summary for report generation
    public function getHealthSummary($student_id, $from, $to) {
        $db = $this->connect();
        $query = $db->prepare("SELECT * FROM health_events WHERE student_id = ? AND recorded_at BETWEEN ? AND ? ORDER BY recorded_at DESC");
        $query->execute([$student_id, $from, $to]);
        return $query->fetchAll(PDO::FETCH_ASSOC);
    }
    
}   