<?php
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
  FROM ' . $this->table . ' p 
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

  // Get Single Post
  public function read_single()
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
  FROM ' . $this->table . ' p 
  LEFT JOIN 
    categories c ON p.category_id = c.id 
  WHERE
    p.id = ?
  LIMIT 0,1';

    // Prepare statement
    $stmt = $this->conn->prepare($query);

    // Bind Id
    $stmt->bindParam(1, $this->id);

    // 쿼리 실행
    $stmt->execute();

    $row = $stmt->fetch(PDO::FETCH_ASSOC);

    // Set properties
    $this->title = $row['title'];
    $this->body = $row['body'];
    $this->author = $row['author'];
    $this->category_id = $row['category_id'];
    $this->category_name = $row['category_name'];
  }

  // Create Post
  public function create()
  {
    // Create query
    $query = "INSERT INTO $this->table SET
    title = :title,
    body = :body,
    author = :author,
    category_id = :category_id";

    // Prepare statement
    $stmt = $this->conn->prepare($query);

    // Clean data
    $this->title = htmlspecialchars(strip_tags($this->title));
    $this->body = htmlspecialchars(strip_tags($this->body));
    $this->author = htmlspecialchars(strip_tags($this->author));
    $this->category_id = htmlspecialchars(strip_tags($this->category_id));

    // Bind data
    $stmt->bindParam(':title', $this->title);
    $stmt->bindParam(':body', $this->body);
    $stmt->bindParam(':author', $this->author);
    $stmt->bindParam(':category_id', $this->category_id);

    // Execute query
    if ($stmt->execute()) {
      return true;
    }

    // Print error if something goes wrong
    printf("Error: %s. \n", $stmt->error);

    return false;
  }

  // Update Post
  public function update()
  {
    // Update query
    $query = "UPDATE $this->table SET
    title = :title,
    body = :body,
    author = :author,
    category_id = :category_id
    WHERE id = :id";

    // Prepare statement
    $stmt = $this->conn->prepare($query);

    // Clean data
    $this->title = htmlspecialchars(strip_tags($this->title));
    $this->body = htmlspecialchars(strip_tags($this->body));
    $this->author = htmlspecialchars(strip_tags($this->author));
    $this->category_id = htmlspecialchars(strip_tags($this->category_id));
    $this->id = htmlspecialchars(strip_tags($this->id));

    // Bind data
    $stmt->bindParam(':title', $this->title);
    $stmt->bindParam(':body', $this->body);
    $stmt->bindParam(':author', $this->author);
    $stmt->bindParam(':category_id', $this->category_id);
    $stmt->bindParam(':id', $this->id);

    // Execute query
    if ($stmt->execute()) {
      return true;
    }

    // Print error if something goes wrong
    printf("Error: %s. \n", $stmt->error);

    return false;
  }

  // Delete Post
  public function delete()
  {
    // Delete query"
    $query = "DELETE FROM $this->table WHERE id = :id";

    // Prepare statement
    $stmt = $this->conn->prepare($query);

    // Clean data
    $this->id = htmlspecialchars(strip_tags($this->id));

    // Bind data
    $stmt->bindParam(':id', $this->id);

    // Execute query
    if ($stmt->execute()) {
      return true;
    }

    // Print error if something goes wrong
    printf("Error: %s. \n", $stmt->error);

    return false;
  }
}