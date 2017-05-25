<?php
	include './dbconn.php';
	$sql = "select * from community_yks order by idx desc";
	$result = mysql_query($sql);
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
							<li class="title"><a href="./function/view.php?idx=<?=$row['idx']?>"><?=$row['title']?></a></li>
							<li class="writer"><?=$row['writer']?></li>
							<li class="count"><?=$row['count']?></li>
						</ul>
						<?php
							}
						?>
					</div>
				</div>
				<div>
					<a href="./function/write.php" class="write_btn">글쓰기</a>
					<a href="./function/member/sign_in.php" class="write_btn">로그인</a>
					<a href="./function/member/sign_up.php" class="write_btn">회원가입</a>
				</div>
			</div>
		</section>
		<footer id="footer"></footer>
	</div>
</body>
</html>