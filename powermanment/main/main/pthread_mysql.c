#include "pthread_mysql.h"	
	
extern slinklist slinkHead, slinkTail;

MYSQL my_connection;
/*
**数据库模块任务
*/
void sqlite_task (float VoltageA_t, float VoltageB_t,float VoltageC_t ,float elecpower_t)
{

	char sql[1024];
	char sql1[1024];
	char sql2[1024];
	char sql3[1024];

	int res,res1,res2,res3;

	sprintf (sql, "insert into tb_elec values(NULL,now(),%.1f);",VoltageA_t);

	res = mysql_query(&my_connection,sql);//向mysql数据库插入数据

	if(!res)

	{
		printf("Inserted VolA successed\n");

	}

	else
	{

		printf("Inserted VolA Failed\n");

	}

	sprintf (sql1, "insert into tb_elec1 values(NULL,now(),%.1f);",VoltageB_t);

	res1 = mysql_query(&my_connection,sql1);//向mysql数据库插入数据

	if(!res1)

	{
		printf("Inserted VolB successed\n");

	}

	else
	{

		printf("Inserted VolB Failed\n");

	}
	sprintf (sql2, "insert into tb_elec2 values(NULL,now(),%.1f);",VoltageC_t);

	res2 = mysql_query(&my_connection,sql2);//向mysql数据库插入数据

	if(!res2)

	{
		printf("Inserted VolC successed\n");

	}

	else
	{

		printf("Inserted VolC Failed\n");

	}

	sprintf (sql3, "insert into tb_telec values(NULL,now(),%.2f);",elecpower_t);

	res3 = mysql_query(&my_connection,sql3);//向mysql数据库插入数据

	if(!res3)

	{
		printf("Inserted TE successed\n");

	}

	else
	{

		printf("Inserted TE Failed\n");

	}


}

void *pthread_mysql (void *arg)
{
	slinkHead = sqlite_CreateEmptyLinklist();
	slinklist buf = NULL;
	printf ("slinkHead ok\n");

	printf ("pthread_mysql is ok\n");

	mysql_init(&my_connection); 

	if(mysql_real_connect(&my_connection, "localhost", "root","1","db_pursey", 0, NULL, 0))

	{	printf("Connection success\n");

		if ( mysql_set_character_set( &my_connection, "utf8" )) 
		{  //防止显示乱码

			fprintf ( stderr , "错误, %s/n" , mysql_error(&my_connection)) ; 

		}
	}

	while (1)
	{
		pthread_mutex_lock (&mutex_mysql);
		pthread_cond_wait (&cond_mysql, &mutex_mysql);
		pthread_mutex_unlock (&mutex_mysql);

		printf ("pthread_sqlite is up\n");
#if 0
		while(1 != sqlite_EmptyLinklist(slinkHead))
		{
			sqlite_task (slinkHead->next->data_link, slinkHead->next->data, slinkHead->storageNum, slinkHead->goodsKinds);
			slinkHead = slinkHead->next;
		}
#endif
		while (1)
		{
			pthread_mutex_lock (&mutex_slinklist);
			if ((buf = sqlite_GetLinknode (slinkHead)) == NULL)
			{
				pthread_mutex_unlock (&mutex_slinklist);
				break;
			}
			pthread_mutex_unlock (&mutex_slinklist);
			sqlite_task (buf->VoltageA, buf->VoltageB,buf->VoltageC, buf->elecpower);
			free (buf);
			buf = NULL;
		}
#if 1
		printf ("info come on\n");
#endif
	}
//	return 0;
}




