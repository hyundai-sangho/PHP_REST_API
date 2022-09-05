<!-- https://www.codingfactory.net/10073 -->
<!-- strip_tags() 연습 -->
<!doctype html>
<html lang="ko">

  <head>
    <meta charset="utf-8">
    <title>PHP</title>
    <style>
    body {
      font-family: sans-serif;
    }
    </style>
  </head>

  <body>
    <p>원판</p>
    <?php
  $jb_text = '<p style="color: green;">Lorem <a href="amet">Ipsum</a> Dolor.</p>';
  echo $jb_text;
  ?>
    <p>모든 태그 제거</p>
    <?php
  echo strip_tags($jb_text);
  ?>
    <br>
    <p>a 태그만 남기기</p>
    <?php
  echo strip_tags($jb_text, '<a>');
  ?>
  </body>

</html>