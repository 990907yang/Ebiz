<?php
	include "../../dbconn.php";
	echo "<meta charset='UTF-8'>";
	
	$id = $_POST['id'];
	$pw = md5($_POST['password']);

	$sql = "select * from member_yks where id = '{$id}' and password = '{$pw}'";
	$go = mysql_query($sql,$dbconn);

	$row = mysql_num_rows($go);

	if($row == 1){
		while($re = mysql_fetch_array($go))
		$_SESSION['user'] = $re;
		alert('로그인 되었습니다.');
		location('/yks');
	}else{
			session_destroy();
			alert('아이디 또는 페스워드가 일치하지 않습니다.');
			location('./sign_in.php');
		}
?>