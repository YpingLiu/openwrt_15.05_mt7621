#! /bin/sh

#定时检测系统是否挂载硬盘，防止samba文件写到系统盘
#check disk mount status
monitor_disk()
{
	ret=`df | grep "/dev" | wc -l`
	if [ $ret -ge 1 ];then
		echo "Has mount some disk."
		return 0;
	fi
		echo "Has not mount any disk!"
		g_err_flag=1
		return 1
}
#monitor service status
monitor_service()
{
    ret=`ps |grep "/usr/sbin/$1" |wc -l`
    if [ $ret -ge 2 ];then
        echo "the $1 service is OK"
        return 0
    fi
		echo "the $1 service is ERR"
    	g_err_flag=1
    	return 1
}


if monitor_disk
then
	if monitor_service "vsftpd"
	then
		echo "do nothing"
	else
		echo "need to start vsftpd"
		`/usr/sbin/vsftpd &`
	fi
else
	if monitor_service "vsftpd"
	then
		echo "need to stop vsftpd"
		`killall vsftpd`
	fi	
fi
exit 0



