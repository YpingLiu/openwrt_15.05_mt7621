<?php 
header("Content-type:text/html;charset=utf-8");    
$code = 0;
$msg = "Save failed!";

$action = $_GET['action'];
//echo "action======".$action;
switch ($action) {
    case 'switchStatus':
        switchStatus();
        break;
    case 'switchAnonymous':
        switchAnonymous();
        break;
}
// 切换服务状态
function switchStatus(){
	$status = exec('netstat -tunlp | grep vsftpd -c');
	$script = '/etc/init.d/vsftpd '.($status==0?'start':'stop');
	exec($script);
	echo "{'code':1,'msg':'ok'}";
}

// 切换是否匿名访问
function switchAnonymous(){
	echo "{'code':".$code.",'msg':".$msg."}";
}

?>

