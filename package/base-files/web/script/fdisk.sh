#!/bin/sh

prog=mkfs
RETVAL=0

para1=$1
para2=$2

format_progress() {
		#ps -fe|grep $prog |grep -v grep
		ps | grep $prog | grep -v grep | wc -l
		if [ $? -eq 0 ] && [ -n "`mount -l | grep $para2`" ]
		then
			echo "process NOT exist"
			return 0
		else
			echo "process runing....."
                        return 1
		fi		
}

fdisk_handle2() {
        echo "fdisk $para2"
        fdisk $para2 < /www/script/fdisk_param.txt
        return $RETVAL
}
fdisk_handle() {
	#/dev/sda1
	name4=${para2##*/}  #sda1
	name3=${name4:0:3}  #sda
	name8=${para2:0:8}  #/dev/sda
	count2=`ls /dev/sd* | grep ${name3}[0-9] -c`
	echo $count2
	if [ $count2 -gt 0 ]
	then
		echo "Existed, Do nothing."
	else
		echo "fdisk $name8"
		fdisk $name8 < /www/script/fdisk_param.txt
	fi
        return $RETVAL
}
mkfs_handle() {
	

        mkfs.ext4 $para2
        return $RETVAL
}

mkfs_fail_handle() {                                           
	#ps -ef | grep "$1" | grep -v "grep" | wc -l
	#killall -9 p2pServer
	/etc/init.d/vsftpd stop
	/etc/init.d/samba stop
	umount $para2 > /dev/null               
        if [ $? -eq 0 ]                         
        then                                    
		echo "Umount succeed"
		#p2pServer &
		/etc/init.d/vsftpd start                           
        	/etc/init.d/samba start          
                mkfs_handle > /dev/null    
                                                          
                mount $para2 /mnt/${para2#*/dev/} > /dev/null
        else                                             
                echo "Umount Failed!"                     
                mkfs_fail_handle                          
        fi         			                                                          
} 


case "$para1" in
        fdisk)
        fdisk_handle
        ;;
        mkfs)
	    if [ -n "`mount -l | grep $para2`" ]
	    then
	    echo "It's mounted."
	    umount $para2 > /dev/null
	    if [ $? -eq 0 ]
	    then
		echo "Umount succeed"
		mkfs_handle > /dev/null
		
		mount $para2 /mnt/${para2#*/dev/} > /dev/null
	    else
		echo "Umount Failed!"
		mkfs_fail_handle
	    fi
	else
	    echo "It's not mounted."
	    mkfs_handle > /dev/null
	    mount $para2 /mnt/${para2#*/dev/} > /dev/null
	fi
        
        ;;
	format_progress)
        format_progress
        ;;
	*)
        echo "Usage: $prog {fdisk|mkfs|format_progress}"
        ;;
esac
