<?php
	include_once "../../dbconn.php";

	$sql = "select * from member_yks where id='{$_POST['id']}'";

	$result = mysql_query($sql,$dbconn);

	while( $row = mysql_fetch_array($result) ){
		echo isset($row[0]) ? "중복된 아이디입니다." : "중복되지 않은 아이디 입니다.";
	}
?>