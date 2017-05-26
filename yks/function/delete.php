<?php
	include "../dbconn.php";
	echo "<meta charset='UTF-8'>";

	$num = $_GET['idx'];

	$sqll = "select * from community_yks where idx='{$num}'";
	$goo = mysql_query($sqll);
	
	$pass = $_POST['pass_ok'];

	while($re = mysql_fetch_array($goo)){
		if($re['password'] == $pass ){
			$sql = "delete from community_yks where idx='{$num}'";
			$go = mysql_query($sql);
			?>
			<script>
				alert('게시글이 정상적으로 삭제되었습니다.');
				location.href='../index.php';
			</script>
			<?php
		}else{
			?>
			<script>
				alert("비밀번호가 일치하지 않습니다.");
				location.href='./delete_ok.php?idx=<?=$num?>';
			</script>
			<?php
		}
	}
	
?>