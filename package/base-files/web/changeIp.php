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
		var cont = $("input").serialize();
		console.info(cont);     
		$.ajax({       
			url:'saveIP.php',       
			type:'post',       
			dataType:'json',       
			data:cont,       
			success:function(data){        
				console.info(data);   
			}   
		});
		var sc = "top.location='http://"+$("#ipaddr").val()+":88/login.html';"
		//alert(sc);
		var t=setTimeout(sc,5000);
		alert("IP has changed! Please wait......");
	});   
}); 
</script> 
</head>

<body bgcolor="#FFFFFF" style="margin:0;padding:0">
<span class="radius"></span>
<form action="main.php" method="post" class="smart-green">
<h1>修改IP地址</h1>
<label>
<span>IP:</span>
<input type="text" id="ipaddr" name="ipaddr" value="<?php echo $ipaddr;?>" />
</label>
<span>&nbsp;</span>
<input type="button" id="save" name="save" class="button" value="保存" />
</label>
</form>
</body>
</html>

