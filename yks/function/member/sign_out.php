<?php
	include "../../dbconn.php";
	echo "<meta charset='UTF-8'>";
	alert('로그아웃 되었습니다.');
	session_destroy();
	back();
?>