<?php
	$dbconn = @mysql_connect("114.108.168.27:3306", "ebizgame", "ebizgame!!@#^^#@!!~") or die("데이타베이스 연결 실패 ( Main )");
	$selectdb = @mysql_select_db("2sin", $dbconn) or die("데이타베이스 선택에러");
	@mysql_query("set session character_set_connetcion=utf8;");
	@mysql_query("set session character_set_results=utf8;");
	@mysql_query("set session character_set_client=utf8;");
	@mysql_query("set names utf-8", $dbconn);
	session_start();

	function alert($msg){
		echo "<script>alert('{$msg}')</script>";
	}
	function back(){
		echo "<script>history.go(-1)</script>";
	}
	function location($url){
		echo "<script>location.href='{$url}'</script>";
	}
?>