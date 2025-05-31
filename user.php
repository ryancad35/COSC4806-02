<?php 
require_once('database.php');

Class User {
    public function get_all_users () {
        $db = db_connect();
        $sql = "SELECT * FROM users";
        $stmt = $db->prepare($sql);
        $stmt->execute();
        $rows = $stmt->fetch(PDO::FETCH_ASSOC);
        return $rows;
    }
}
    