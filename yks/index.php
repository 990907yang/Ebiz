<?php
	include './dbconn.php';
	session_start();

	$sql = "select * from community_yks order by idx desc";
	$result = mysql_query($sql);

	if($_SESSION['log_ok'] == 'YES'){
		$user_id = $_SESSION['user_id'];
		$msg = $user_id.'님 환영합니다.';
	}else{
		$msg = "";
		$_SESSION['log_ok']="NO";
		$("#logout").css({"display":"none"});
	}
?>
<!doctype html>
<html lang="ko">
<head>
	<meta charset="UTF-8">
	<title>index</title>
	<link rel="stylesheet" href="./css/style.css">
	<script src="http://code.jquery.com/jquery-latest.min.js"></script>
	<script src="./js/a.js"></script>
</head>
<body>
	<div class="wrap">
		<header id="header"></header>
		<section id="section">
			<h2>COMMUNITY</h2>

			<div class="board">
				<p><?=$msg?></p>
				<div class="table">
					<div class="gsp_header">
						<ul>
							<li>번호</li>
							<li>제목</li>
							<li>글쓴이</li>
							<li>조회수</li>
						</ul>
					</div>
					<div class="gsp_content">
					<?php
						while($row = mysql_fetch_array($result)){
					?>
						<ul class="list">
							<li class="num"><?=$row['idx']?></li>
							<li class="title"><div class="title_box"><a href="./function/view.php?idx=<?=$row['idx']?>"><?=$row['title']?></a></div></li>
							<li class="writer"><div class="writer_box"><?=$row['writer']?></div></li>
							<li class="count"><?=$row['count']?></li>
						</ul>
						<?php
							}
						?>
					</div>
				</div>
				<div>
					<a href="./function/write.php" class="write_btn">글쓰기</a>
					<a href="./function/member/sign_up.php" id="signup" class="write_btn">회원가입</a>
					<a href="./function/member/sign_in.php" id="login" class="write_btn">로그인</a>
					<a href="./function/member/sign_out.php" id="logout" class="write_btn">로그아웃</a>
				</div>
			</div>
		</section>
		<footer id="footer"></footer>
	</div>
</body>
</html>