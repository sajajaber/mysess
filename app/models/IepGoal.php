
<?php
//fatima 16-05, this is the code of the iep goals management wiht the db and progress tracking
//the same strategy to get with pdo i followed the same steps as the student.php model 
require_once __DIR__ . '/../../config/database.php';
class IEPGoal extends Database {

    //ret the iep goals for a student by his id
        public function getByStudent($studentId) {
        $db = $this->connect();
        $query = $db->prepare("SELECT * FROM iep_goals WHERE student_id = ? ORDER BY created_at DESC");
        $query->execute([$studentId]);
        return $query->fetchAll(PDO::FETCH_ASSOC);
    }

    //ret the iep goal by its id
         public function getById($id) {
        $db = $this->connect();
        $query = $db->prepare("SELECT * FROM iep_goals WHERE id = ?");
        $query->execute([$id]);
        return $query->fetch(PDO::FETCH_ASSOC);
         }

    //ret all actv goal
        public function getActive() {
        $db = $this->connect();
        $query = $db->prepare("SELECT * FROM iep_goals WHERE status = 'active' ORDER BY target_date");
        $query->execute();
        return $query->fetchAll(PDO::FETCH_ASSOC);

        }

    //new goal
    public function create($studentId, $goalText, $targetDate, $category, $createdBy) {
        $db = $this->connect();
        $query = $db->prepare("
            INSERT INTO iep_goals (student_id, goal_text, target_date, category, created_by) VALUES (?, ?, ?, ?, ?)");
        return $query->execute([$studentId, $goalText, $targetDate, $category, $createdBy]);
    }

    //update goal status
    public function updateStatus($id, $status) {
        $db = $this->connect();
        $query = $db->prepare("UPDATE iep_goals SET status = ? WHERE id = ?");
        return $query->execute([$status, $id]);
    }

    //log progress percent(score 0-100)
    public function logProgress($goalId, $score, $notes, $recordedBy) {
        $db = $this->connect();
        $query = $db->prepare("
            INSERT INTO goal_progress (goal_id, score, notes, recorded_by) VALUES (?, ?, ?, ?)");
        return $query->execute([$goalId, $score, $notes, $recordedBy]);
  }

    //get all the progress details for chosen iepp goal
    public function getProgress($goalId) {
        $db = $this->connect();
        $query = $db->prepare("SELECT * FROM goal_progress WHERE goal_id = ? ORDER BY recorded_at DESC");
        $query->execute([$goalId]);
        return $query->fetchAll(PDO::FETCH_ASSOC);
    }

    //count the number of active goals for a selected student
    public function countByStudent($studentId) {
        $db = $this->connect();
        $query = $db->prepare("SELECT COUNT(*) as total FROM iep_goals WHERE student_id = ? AND status = 'active'");
        $query->execute([$studentId]);
        $result = $query->fetch(PDO::FETCH_ASSOC);
        return $result['total'];
    }
}
?>