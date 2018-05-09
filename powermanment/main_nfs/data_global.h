#ifndef __DATA_GLOBAL__H__
#define __DATA_GLOBAL__H__

#include <stdio.h>
#include <errno.h>
#include <fcntl.h>
#include <unistd.h>
#include <stdlib.h>
#include <string.h>
#include <signal.h>
#include <pthread.h>
#include <termios.h>
#include <syscall.h>
#include <sys/ipc.h>
#include <sys/shm.h>
#include <sys/msg.h>
#include <sys/sem.h>
#include <sys/stat.h>
#include <sys/types.h>
#include <sys/ioctl.h>
#include <linux/fs.h>
#include "mysql.h" 
#define DEV_GPRS           "/dev/ttyUSB0"

extern void *pthread_mysql (void *);	//数据库线程
extern void *pthread_analysis (void *);	//数据解析线程
extern void *pthread_transfer (void *);	//数据接收线程


#endif
