//#include "link_list.h"
//#include "data_global.h"
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
#include <linux/ioctl.h>
MYSQL my_connection;
#define LEN_ENV 17
#define N 1024
//#define LEN_RFID 4 
//#define QUEUE_MSG_LEN 32


#if 0
extern linklist linkHead;

extern pthread_cond_t cond_analysis;

extern pthread_mutex_t mutex_linklist;

struct msg
{
	long type;
	long msgtype;
	unsigned char text[QUEUE_MSG_LEN];
};

typedef struct msg_pack
{
	     	char msg_type;
			char text[27];
}link_datatype;

void sendMsgQueue (long type, unsigned char text)
{
	struct msg msgbuf;
	msgbuf.type = 1L;
	msgbuf.msgtype = type;
	msgbuf.text[0] = text;
	msgsnd (msgid, &msgbuf, sizeof (msgbuf) - sizeof (long), 0);
}

#endif

void serial_init(int fd)
{
	struct termios options;
	tcgetattr(fd, &options);
	options.c_cflag |= ( CLOCAL | CREAD );
	options.c_cflag &= ~CSIZE;
	options.c_cflag &= ~CRTSCTS;
	options.c_cflag |= CS8;
	options.c_cflag &= ~CSTOPB; 
	options.c_iflag |= IGNPAR;
	options.c_iflag &= ~(ICRNL | IXON);
	options.c_oflag = 0;
	options.c_lflag = 0;

	cfsetispeed(&options, B2400);
	cfsetospeed(&options, B2400);
	tcsetattr(fd,TCSANOW,&options);
}


int main(int argc, char **argv)
{
	int dev_uart_fd;
	int i = 0, len;
	unsigned char check[1024];
	unsigned char buf1[1024];
	char sql[1024];
	int m,j,n1,n2,p;
	unsigned char a[8],b[5];
	float tm1,tm2,result,pv;
	int res,res1;

	//	link_datatype buf;

//	linkHead = CreateEmptyLinklist ();
#if 1
	if ((dev_uart_fd = open ("/dev/ttyUSB0", O_RDWR)) < 0)
	{
		perror ("open ttyUSB");
	//	exit (-1);
		return -1;
	}
	serial_init (dev_uart_fd);

	printf ("Open ttyUSB0 is ok\n");

	mysql_init(&my_connection); 

	if(mysql_real_connect(&my_connection, "localhost", "root","1","db_pursey", 0, NULL, 0))

	{	printf("Connection success\n");

		if ( mysql_set_character_set( &my_connection, "utf8" )) 
		{  //防止显示乱码

			fprintf ( stderr , "错误, %s/n" , mysql_error(&my_connection)) ; 

		}
	}

#endif
  //  sendMsgQueue(MSG_M0,MSG_CONNECT_SUCCESS);
 while (1)
	{   /*******开始读取串口数据*************/

	read (dev_uart_fd, &check, 1);

//	printf("check is %02x\n",check[0]);


    if (check[0] == 0x68)
	{       
		printf("read Voltage data\n");

		usleep(1);

		if ((len = read (dev_uart_fd, buf1, LEN_ENV)) != LEN_ENV)
		{
			for (i = len; i < LEN_ENV; i++)
			{
				read (dev_uart_fd, buf1+i, 1);
			}
		}

		buf1[len+1]='\0';

		a[0]=buf1[16];
		a[1]=buf1[15]; 
		a[2]=buf1[14]; 
	    a[3]=buf1[13];
		a[4]=buf1[12]; 
		a[5]=buf1[11]; 
		a[6]=buf1[10];//从读取到的数据数组中取出有效值并做以排序
	//	a[4]='\0';
		if(buf1[16] == 0x16 && buf1[10] == 0x34)
		{

		for (m = 0; m < 4; m++)
		{

			b[m]=a[m]-0x33;//对数据做以-33H处理

		}
	//	b[4]='\0';

		tm1 = (b[2]/16)*10+b[2]%16;

		tm2 = (b[3]/16)*10+b[3]%16;//十六进制转浮点型

		result = tm1*10 + tm2/10;

		printf("A相电压为：pv = %.1f\n",result);//结果保留一位小数

		sprintf (sql, "insert into tb_elec values(NULL,now(),%.1f);",result);

		res1 = mysql_query(&my_connection,sql);//向mysql数据库插入数据

		if(!res1)

		{
		printf("Inserted VolA successed\n");

		}
		else{

			printf("Inserted VolA Failed\n");

		}


		}


		else if(buf1[16] == 0x16 && buf1[10] == 0x35)
		{

		for (m = 0; m < 4; m++)
		{

			b[m]=a[m]-0x33;//对数据做以-33H处理

		}
	//	b[4]='\0';

		tm1 = (b[2]/16)*10+b[2]%16;

		tm2 = (b[3]/16)*10+b[3]%16;//十六进制转浮点型

		result = tm1*10 + tm2/10;

		printf("B相电压为：pv = %.1f\n",result);//结果保留一位小数
		sprintf (sql, "insert into tb_elec1 values(NULL,now(),%.1f);",result);

		res1 = mysql_query(&my_connection,sql);//向mysql数据库插入数据

		if(!res1)

		{
		printf("Inserted VolB successed\n");

		}
		else{

			printf("Inserted VolB Failed\n");

		}

		}

	
		if(buf1[16] == 0x16 && buf1[10] == 0x36)
		{

		for (m = 0; m < 4; m++)
		{

			b[m]=a[m]-0x33;//对数据做以-33H处理

		}
	//	b[4]='\0';

		tm1 = (b[2]/16)*10+b[2]%16;

		tm2 = (b[3]/16)*10+b[3]%16;//十六进制转浮点型

		result = tm1*10 + tm2/10;

		printf("C相电压为：pv = %.1f\n",result);//结果保留一位小数
		sprintf (sql, "insert into tb_elec2 values(NULL,now(),%.1f);",result);

		res1 = mysql_query(&my_connection,sql);//向mysql数据库插入数据

		if(!res1)

		{
		printf("Inserted VolC successed\n");

		}
		else{

			printf("Inserted VolC Failed\n");

		}

		}

	}

	//	tcflush(dev_uart_fd,TCIFLUSH);
	  //  bzero(buf1,1024);
	   // bzero(check,1024);
		



#if 0
	if (1 == flag)
	{
		pthread_mutex_lock (&mutex_linklist);
		if ((InsertLinknode (buf)) == -1)
		{
			pthread_mutex_unlock (&mutex_linklist);
			printf ("NONMEM\n");
		}
		pthread_mutex_unlock (&mutex_linklist);
		flag = 0;
		pthread_cond_signal (&cond_analysis);
	}

#endif

		}
	return 0;
}
