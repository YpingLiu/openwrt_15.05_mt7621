<?php 
$ipaddr = exec('ifconfig br-lan | grep "inet addr:" | sed s/^.*addr://g | sed s/Bcast.*$//g');

?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Frameset//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-frameset.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=gb2312" />
<link href="css/form.css" rel='stylesheet' type='text/css' />
<script src="js/menu/jquery.min.js"></script>
<script type="text/javascript">  
$(function(){    
	$("#save").click(function(){
		var oldPwd = $("#oldPwd").val();
		if(oldPwd==""){
			alert('必须输入旧密码！');
			return;
		}
		var newPwd = $("#newPwd").val();
		var confirmPwd = $("#confirmPwd").val();
		if(confirmPwd=="" || newPwd==""){
			alert('必须输入新密码！');
			return;
		}
		if(newPwd!=confirmPwd){
			alert('两次输入的密码不一致！');
			return;
		}
		var cont = $("input").serialize();
		$.ajax({       
			url:'changePwd_action.php',       
			type:'post',       
			dataType:'json',       
			data:cont,       
			success:function(data){        
				console.info(data);   
				alert(data);
				if(data.code!=0){
					alert(data.msg);
					return;
				}else{
					alert("密码已修改，请重新登录！");
					window.parent.parent.location="logout.php";
				}

			}   
		});

		
	});   
}); 
</script> 
</head>

<body bgcolor="#FFFFFF" style="margin:0;padding:0">
<span class="radius"></span>
<form action="changePwd_action.php.php" method="post" class="smart-green">
<h1>修改用户密码</h1>
<label>
<span>旧密码:</span>
<input type="text" id="oldPwd" value="" />
</label>

<label>
<span>新密码:</span>
<input type="text" id="newPwd" value="" />
</label>

<label>
<span>确认密码:</span>
<input type="text" id="confirmPwd" value="" />
</label>
<span>&nbsp;</span>
<input type="button" id="save" class="button" value="修改" />
</label>
</form>
</body>
</html>

