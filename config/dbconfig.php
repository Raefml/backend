<?php
class Database {
    private $host = "localhost";
    private $db_name = "foodieshub";
    private $username = "root";
    private $password = "";
    private $port = 3306; // Port MySQL par défaut
    public $conn;

    public function getConnection(){
        $this->conn = null;

        try{
            $this->conn = new PDO("mysql:host=" . $this->host . ";port=" . $this->port . ";dbname=" . $this->db_name, $this->username, $this->password);
            $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
           
        }catch(PDOException $exception){
            echo "Erreur de connexion : " . $exception->getMessage();
        }

        return $this->conn;
    }
}

$database = new Database();
$database->getConnection();
?>
