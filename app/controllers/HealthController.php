<?php

/* Health Controller - Saja 17/5 */

require_once __DIR__ . '/../models/Nurse.php';
require_once __DIR__ . '/../models/User.php';

class HealthController {
    private $nurseModel;
    private $userModel;

    public function __construct() {
        $this->nurseModel = new Nurse();
        $this->userModel = new User();

        if (!Session::check('nurse')) {
            header('Location: /login');
            exit();
        }
    }
    public function getNurseById($id) {
        return $this->userModel->getById($id);
    }
    public function getActiveMedications($student_id) {
        return $this->nurseModel->getActiveMedicationsByStudent($student_id);
    }
    public function getMedicationHistory($student_id) {
        return $this->nurseModel->getMedicationHistoryByStudentId($student_id);
    }
    public function addMedication($student_id, $name, $dosage, $frequency, $notes, $added_by) {
        return $this->nurseModel->addMedication($student_id, $name, $dosage, $frequency, $notes, $added_by);
    }
    public function updateMedication($id, $name, $dosage, $frequency, $notes) {
        return $this->nurseModel->updateMedication($id, $name, $dosage, $frequency, $notes);
    }
    public function deactivateMedication($id) {
        return $this->nurseModel->deactivateMedication($id);
    }
    public function reactivateMedication($id) {
        return $this->nurseModel->reactivateMedication($id);
    }

    public function logDose($medication_id, $administered_by, $administered_at, $notes) {
        return $this->nurseModel->logDose($medication_id, $administered_by, $administered_at, $notes);
    }
    public function getMedicationLogs($medication_id) {
        return $this->nurseModel->getMedicationLogs($medication_id);
    }
    public function logHealthEvent($student_id, $description, $severity, $action_taken, $recorded_by) {
        $result = $this->nurseModel->logHealthEvent($student_id, $description, $severity, $action_taken, $recorded_by);
        if (in_array($severity, ['medium', 'high'])) {
            // TODO: notify parent
        }
        return $result;
    }
    public function getHealthEventsByStudent($student_id) {
        return $this->nurseModel->getHealthEventsByStudentId($student_id);
    }
    public function getHealthEventById($id) {
        return $this->nurseModel->getHealthEventById($id);
    }

    public function getHealthRecordsByStudent($student_id) {
        $medications = $this->nurseModel->getMedicationHistoryByStudentId($student_id);
        $healthEvents = $this->nurseModel->getHealthEventsByStudentId($student_id);
        return [
            'medications' => $medications,
            'health_events' => $healthEvents
        ];
    }

    public function getHealthSummary($student_id, $from, $to) {
        return $this->nurseModel->getHealthSummary($student_id, $from, $to);
    }
}
?>