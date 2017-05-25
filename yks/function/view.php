<?php
	include '../dbconn.php';
	session_start();

	$session = "";
	$name = "gsp";
	$idx = $_GET['idx'];
	
	$explode = explode(",",$session);
	
	$hit = 0;

	for($i = 0; $i < sizeof($explode); $i++){
		if($explode[$i] == $name."-".$idx){
			$hit = 1;
			break;
			}
		}
		if($hit == 0){
			$session.=",".$name."-".$idx;

			$updatesql = "update community_yks set count = count+1 where idx='{$_GET['idx']}'";
			$updatesql_go = mysql_query($updatesql,$dbconn);
   }
   $sql = "select * from community_yks where idx='{$_GET['idx']}'";
   $re = mysql_query($sql,$dbconn);
?>
<!doctype html>
<html lang="ko">
<head>
	<meta charset="UTF-8">
	<title>view</title>
	<link rel="stylesheet" href="../css/style.css">
</head>
<body>
	<div class="wrap">
		<header id="header"></header>
		<section id="section">
			<h2>VIEW</h2>

			<div class="board">
				<div class="view">
					<?php
						while($result=mysql_fetch_array($re)){
						$text = nl2br($result['text']);
					?>
					<div class="v_idx"><?=$result['idx']?></div>
					<div class="v_title"><?=$result['title']?></div>
					<div class="v_writer"><?=$result['writer']?></div>
					<div class="v_count">조회수:<?=$result['count']?></div>
					<div class="v_text"><?=$text?></div>
				</div>
					<a href="../index.php" class="write_btn">목록</a>
					<a href="./update.php?idx=<?=$result['idx']?>" class="write_btn">수정</a>
					<a href="./delete_ok.php?idx=<?=$result['idx']?>" class="write_btn">삭제</a>
					<?php
						}
					?>
			</div>
		</section>
		<footer id="footer"></footer>
	</div>
</body>
</html>