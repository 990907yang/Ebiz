<?php
	include "../dbconn.php";
	$sql = "insert into community_yks set title='{$_POST['title']}',writer='{$_POST['writer']}',password='{$_POST['password']}',text='{$_POST['text']}'";
	$go = mysql_query($sql);
?>
<script>
	location.href="../index.php";
</script>