<?php
	include "../dbconn.php";
	echo "<meta charset='UTF-8'>";

	$sql_sel =  "select * from community_yks where idx='{$_GET['idx']}'";
	$go_sel = mysql_query($sql_sel);

	$num = $_GET['idx'];

	$pass = $_POST['password'];

	while($result = mysql_fetch_array($go_sel)){
		if($result['password']==$pass){

			$sql = "update community_yks set title='{$_POST['title']}',writer='{$_POST['writer']}',text='{$_POST['text']}' where idx='{$_GET['idx']}'";
			$go = mysql_query($sql);
			?>
				<script>
					alert('수정이 완료되었습니다.');
					location.href='../index.php';
				</script>
				<?php

		}else{
			?>
			<script>
				alert('비밀번호가 일치 하지 않습니다.');
				location.href='./update.php?idx=<?=$num?>';
			</script>
			<?php
		}
	}
?>