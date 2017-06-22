<?php
	include "../dbconn.php";
	echo "<meta charset='UTF-8'>";

	$sql = "delete from community_yks where idx='{$_GET['idx']}'";
	$go = mysql_query($sql);

	alert('게시글이 정상적으로 삭제되었습니다.');
	location('../index.php');
?>