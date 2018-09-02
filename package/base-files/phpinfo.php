<?php
/**
 * Created by PhpStorm.
 * User: alex
 * Date: 2018/5/8
 * Time: 9:07
 */
echo phpinfo();
exec("fdisk -l", $output, $return_var); 
  var_dump($output);
?>