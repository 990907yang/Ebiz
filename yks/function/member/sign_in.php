<?php
	include '../../dbconn.php';
?>
<!doctype html>
<html lang="ko">
<head>
	<meta charset="UTF-8">
	<title>sign_in</title>
	<link rel="stylesheet" href="../../css/style.css">
	<script src="http://code.jquery.com/jquery-latest.min.js"></script>
	<script src="../../js/a.js"></script>
</head>
<body>
	<div class="wrap">
		<header id="header"></header>
		<section id="section">
			<h2>SIGN IN</h2>

			<div class="sign_in_table">
				<form action="./sign_in_ok.php" method="post">
					<div class="sign_box">
						<input type="text" name="id" placeholder="ID">
						<input type="password" name="password" placeholder="PASSWORD">
					</div>
					<button class="sign_in_btn">로그인</button>
				</form>
			</div>
		</section>
		<footer id="footer"></footer>
	</div>
</body>
</html>