<?php
	include "../dbconn.php";
	$user_name = $_SESSION['user']['name'];
?>
<!doctype html>
<html lang="ko">
<head>
	<meta charset="UTF-8">
	<title>write</title>
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
					<form action="http://www.nolzzang.com/home/board/syndi_new/yks_insert.php" method="post" enctype="multipart/form-data">

						<input type="text" class="title" name="title" placeholder="제목">
						<input type="text" class="writer" name="writer" value="<?=$user_name?>" readonly>
						<textarea class="textar" name="text" placeholder="내용을 입력해 주세요." wrap="soft"></textarea>
						<div class="file_up">
							<input type="file" name="upload" id="file_box" class="fiel_up">
						</div>
						<button type="submit" id="wrbt" class="write_btn fiy">글쓰기</button>
						<a href="../index.php" class="write_btn">취소</a>
					</form>
				</div>
			</div>
		</section>
		<footer id="footer"></footer>
	</div>
</body>
</html>