<?php
$dbconn = @mysql_connect("114.108.168.27:3306", "ebizgame", "ebizgame!!@#^^#@!!~") or die("����Ÿ���̽� ���� ���� ( Main )");
$selectdb = @mysql_select_db("2sin", $dbconn) or die("����Ÿ���̽� ���ÿ���"); 
@mysql_query("set session character_set_connetcion=utf8;");
@mysql_query("set session character_set_results=utf8;");
@mysql_query("set session character_set_client=utf8;");
@mysql_query("set names utf-8", $dbconn);
?>