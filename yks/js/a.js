$(document).ready(function(){
	/*$("#wrbt").click(function(){
		if($(".title").val()==""){
			alert('제목을 입력해주세요');
			$.trim($(".title").val());
			$(".title").focus();
			return false;
		}
		
		else if($(".writer").val()==""){
			$.trim($(".writer").val());
			alert('작성자를 입력해주세요.');
			$(".writer").focus();
			return false;
		}
		
		else if($(".password").val()==""){
			alert('비밀번호를 입력해주세요.');
			$.trim($(".password").val());
			$(".password").focus();
			return false;
		}
		
		else if($(".text").val()==""){
			alert('내용을 입력해주세요.');
			$.trim($(".text").val());
			$(".text").focus();
			return false;
		}
		
		else{
			alert('글쓰기가 완료되었습니다.');
		}	
	});
*/
	$("#wrbt").click(function(){
		if($(".title").val().replace(/\s/g,"").length == 0){
			alert("제목을 입력해주세요.");
			$(".title").focus();
			return false;
		}else if($(".writer").val().replace(/\s/g,"").length == 0){
			alert("작성자를 입력해주세요.");
			$(".writer").focus();
			return false;
		}else if($(".password").val().replace(/\s/g,"").length == 0){
			alert("비밀번호를 입력해주세요.");
			$(".password").focus();
			return false;
		}else if($(".textar").val().replace(/\s/g,"").length == 0){
			alert("내용을 입력해주세요.");
			$(".textar").focus();
			return false;
		}
		else{
			alert("글쓰기가 완료되었습니다.");
		}
	});

	var re_id = /^[a-z0-9_-]{4,20}$/; //아이디 정규식
	var re_pw = /^[a-z0-9_-]{6,18}$/; // 비밀번호 정규식
	var re_email = /^([\w\.-]+)@([a-z\d\.-]+)\.([a-z\.]{2,6})$/; // 이메일 검사식

	var 
		form = $(".sign_form"),
		uid = $("#uid"),
		upw = $("#upw"),
		uemail = $("#uemail");

	form.submit(function(){
		if(re_id.test(uid.val()) != true){
			alert("[ID 입력 오류] 4자 이상의 아이디를 입력해 주세요.");
			uid.focus();
			return false;
		}else if(re_pw.test(upw.val()) != true){
			alert("[PW 입력 오류] 6자 이상의 비밀번호를 입력해 주세요.");
			upw.focus();
			return false;
		}else if(re_email.test(uemail.val()) != true){
			alert("[EMAIL 입력 오류] @를 포함한 올바른 이메일을 입력해 주세요.");
			uemail.focus();
			return false;
		}
	});

	$('#uid').on("keyup keydown keypress",function(){
		fn($('#uid').val());
	});

	function fn(str){
		$.post("./mm.php",{ id: str }, function(data){
			$("#id_ck").empty();
			$("#id_ck").append(data);
		});
	}
});;