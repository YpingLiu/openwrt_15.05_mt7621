<?php
/**
 * Created by PhpStorm.
 * User: alex
 * Date: 2018/5/8
 * Time: 9:07
 */
echo phpinfo();
echo date('Y-m-d H:i:s',time());
exec("fdisk -l", $output, $return_var); 
  var_dump($output);
?>