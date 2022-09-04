<?php
class Database
{
  // DB 매개 변수
  private $host = 'localhost';
  private $db_name = 'myblog';
  private $username = 'root';
  private $password = '';
  private $conn;

  // DB 연결
  public function connect()
  {
    $this->conn = null;

    try {
      $this->conn = new PDO("mysql:host=$this->host;dbname=$this->db_name,$this->username,$this->password");
      $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    } catch (Exception $e) {
      echo '연결 에러 : ' . $e->getMessage();
    }

    return $this->conn;
  }
}