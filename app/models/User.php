<?php
require_once __DIR__ . '/../../config/database.php';
//fatima code

/* this class handles everything related to users in the database
to achieve this we used the pdo extension and followed the W3school tutorial in this website: https://www.w3schools.com/php/php_mysql_connect.asp
me and saja are both working on the foundational classes and then we will divide the work by models as backedn and frontend to work in parallel and avoid conflicts.
*/
class User extends Database {

    //find user by email
    public function getByEmail($email) {
        $db = $this->connect();
        $query = $db->prepare("SELECT * FROM users WHERE email = ? AND is_active = 1");
        $query->execute([$email]);
        return $query->fetch(PDO::FETCH_ASSOC); //return one row of rhe db as a named array (using column names and not numbers, ahsan men el fetch() func)
    }

    //find user by id
    public function getById($id) {
        $db = $this->connect();
        $query = $db->prepare("SELECT * FROM users WHERE id = ? AND is_active = 1");
        $query->execute([$id]);
        return $query->fetch(PDO::FETCH_ASSOC);
    }

    //get all users
    public function getAll() {
        $db = $this->connect();
        $query = $db->prepare("SELECT * FROM users WHERE is_active = 1 ORDER BY first_name");//sorted by first name inn alpahbetical order
        $query->execute();
        return $query->fetchAll(PDO::FETCH_ASSOC);// fetchAll to return all rows as array of arrays
    }

    //get all users with a specific role ex all teacherss or all therapists
    public function getByRole($role) {
        $db = $this->connect();
        $query = $db->prepare("SELECT * FROM users WHERE role = ? AND is_active = 1 ORDER BY first_name");
        $query->execute([$role]);
        return $query->fetchAll(PDO::FETCH_ASSOC);
    }

    //add user to db
    public function create($email, $password, $firstName, $lastName, $role) {
        $db = $this->connect();
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT); // here the pass hash with builtin php func 
        $query = $db->prepare("INSERT INTO users (email, password, first_name, last_name, role) VALUES (?, ?, ?, ?, ?)");
        return $query->execute([$email, $hashedPassword, $firstName, $lastName, $role]);
    }

    //check if the password matches the stored hash
    public function verifyPassword($password, $hash) {
        return password_verify($password, $hash);
    }

    //update user info
    public function update($id, $email, $firstName, $lastName, $role) {
        $db = $this->connect();
        $query = $db->prepare("UPDATE users SET email = ?, first_name = ?, last_name = ?, role = ? WHERE id = ?");
        return $query->execute([$email, $firstName, $lastName, $role, $id]);
    }

    //deactivate a user not delete
    public function delete($id) {
        $db = $this->connect();
        $query = $db->prepare("UPDATE users SET is_active = 0 WHERE id = ?");
        return $query->execute([$id]);
    }

    //count how many active users we have
    public function count() {
        $db = $this->connect();
        $query = $db->query("SELECT COUNT(*) as total FROM users WHERE is_active = 1");// no prepare needed cz no input
        $result = $query->fetch(PDO::FETCH_ASSOC);
        return $result['total'];
    }

    // Saja code 17/5

    // deactivate user
    public function deactivate($id) {
        $db = $this->connect();
        $query = $db->prepare("UPDATE users SET is_active = 0 WHERE id = ?");
        return $query->execute([$id]);
    }

    // reactivate user
    public function reactivate($id) {
        $db = $this->connect();
        $query = $db->prepare("UPDATE users SET is_active = 1 WHERE id = ?");
        return $query->execute([$id]);
    }

    public function getActiveByRole($role) {
        $db = $this->connect();
        $query = $db->prepare("SELECT * FROM users WHERE role = ? AND is_active = 1 ORDER BY first_name");
        $query->execute([strtolower($role)]);
        return $query->fetchAll(PDO::FETCH_ASSOC);
    }
}

?>