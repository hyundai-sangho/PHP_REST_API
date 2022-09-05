<?php
// Headers
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');
header('Access-Control-Allow-Methods: DELETE');
header('Access-Control-Allow-Headers: Access-Control-Allow-Headers, 
Content-Type, Access-Control-Allow-Methods, Authorization, X-Requested-With');

include_once '../../config/Database.php';
include_once '../../models/Post.php';

// DB 인스턴스화 & 연결
$database = new Database();
$db = $database->connect();

// Instantiate blog post object
$post = new Post($db);

// Get raw posted database
$data = json_decode(file_get_contents('php://input'));

// Set ID to update post
$post->id = $data->id;

// Delete post 
if ($post->delete()) {
  echo json_encode(
    array('message' => 'Post Deleted')
  );
} else {
  echo json_encode(
    array('message' => 'Post Not Deleted')
  );
}