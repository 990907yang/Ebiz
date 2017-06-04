<?php
	include "../dbconn.php";
	
	$sql = "SELECT * FROM community_yks";

	$search = $_GET['value'];
	$category = $_GET['field'];

	if($category == "title"){
		$sql .= " WHERE title";	
	}else if($category == "writer"){
		$sql .= " WHERE writer";
	}else if($category == "text"){
		$sql .= " WHERE text";
	}
	$sql .=" LIKE '%$search%' ORDER BY idx DESC";
	echo $sql;
	$go = mysql_query($sql,$dbconn);
?>
<!doctype html>
<html lang="ko">
<head>
	<meta charset="UTF-8">
	<title>search</title>
	<link rel="stylesheet" href="../css/style.css">
	<script src="http://code.jquery.com/jquery-latest.min.js"></script>
	<script src="../js/a.js"></script>
</head>
<body>
	<div class="wrap">
		<header id="header"></header>
		<section id="section">
			<h2>SEARCH</h2>

			<div class="board">
				<div class="table">
					<div class="gsp_header">
						<ul>
							<li>번호</li>
							<li>제목</li>
							<li>작성자</li>
							<li>조회수</li>
						</ul>
					</div>
					<div class="gsp_content">
					<?php
						while($ro = mysql_fetch_array($go)){
					?>
						<ul class="list">
							<li class="num"><?=$ro['idx']?></li>
							<li class="title"><div class="title_box"><a href="./view.php?idx=<?=$ro['idx']?>"><?=$ro['title']?></a></div></li>
							<li class="writer"><div class="writer_box"><?=$ro['writer']?></div></li>
							<li class="count"><?=$ro['count']?></li>
						</ul>
					<?php
						}
					?>
					</div>
				</div>
				<form action="./search.php" method="get" class="search_form">
					<select name="field" class="search_sel">
						<option value="title">제목</option>
						<option value="text">내용</option>
						<option value="writer">작성자</option>
					</select>
					<input type="text" class="search" name="value" placeholder="게시글 검색">
					<button class="search_btn">검색</button>
				</form>
				<div class="all_btn">
				<?php
					if(isset($_SESSION['user_id'])){
				?>
					<a href="./write.php" class="write_btn">글쓰기</a>
					<a href="./member/sign_out.php" id="logout" class="write_btn">로그아웃</a>
				<?php
					}else{	
				?>
					<a href="./member/sign_in.php" id="login" class="write_btn">로그인</a>
					<a href="./member/sign_up.php" id="signup" class="write_btn">회원가입</a>
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