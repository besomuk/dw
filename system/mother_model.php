<?php
require ("config/db.php");

class MotherModel
{
    public $db;
    
    public function connect ()
    {
        $this->db = new PDO("mysql:host=".DB_HOST.";dbname=".DB_DATABASE.";charset=utf8mb4", DB_USER, DB_PASSWORD, array(PDO::ATTR_EMULATE_PREPARES => false, PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));        
    }
}

?>