<?php
	header("Content-Type:text/html;charset=utf-8");
	include dirname(__FILE__).'/lib/Auth.class.php';
	session_start();
	if(isset($_POST['login']))
	{
		$username = trim($_POST['username']);
		$password = trim($_POST['password']);
		if(($username=='')||($password==''))
		{
			header('Location:login.html');
			echo "<script>alert('用户名或密码不能为空!');</script>";
			exit;
		}
		else if(checkLogin($username,$password))
		{
			//登录成功将信息保存到session中
			$_SESSION['username']=$username;
			$_SESSION['islogin']=1;
			//如果勾选7天内自动保存，则将其保存到cookie
			if($_POST['remember']=="yes")
			{
				setcookie("username",$username,time()+7*24*60*60);
				setcookie("code",md5($username.md5($password)),time()+7*24*60*60);
			}
			else
			{
				setcookie("username",'',time()-1);
				setcookie("code",'',time()-1);
			}
			//跳转到用户首页
			header('Location: index.php');
		}
		else
		{
			//用户名或密码错误
			header('Location:login.html?errorcode=1');
			//echo "<script>alert('用户名或密码错误!');</script>";
			exit;			
		}
	}
?>