<?php
// Class handling db connection
class DbConnect {
    protected $db;

    function __construct() {
        $this->db = new mysqli(DBHOST, DBUSER, DBPASS, DBDATABASE);
        if($this->db->connect_errno > 0){
            die("Fel vid anslutning: " . $this->db->connect_error);
        }
    }
    public function __destruct() {
        $this->db->close()
            OR die("There was a problem disconnecting from the database.");
    }
}