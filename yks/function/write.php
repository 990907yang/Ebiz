<?php
	include '../dbconn.php';
?>
<!doctype html>
<html lang="ko">
<head>
	<meta charset="UTF-8">
	<title>index</title>
	<link rel="stylesheet" href="../css/style.css">
	<script src="http://code.jquery.com/jquery-latest.min.js"></script>
	<script src="../js/a.js"></script>
</head>
<body>
	<div class="wrap">
		<header id="header"></header>
		<section id="section">
			<h2>WRITE</h2>

			<div class="board">
				<div class="writing">
					<form action="./insert.php" method="post" name="w_form">

						<input type="text" class="title" name="title" placeholder="제목">
						<input type="text" class="writer" name="writer" placeholder="작성자">
						<input type="password" class="password" name="password" placeholder="비밀번호">
						<textarea class="textar" name="text" placeholder="내용을 입력해 주세요."></textarea>

						<button type="submit" id="wrbt" class="write_btn" onclick="check()">글쓰기</button>
						<a href="../index.php" class="write_btn">취소</a>
					</form>
				</div>
			</div>
		</section>
		<footer id="footer"></footer>
	</div>
</body>
</html>