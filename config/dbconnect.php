<?php
class DBController {
    protected $db;

    function __construct() {
        $this->db = $this->connectDB();
    }
    function __destruct() {
		mysqli_close($this->connectDB());
    }

    private function connectDB() {
        require_once 'config.php';
        $conn = new mysqli(DB_HOST, DB_USER, DB_PASSWORD, DB_DATABASE);
        return $conn; 
    }

}
?>
