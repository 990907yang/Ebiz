<?php
	include '../dbconn.php';

	$idx = $_GET['idx'];

	$sql = "SELECT count(*) as cnt FROM community_yks";
	$result = mysql_query($sql,$dbconn);

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
	$onesection = 10; //한번에 보여줄 페이지 개수
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
		$paging .= '<li class="page page_start"><a href="/yks/function/view.php?idx='.$idx.'&page=1">처음</a></li>';
	}
	if($currentsection != 1){
		$paging .= '<li class="page page_prev"><a href="/yks/function/view.php?idx='.$idx.'&page='.$prevpage.'">이전</a></li>';
	}

	for($i = $firstpage; $i <= $lastpage; $i++){
		if($i == $page){
			$paging .='<li class="page current">'.$i.'</li>';
		}else{
			$paging .='<li class="page"><a href="/yks/function/view.php?idx='.$idx.'&page='.$i.'">'.$i.'</a></li>';
		}
	}

	if($currentsection != $allsection){
		$paging .='<li class="page page_next"><a href="/yks/function/view.php?idx='.$idx.'&page='.$nextpage.'">다음</a></li>';
	}
	if($page != $allpage){
		$paging .= '<li class="page page_end"><a href="/yks/function/view.php?idx='.$idx.'&page='.$allpage.'">맨끝</a></li>';
	}
	$paging .='</ul>';
	/* /페이징 */

	$currentlimit = ($onepage * $page) - $onepage;
	$sqllimit = 'limit '.$currentlimit.','.$onepage;
	$sql = "SELECT * FROM community_yks order by idx desc ".$sqllimit;
	$ro = mysql_query($sql,$dbconn);


	/* 조회수 */
	$session = "";
	$name = "gsp";
	
	$explode = explode(",",$session);
	
	$hit = 0;

	for($i = 0; $i < sizeof($explode); $i++){
		if($explode[$i] == $name."-".$idx){
			$hit = 1;
			break;
			}
		}
		if($hit == 0){
			$session.=",".$name."-".$idx;

			$updatesql = "update community_yks set count = count+1 where idx='{$_GET['idx']}'";
			$updatesql_go = mysql_query($updatesql,$dbconn);
   }

	/* 현재게시글 가져오기 */
	$sql_r = "select * from community_yks where idx='$idx'";
   $re_r = mysql_query($sql_r,$dbconn);


   /* 파일이 서버에 없을때  no-img뜨도록 */
   $sql_r2 = "select * from community_yks where idx='$idx'";
   $re_r2 = mysql_query($sql_r2,$dbconn);
	while($result2=mysql_fetch_array($re_r2)){
		$fi_na = $result2['upload'];
	}
	
	$remot_file = "http://file.nolzzang.com/yks/".$fi_na;

	function remoteFileExist($filepath){
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL,$filepath);
		curl_setopt($ch, CURLOPT_NOBODY, 1);
		curl_setopt($ch, CURLOPT_FAILONERROR, 1);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
		if(curl_exec($ch) !== false){
			return true;
		}else{
			return false;
		}
	}
	/* 권한검사를 위한 회원정보 가져오기 */
	$mem_sql = "select * from member_yks";
	$mem_go = mysql_query($mem_sql);
	
	/* 권한 부여를 위해서 이름값이 있는 없는 검사후 없다면 ""공백을 있다면 이름정보를 저장*/
	$us_name = empty($_SESSION['user']['name']) ? "" : $_SESSION['user']['name'];
?>
<!doctype html>
<html lang="ko">
<head>
	<meta charset="UTF-8">
	<title>view</title>
	<link rel="stylesheet" href="../css/style.css">
	<script src="http://code.jquery.com/jquery-latest.min.js"></script>
	<script src="../js/a.js"></script>
</head>
<body>
	<div class="wrap">
		<header id="header"></header>
		<section id="section">
			<h2>VIEW</h2>

			<div class="board">
				<div class="view">
					<?php
						while($result=mysql_fetch_array($re_r)){
						$text = nl2br($result['text']);
					?>
					<div class="v_idx"><?=$idx?></div>
					<div class="v_title">제목 :<?=$result['title']?></div>
					<div class="v_writer">작성자 :<?=$result['writer']?></div>
					<div class="v_count">조회수:<?=$result['count']?></div>
					<div class="v_text"><?=$text?></div>
					<?php
						if(remoteFileExist($remot_file) == 1){
					?>
					<div class="v_img"><a href="http://file.nolzzang.com/yks/<?=$result['upload']?>" target="_blank"><img src="http://file.nolzzang.com/yks/<?=$result['upload']?>" alt="업로드 이미지" title="업로드 이미지" class="upimg"></a></div>
					<?php
						}
						else if($result['upload'] == ""){
							?>
							<script>
								$('.v_text').css({'width':'975px','transition':'0s'});
							</script>
							<?php
						}else{
							?>
							<div class="v_img"><img src="http://file.nolzzang.com/yks/no_img.jpg" alt="업로드 이미지" title="업로드 이미지" class="upimg"></div>
							<?php
						}
					?>
				</div>
					<a href="../index.php" class="write_btn">목록</a>	
						<?php
							if($us_name==$result['writer']){
						?>
								<a href="./update.php?idx=<?=$result['idx']?>" class="write_btn">수정</a>
								<a href="./delete.php?idx=<?=$result['idx']?>" class="write_btn">삭제</a>
						<?php
							}
						?>
					<?php
						}
					?>
			</div>
			<div class="view_list">
				<div class="gsp_header">
						<ul>
							<li>번호</li>
							<li>제목</li>
							<li>작성자</li>
							<li>조회수</li>
						</ul>
					</div>
				<?php
					$num = $allpost - (($page-1)*10);
					while($re = mysql_fetch_array($ro)){

						if($re['idx']==$idx){
							$st = "font-weight:bold; background:#ddd";
						}else{
							$st = "";
						}
				?>
					<ul class="vlist" style="<?=$st?>">
						<li class="num"><?=$num?></li>
						<li class="title"><div class="title_box"><a href="./view.php?idx=<?=$re['idx']?>&page=<?=$page?>"><?=$re['title']?></a></div></li>
						<li class="writer"><div class="writer_box"><?=$re['writer']?></div></li>
						<li class="count"><?=$re['count']?></li>
					</ul>
				<?php
				$num--;
					}
				?>
			</div>
			<div class="list_paging">
				<?php echo $paging?>
			</div>
		</section>
		<footer id="footer"></footer>
	</div>
</body>
</html>