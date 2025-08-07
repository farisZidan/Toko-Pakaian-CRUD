<?php
require_once '../../config/config.php';

class Database {
    private $host = 'DB_HOST';
    private $dbname = 'DB_NAME';
    private $username = 'DB_USER';
    private $password = 'DB_PASS';
    public $db;

    public function getConnection() {
        $this->db = null;
        try {
            $this->db = new PDO("mysql:host={$this->host};dbname={$this->dbname}", $this->username, $this->password);
            $this->db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $exception) {
            die("Database error: " . $exception->getMessage());
        }
        return $this->db;
    }

}
?>