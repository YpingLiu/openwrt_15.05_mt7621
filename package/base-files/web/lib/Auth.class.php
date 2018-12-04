<?php

  	function checkLogin($username,$password)
    {
  		if($username!='admin')
      {
  			return false;
      }
      else
      {
  		   $pwd = exec("cat /etc/config/pwd");
         if(empty($pwd) && $password=='123456')
         {
          exec("echo '123456' > /etc/config/pwd");
          return true;
         }
         else
         {
            return ($password==$pwd);
         } 		   
  		}
  	}
    
?>