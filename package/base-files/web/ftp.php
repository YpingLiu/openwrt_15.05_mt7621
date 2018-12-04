<?php 
$status = exec('netstat -tunlp | grep vsftpd -c');
$anonymous = 0;
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Frameset//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-frameset.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=gb2312" />
<link href="css/form.css" rel='stylesheet' type='text/css' />
<link href="css/switch_bt.css" rel='stylesheet' type='text/css' />
<script src="js/menu/jquery.min.js"></script>
<script type="text/javascript">  
$(function(){
	$("#statusSwitchBt").click(function(event){     
		console.info(event);
		console.info("statusSwitchBt..............");
		console.info($("#statusSwitchBt").val());
		$.ajax({       
			url:'ftp_action.php?action=switchStatus',       
			type:'post',       
			dataType:'json',       
			data:1,       
			success:function(data){        
				console.info(data);   
			}   
		});
	});
	$("#anonymousSwitchBt").click(function(event){     
		console.info(event);
		console.info("anonymousSwitchBt..............");
		console.info($("#anonymousSwitchBt").val());
		$.ajax({       
			url:'ftp_action.php?action=switchAnonymous',       
			type:'post',       
			dataType:'json',       
			data:1,       
			success:function(data){        
				console.info(data);   
			}   
		});
	});
}); 
</script> 
</head>

<body bgcolor="#FFFFFF" style="margin:0;padding:0">
<span class="radius"></span>
<form action="main.php" method="post" class="smart-green">
<h1>FTP服务设置</h1>

<div>
<label >
<span>FTP状态:&nbsp&nbsp</span>
<input id="statusSwitchBt" class="mui-switch mui-switch-animbg" type="checkbox" <?php echo $status==1?"checked":"" ?> />
</label>
</div>

<!-- <div style="height: 40px">
<label >
<input type="button" id="save" class="button" value="保存" style="float:right;"/>
</label>
</div> -->


<!-- <div>
<label>
<span>匿名访问:&nbsp&nbsp</span>
<input id="anonymousSwitchBt" class="mui-switch mui-switch-animbg" type="checkbox" <?php echo $anonymous==1?"checked":"" ?> />
</label> 
</div> -->

</form>
</body>
</html>

