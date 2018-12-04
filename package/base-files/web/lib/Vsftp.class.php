<?php
  //解析头
  header('content-type:text/html;charset=utf-8');
  class Vsftp{
    /**
     * [开启vsftpd服务]
     * @return [int] [0为成功]
     */
  	function start(){
      exec("systemctl start vsftpd", $res, $rc); 
      return $rc;
  	}
    /**
     * [重启vsftpd服务]
     * @return [int] [0为成功]
     */
  	function restart(){
      exec("systemctl restart vsftpd", $res, $rc); 
      return $rc;
  	}
    /**
     * [停止vsftpd服务]
     * @return [int] [0为成功]
     */
  	function stop(){
  		exec("systemctl stop vsftpd", $res, $rc); 
      return $rc;
  	}

  }