<?php
	include "../dbconn.php";

	$sqll = "select * from community_yks where idx='{$_GET['idx']}'";
	$goo = mysql_query($sqll);
	
	$pass = $_POST['pass_ok'];

	while($re = mysql_fetch_array($goo)){
		if($re['password'] == $pass ){
			$sql = "delete from community_yks where idx='{$_GET['idx']}'";
			$go = mysql_query($sql);
			echo "<script>alert('게시글이 정상적으로 삭제되었습니다.');</script>";
		}
		
		else{
			?>
			<script>
				alert("비밀번호가 일치하지 않습니다.");
			</script>
			<?php
		}
	}
	
?>

<script>
	location.href='../index.php';
</script>