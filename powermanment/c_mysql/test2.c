#include <stdlib.h>  
#include <stdio.h>  
#include "mysql.h"  
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
#include <linux/ioctl.h>
MYSQL my_connection;
MYSQL_RES *res_ptr;
MYSQL_ROW sqlrow;
#define N 1024

void display_header();
void display_row();
int  pthread_refresh();

struct elec_info {
	int elec_c;
	int elec_v;
};

struct elec_info buf = {5,6};

struct shm_addr
{
	struct elec_info  rt_status;
}; 

struct shm_addr *shm_buf;
//共享内存结构体
int pthread_refresh ()
{
	key_t key_info;

	int shmid, semid;


	if ((key_info = ftok (".", 'i')) < 0)
	{
		perror ("ftok info");
		exit (-1);
	}

	if ((semid = semget (key_info, 1, IPC_CREAT | IPC_EXCL |0666)) < 0)
	{
		if (errno == EEXIST)
		{
			semid = semget (key_info, 1, 0666);
		}
		else
		{
			perror ("semget");
			exit (-1);
		}
	}
#if 0
	else
	{
		init_sem (semid, 0, 1);
	}
#endif
	if ((shmid = shmget (key_info, N, IPC_CREAT | IPC_EXCL | 0666)) < 0)
	{
		if (errno == EEXIST)
		{
			shmid = shmget (key_info, N, 0666);
			shm_buf = (struct shm_addr *)shmat (shmid, NULL, 0);

		}
		else
		{
			perror ("shmget");
			exit (-1);
		}

	}
	else
	{
		if ((shm_buf = (struct shm_addr *)shmat (shmid, NULL, 0)) == (void *)-1)
		{
			perror ("shmat");
			exit (-1);
		}
	}

	bzero (shm_buf, sizeof (struct shm_addr));
	printf ("pthread_refresh is ok!\n");
	//	sem_p (semid, 0);
		shm_buf->rt_status = buf;
	//	sem_v (semid, 0);
	
	return 0;
}


int main (int argc, char *argv[])
{
    
	int first_row =1;
	int res,res1;

	mysql_init(&my_connection);        //连接初始化

	if(mysql_real_connect(&my_connection, "localhost", "root","1","db_pursey", 0, NULL, 0))

	{	printf("Connection success\n");

	if ( mysql_set_character_set( &my_connection, "utf8" )) {  //防止显示乱码 

	fprintf ( stderr , "错误, %s/n" , mysql_error(&my_connection)) ; 

	}
	while(1)
	{  sleep(1);

	char sql[1024];
	sprintf (sql, "insert into tb_elec values(NULL,%d,%d,now());",
			buf.elec_c,
			buf.elec_v);
		
	res1 = mysql_query(&my_connection,sql);//向mysql数据库插入数据

	if(!res1)

	{

		printf("Inserted %lu rows\n",(unsigned long)mysql_affected_rows(&my_connection));

	}
	else{

		fprintf(stderr,"Insert error %d: %s\n",mysql_errno(&my_connection),mysql_error(&my_connection));

	}

	pthread_refresh();
	}
	
	printf("%d\n",shm_buf->rt_status.elec_c,shm_buf->rt_status.elec_v);
	
	res = mysql_query(&my_connection, "select * from tb_elec where id > 0");//查询数据

	if(res){

		fprintf(stderr, "Select error : %s\n", mysql_error(&my_connection));

	}

	else{

	res_ptr = mysql_use_result(&my_connection);

	if(res_ptr){

	display_header();//显示标题

	while((sqlrow = mysql_fetch_row(res_ptr))){

	if(first_row){

	display_header();

	first_row = 0;

		}

	display_row(); //显示每一行信息

	}

	if(mysql_errno(&my_connection)){

	fprintf(stderr, "Retrive error: %s\n", mysql_error(&my_connection));

	}

   }
	mysql_free_result(res_ptr);

	}

	mysql_close(&my_connection);

	}

	else {

	fprintf(stderr,"Connection failed\n");

	if(mysql_errno(&my_connection)){

	fprintf(stderr, "Connection error %d: %s\n", mysql_errno(&my_connection), mysql_error (&my_connection));

		}
	} 

	return EXIT_SUCCESS;
   }

void display_header(){

	MYSQL_FIELD *field_ptr;

	printf("Column details: \n");

	while((field_ptr = mysql_fetch_field(res_ptr))!= NULL){

		printf("\t Name: %s\n", field_ptr->name);

		printf("\t Type: ");

		if(IS_NUM(field_ptr->type)){

			printf("Numeric field\n");

		}

	else{

		switch(field_ptr->type){

		case FIELD_TYPE_VAR_STRING:

			printf("VARCHAR\n");break;

		case FIELD_TYPE_LONG:

			printf("LONG\n");break;

		default:

			printf("Type is %d, check in mysql_com.h\n", field_ptr->type);

			}
		}

	printf("\t Max width %ld\n", field_ptr ->length);

	if(field_ptr->flags & AUTO_INCREMENT_FLAG)

	printf("\t Auto increment\n");

	printf("\n");

	}
}


void display_row(){

	unsigned int field_count;

	field_count = 0;

	while(field_count < mysql_field_count(&my_connection))
	{

	if(sqlrow[field_count])

	printf("%s ", sqlrow[field_count]);

	else printf("NULL");

	field_count++;

	}

	printf("\n");
}
