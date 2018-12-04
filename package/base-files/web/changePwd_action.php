<?php 
header("Content-type:text/html;charset=utf-8");    
$code = 0;
$msg = "Save failed!";
$oldPwd = $_POST['oldPwd'];
$newPwd = $_POST['newPwd'];
$confirmPwd = $_POST['confirmPwd'];
$curPwd = exec('cat /etc/config/pwd');
if($curPwd!=$oldPwd)
{
	$code=1;
	$msg='Invalid password!';
}
else if($newPwd!=$confirmPwd)
{
	$code=2;
	$msg='两次输入的密码不一样，请重新输入!';		
}
else{
	//修改系统用户密码
	exec('echo "admin:'.$newPwd.'" | chpasswd');//非交互式修改密码

	//修改配置文件密码
	exec('echo '.$newPwd.' /etc/config/pwd');
    $_SESSION['islogin']=0;
    $code=1;             
    $msg='Save succeed!';
	echo "{'code':".$code.",'msg':".$msg."}";
}
echo "{'code':".$code.",'msg':".$msg."}";
?>

