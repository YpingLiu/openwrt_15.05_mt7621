#! /bin/sh
#chkconfig: 345 60 50
#description:vsftpd

vsftpd=/usr/sbin/vsftpd
prog=vsftpd
RETVAL=0
start() {
        if [ -n "`pgrep $prog`" ]
        then
                echo "$prog: already running"       
                echo
                return 1
        fi
        echo "Starting $prog:"
        base=$prog
        $vsftpd &
        RETVAL=$?
        sleep 3
        if [ -z "`pgrep $prog`" ]
        then
                RETVAL=1
        fi
        if [ $RETVAL -ne 0 ]       
        then
        echo "Startup failure"
        else
        echo "Startup success"
        fi
        echo
        return $RETVAL
}
 
stop() {
        echo "Stopping $prog:"
        killall $prog
        RETVAL=$?
        if [ $RETVAL -ne 0 ]
        then
        echo "Shutdown failure"
        else
        echo "Shutdown success"
        fi
        echo
}
 
case "$1" in
start)
        start
        ;;
stop)
        stop
        ;;
status)
		if [ -n "`pgrep $prog`" ]
        then
			echo "$prog is running"
		else
			echo "$prog is stop"
		fi
        RETVAL=$?
        ;;
restart)
        stop
        sleep 3
        start
        ;;
*)
        echo "Usage: $prog {start|stop|restart|status}"
        exit 1
esac
exit $RETVAL