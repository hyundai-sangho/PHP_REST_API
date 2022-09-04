<?php

// require_once 'config/Database.php';

class Post
{
  // DB 연결 변수
  private $conn;
  private $table = 'posts';

  // Post 속성
  public $id;
  public $category_id;
  public $category_name;
  public $title;
  public $body;
  public $author;
  public $created_at;

  // DB 생성자
  public function __construct($db)
  {
    $this->conn = $db;
  }

  // Posts 가져오기
  public function read()
  {
    // 쿼리 생성
    $query = 'SELECT 
    c.name as category_name, 
    p.id, 
    p.category_id,
    p.title, 
    p.body,
    p.author, 
    p.created_at 
      FROM' . $this->table . ' p 
    LEFT JOIN 
      categories c ON p.category_id = c.id 
    ORDER BY 
      p.created_at DESC';

    // Prepare statement
    $stmt = $this->conn->prepare($query);

    // Execute query
    $stmt->execute();

    return $stmt;
  }
}