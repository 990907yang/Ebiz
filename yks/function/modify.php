<?php
	include "../dbconn.php";
	echo "<meta charset='UTF-8'>";
	
	$sql = "update community_yks set title='{$_POST['title']}',writer='{$_POST['writer']}',text='{$_POST['text']}' where idx='{$_GET['idx']}'";
	$go = mysql_query($sql);

	alert('수정이 완료되었습니다.');
	location('../index.php');
?>