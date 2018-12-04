<?php 
header("Content-type:text/html;charset=utf-8");    
$code = 0;
$msg = "Save failed!";
$ipaddr_new = $_POST['ipaddr'];
if(filter_var($ipaddr_new, FILTER_VALIDATE_IP)) {
	$ipaddr = exec('ifconfig br-lan | grep "inet addr:" | sed s/^.*addr://g | sed s/Bcast.*$//g');
	if($ipaddr_new!=$ipaddr){
		
                $_SESSION['islogin']=0;
                $code=1;             
                $msg='Save succeed!';
		echo "{'code':".$code.",'msg':".$msg."}";
		exec('sed -i "s/'.$ipaddr.'/'.$ipaddr_new.'/" /etc/config/network');
		exec('sleep 5;/etc/init.d/network restart');
		
	}
}else{
	$code=0;
	$msg='Invalid IP address!';
}   
//$json_arr = array("code"=>$code,"msg"=>$msg); 
//$json_obj = json_encode($json_arr);     
//echo $json_obj; 
echo "{'code':".$code.",'msg':".$msg."}";
?>

