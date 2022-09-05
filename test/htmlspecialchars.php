<!-- htmlspecialchars() 연습 -->
<!-- https://b.redinfo.co.kr/56 -->

<!-- ex 1. -->
<?php
$entity = "<b>b 요소가 삭제 되어 출력화면에 나타난다.</b>";
echo $entity;
echo '<br>';
echo htmlspecialchars($entity);
echo '<br>';
?>

<!-- ex 2. -->
<?php
$entity = "<?php echo 'php 구문도 엔티티로 변환이 된다.'; ?>";
echo htmlspecialchars($entity);
?>