<?php
	include "../../dbconn.php";
	echo "<meta charset='UTF-8'>";
	session_start();
	
	$id = $_POST['id'];
	$pw = md5($_POST['password']);

	$sql = "select * from member_yks where id = '{$id}' and password = '{$pw}'";
	$go = mysql_query($sql,$dbconn);

	$result = mysql_num_rows($go);

	echo $result;

	if($result == 1){
		$_SESSION['log_ok'] = "YES";
		$_SESSION['user_id'] =  $id;
		?>
		<script>
			alert('로그인 되었습니다.');
			location.href='../../index.php';
		</script>
		<?php
	}else{
			$_SESSION['log_ok'] = 'NO';
			$_SESSION['user_id'] = '';
			?>
			<script>
				alert('아이디 또는 페스워드가 일치하지 않습니다.');
				location.href='./sign_in.php';
			</script>
			<?php
			
		}
?>