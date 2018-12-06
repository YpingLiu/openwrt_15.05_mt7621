#!/bin/sh

prog=mkfs
RETVAL=0

para1=$1
para2=$2

format_progress() {
        if [ -n "`pgrep $prog`" ]
        then
                echo "1"
                return 1
        else
                echo "0"
        fi
        return $RETVAL
}

fdisk_handle() {
        echo "fdisk $para2"
        fdisk $para2 < /www/script/fdisk_param.txt
        return $RETVAL
}

mkfs_handle() {
        echo "mkfs $para2:"
        mkfs.ext4 $para2
        return $RETVAL
}
case "$para1" in
        fdisk)
        fdisk_handle > /dev/null
        ;;
        mkfs)
        mkfs_handle > /dev/null
        ;;
	format_progress)
        format_progress
        ;;
	*)
        echo "Usage: $prog {fdisk|mkfs|format_progress}"
        ;;
esac
