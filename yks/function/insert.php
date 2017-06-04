<?php
	include "../dbconn.php";
	//echo "<meta charset='UTF-8'>";
	
	//$file = $_FILES['image_test']['name'];
	print_r ($_FILES); exit;
	/*$file_dir = $_SERVER['DOCUMENT_ROOT'].'\\yks\\\\fileup\\';
	$time = md5(microtime());
	$img_dir = "/yks/fileup/".$time.$file;
	echo $img_dir;
	$file_path  = $file_dir.$time.$file;
	
	if($_FILES['image_test']['size'] < 100000){
		move_uploaded_file($_FILES['image_test']['tmp_name'],$file_path);
		//echo location("/yks");
	}else{
		alert("첨부파일 용량초과");
	}

	$title = addslashes(htmlspecialchars($_POST['title']));*/

	$sql = "insert into community_yks set title='{$title}',writer='{$_POST['writer']}',text='{$_POST['text']}',upload='{$img_dir}'";
	$go = mysql_query($sql);
	//alert('글쓰기가 완료되었습니다.');
	//location('/yks');

?>