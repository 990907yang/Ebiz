<?php
	include "../../dbconn.php";
	echo "<meta charset='UTF-8'>";

	$pass = $_POST['password'];
	$pass_ok = $_POST['password_ok'];

	if($pass == $pass_ok){
		$pw = md5($_POST['password']);
		$sql = "insert into member_yks set name='{$_POST['name']}',id='{$_POST['id']}',password='{$pw}',email='{$_POST['email']}'";
		$go = mysql_query($sql,$dbconn);
		?>
			<script>
				alert('회원가입에 성공했습니다.');
				location.href='../../index.php';
			</script>
		<?php
		return false;
	}else{
		?>
		<script>
			alert('비밀번호가 맞지 않습니다.');
			history.back();
		</script>
		<?php
	}
?>