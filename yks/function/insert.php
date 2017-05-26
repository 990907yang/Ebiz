<?php
	include "../dbconn.php";
	echo "<meta charset='UTF-8'>";

	$sql = "insert into community_yks set title='{$_POST['title']}',writer='{$_POST['writer']}',password='{$_POST['password']}',text='{$_POST['text']}'";
	$go = mysql_query($sql);
	?>
		<script>
			alert('글쓰기가 완료되었습니다.');
			location.href="../index.php";
		</script>
		<?php
?>