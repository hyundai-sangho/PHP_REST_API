<?php
// Headers
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');

include_once '../../config/Database.php';
include_once '../../models/Category.php';

// DB 인스턴스화 & 연결
$database = new Database();
$db = $database->connect();

// 블로그 카테고리 개체를 인스턴스화합니다.
$category = new Category($db);

// 카테고리 read 쿼리
$result = $category->read();

// 행 카운트를 얻으십시오.
$num = $result->rowCount();

// 카테고리가 있는지 확인하십시오
if ($num > 0) {
  // Post array
  $cat_arr = array();
  $cat_arr['data'] = array();

  while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
    extract($row);

    $cat_item = array(
      'id' => $id,
      'name' => $name,
    );

    // Push to "data"
    array_push($cat_arr['data'], $cat_item);
  }

  // Turn to JSON & output
  echo json_encode($cat_arr);
} else {
  // No Categories
  echo json_encode(
    array('message' => 'No Categories Found')
  );
}