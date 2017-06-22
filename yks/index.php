<?php
	include './dbconn.php';
	
	$ser = explode(".", $_SERVER["REMOTE_ADDR"]);
	echo $ser[0].".".$ser[1].".".$ser[2].".".$ser[3];

	$field = empty($_GET['field']) ? "" : $_GET['field']; // field 값이 없다면 ? ""공백을 넣고 있다면 : 넣는다
	$value = empty($_GET['value']) ? "" : $_GET['value'];
	$val = addslashes(htmlspecialchars($value));

	$add_sql = "";

	if(!empty($_GET['field'])){ //empty 변수가 있는지 없는지 체크!로 반대 옵션값이 있을때
		$add_sql = " and ".$_GET['field']." LIKE "."'%".$val."%'"."";//옵션값과 입력값을 불러오는 조건 "'%".변수."%'" %가 문자열로 받아야되기 때문에 ''를 한번더 써줌
	}
	$sql = "SELECT count(*) as cnt FROM community_yks where 1=1 ".$add_sql." order by idx desc";
	$result = mysql_query($sql,$dbconn);

	/* 회원정보 가져오기 */
	if(isset($_SESSION['user'])){
		$user_name = $_SESSION['user']['name'];
		$msg = $user_name.'님 환영합니다.';
	}else{
		$msg = "";
	}

	/* 페이징 */
	if(isset($_GET['page'])){
		$page = $_GET['page'];
	}else{
		$page = 1;
	}
	while($row = mysql_fetch_array($result))
		$allpost = $row['cnt']; // 전체 게시글 수
	$onepage = 10; // 한 페이지의 보여줄 게시글의 수
	$allpage = ceil($allpost / $onepage); // 전체 페이지의 수

	if($page < 1 || ($allpage && $page > $allpage)){
		alert('존재하지 않는 페이지입니다.');
		back();
		exit;
	}
	$onesection = 5; //한번에 보여줄 페이지 개수
	$currentsection = ceil($page / $onesection); // 현재 섹션
	$allsection = ceil($allpage / $onesection); // 전체 섹션의 수

	$firstpage = ($currentsection * $onesection)-($onesection -1); //현재 섹션의 처음 페이지

	if($currentsection == $allsection){
		$lastpage = $allpage; //현재 섹션이 마즈막 섹션이면 $allpage가 막페이지가 된다.
	}else{
		$lastpage = $currentsection * $onesection; //현재 섹션의 마즈막 페이지
	}

	$prevpage = (($currentsection -1) * $onesection); //이전 페이지
	$nextpage = (($currentsection +1) * $onesection)-($onesection -1); //다음 페이지

	$paging = '<ul>';
	
	if($page != 1){
		$paging .= '<li class="page page_start"><a href="/yks/?field='.$field.'&value='.$value.'&page=1">처음</a></li>';
	}
	if($currentsection != 1){
		$paging .= '<li class="page page_prev"><a href="/yks/?field='.$field.'&value='.$value.'&page='.$prevpage.'">이전</a></li>';
	}

	for($i = $firstpage; $i <= $lastpage; $i++){
		if($i == $page){
			$paging .='<li class="page current">'.$i.'</li>';
		}else{
			$paging .='<li class="page"><a href="/yks/?field='.$field.'&value='.$value.'&page='.$i.'">'.$i.'</a></li>';
		}
	}

	if($currentsection != $allsection){
		$paging .='<li class="page page_next"><a href="/yks/?field='.$field.'&value='.$value.'&page='.$nextpage.'">다음</a></li>';
	}
	if($page != $allpage){
		$paging .= '<li class="page page_end"><a href="/yks/?field='.$field.'&value='.$value.'&page='.$allpage.'">맨끝</a></li>';
	}
	$paging .='</ul>';
	/* /페이징 */
	$currentlimit = ($onepage * $page) - $onepage;
	$sqllimit = 'limit '.$currentlimit.','.$onepage;
	$sql = "SELECT * FROM community_yks WHERE 1=1 ".$add_sql." order by idx desc ".$sqllimit;
	$result = mysql_query($sql,$dbconn);
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
		<script type="text/javascript" src="http://static.dagame.co.kr/js/gnb.js"></script>
		<header id="header"></header>
		<section id="section">
			<h2>COMMUNITY</h2>

			<div class="board">
				<p class="wel_msg"><?=$msg?></p>
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
						$idx = $allpost-(($page-1)*10); //현재 페이지가 2페이지면 2-1 =1 1에10을 곱하면 10 나온 10을 전체 글 갯수값에서 빼주고 출력 66-10= 56이니까 56부터 출력
						while($row = mysql_fetch_array($result)){
					?>
						<ul class="list">
							<li class="num"><?=$idx?></li>
							<li class="title"><div class="title_box"><a href="./function/view.php?idx=<?=$row['idx']?>&page=<?=$page?>"><?=$row['title']?></a></div></li>
							<li class="writer"><div class="writer_box"><?=$row['writer']?></div></li>
							<li class="count"><?=$row['count']?></li>
						</ul>
					<?php
					$idx--; //하나씩 줄어들게
						}
					if($allpost == 0){//전체 게시글 값이 0개이면 출력 되도록
						echo "<ul><p style='text-align:center'>검색된 값이 없습니다.</p></ul>";
					}
					?>
					</div>
				</div>
				<div class="bot">
					<div class="paging">
						<?php echo $paging?>
					</div>
					<form action="/yks" method="get" class="search_form">
					<select name="field" class="search_sel">
						<option value="title" <?php if($field=="title"){echo "selected";}?>>제목</option>
						<option value="text" <?php if($field=="text"){echo "selected";}?>>내용</option>
						<option value="writer" <?php if($field=="writer"){echo "selected";}?>>작성자</option>
					</select>
					<input type="text" class="search" name="value" placeholder="게시판에서 검색" value="<?=$val?>">
					<button class="search_btn" id="wrbt">검색</button>
					</form>

					<div class="all_btn">
					<?php
						if(isset($_SESSION['user'])){
					?>
						<a href="./function/write.php" class="write_btn">글쓰기</a>
						<a href="./function/member/sign_out.php" id="logout" class="write_btn">로그아웃</a>
					<?php
						}else{	
					?>
						<a href="./function/member/sign_in.php" id="login" class="write_btn">로그인</a>
						<a href="./function/member/sign_up.php" id="signup" class="write_btn">회원가입</a>
					<?php
					}	
					?>
					</div>
				</div>
			</div>
		</section>
		<footer id="footer"></footer>
	</div>
</body>
</html>