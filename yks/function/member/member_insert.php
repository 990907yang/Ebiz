<?php
	include "../../dbconn.php";

	$pass = $_POST['password'];
	$pass_ok = $_POST['password_ok'];

	if($pass == $pass_ok){
		$pw = md5($_POST['password']);
		$sql = "insert into member_yks set name='{$_POST['name']}',id='{$_POST['id']}',password='{$pw}',email='{$_POST['email']}'";
		$go = mysql_query($sql,$dbconn);
		return false;
	}else{
		?>
		<script>
			alert('비밀번호가 일치 하지 않습니다.');
			location.href = './sign_up.php';
		</script>
		<?php
	}
?>
<script>
	location.href = "../../index.php";
</script>