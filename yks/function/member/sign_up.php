<!doctype html>
<html lang="ko">
<head>
	<meta charset="UTF-8">
	<title>sign_up</title>
	<link rel="stylesheet" href="../../css/style.css">
	<script src="http://code.jquery.com/jquery-latest.min.js"></script>
	<script src="../../js/a.js"></script>
</head>
<body>
	<div class="wrap">
		<header id="header"></header>
		<section id="section">
			<h2>SIGN UP</h2>

			<div class="sign_up_table">
				<form action="./member_insert.php" method="post" class="sign_form">
					<div class="sign_up_name"><span>이름 : </span><input type="text" class="s_name" name="name" placeholder="이름"></div>
					<div class="sign_up_id"><span>아이디 : </span><input type="text" name="id" id="uid" placeholder="ID"><p id="id_ck"></p></div>
					<div class="sign_up_pw"><span>비밀번호 : </span><input type="password" name="password" id="upw" placeholder="비밀번호"></div>
					<div class="sign_up_pw_ok"><span>비밀번호 확인 : </span><input type="password" name="password_ok" id="upw_ok" placeholder="비밀번호 확인"></div>
					<div class="sign_up_email"><span>이메일 : </span><input type="text" name="email" id="uemail" placeholder="이메일"></div>
					<button class="sign_up_btn">가입</button>
				</form>
			</div>
		</section>
		<footer id="footer"></footer>
	</div>
</body>
</html>