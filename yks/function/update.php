<?php
	include '../dbconn.php';
	$sql = "select * from community_yks where idx = '{$_GET['idx']}'";
	$go = mysql_query($sql);
?>
<!doctype html>
<html lang="ko">
<head>
	<meta charset="UTF-8">
	<title>update</title>
	<link rel="stylesheet" href="../css/style.css">
	<script src="http://code.jquery.com/jquery-latest.min.js"></script>
	<script src="../js/a.js"></script>
</head>
<body>
	<div class="wrap">
		<header id="header"></header>
		<section id="section">
			<h2>UPDATE</h2>

			<div class="board">
				<div class="writing">
				<?php
					while($re=mysql_fetch_array($go)){
				?>
					<form action="./modify.php?idx=<?=$re['idx']?>" method="post" name="w_form">
						<input type="text" class="title" name="title" placeholder="제목" value="<?=$re['title']?>">
						<input type="text" class="writer"name="writer" placeholder="작성자" value="<?=$re['writer']?>">
						<input type="password" class="password" name="password" placeholder="비밀번호를 입력하세요">
						<textarea class="textar" name="text" placeholder="내용을 입력해 주세요."><?=$re['text']?></textarea>

						<button type="submit" class="write_btn">수정</button>
						<a href="../index.php" class="write_btn">취소</a>
					</form>
					<?php
						}	
					?>
				</div>
			</div>
		</section>
		<footer id="footer"></footer>
	</div>
</body>
</html>