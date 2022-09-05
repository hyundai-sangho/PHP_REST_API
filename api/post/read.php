<?php
// Headers
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');

include_once '../../config/Database.php';
include_once '../../models/Post.php';

// DB 인스턴스화 & 연결
$database = new Database();
$db = $database->connect();

// 블로그 게시물 개체를 인스턴스화합니다.
$post = new Post($db);

// 블로그 게시물 쿼리
$result = $post->read();

// 행 카운트를 얻으십시오.
$num = $result->rowCount();

// 게시물이 있는지 확인하십시오
if ($num > 0) {
  // Post array
  $posts_arr = array();
  $posts_arr['data'] = array();

  while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
    extract($row);

    $post_item = array(
      'id' => $id,
      'title' => $title,
      'body' => html_entity_decode($body),
      'author' => $author,
      'category_id' => $category_id,
      'category_name' => $category_name,
    );
    // Push to "data"
    array_push($posts_arr['data'], $post_item);
  }

  // Turn to JSON & output
  echo json_encode($posts_arr);
} else {
  // No Posts
  echo json_encode(
    array('message' => 'No Posts Found')
  );
}