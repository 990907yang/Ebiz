<?php
	include '../dbconn.php';
	$sql = "select * from community_yks where idx='{$_GET['idx']}'";
	$result = mysql_query($sql);
?>
<!doctype html>
<html lang="ko">
<head>
	<meta charset="UTF-8">
	<title>delete</title>
	<link rel="stylesheet" href="../css/style.css">
	<script src="http://code.jquery.com/jquery-latest.min.js"></script>
	<script src="../js/a.js"></script>
</head>
<body>
	<div class="wrap">
		<header id="header"></header>
		<section id="section">
			<h2>DELETE</h2>

			<div class="board">
			<?php
				while($re=mysql_fetch_array($result)){
			?>
				<form action="./delete.php?idx=<?=$re['idx']?>" method="post" class="del_form">
					<p>비밀번호 확인 후 게시글 삭제가 가능합니다.</p>
					<input type="password" name="pass_ok" class="del_in">
					<button class="del_btn">삭제하기</button>
				</form>
				<?php
			}	
			?>
			</div>
		</section>
		<footer id="footer"></footer>
	</div>
</body>
</html>