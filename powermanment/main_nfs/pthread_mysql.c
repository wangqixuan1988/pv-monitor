#include "pthread_sqlite.h"	
	
extern slinklist slinkHead, slinkTail;

MYSQL my_connection;
/*
**数据库模块任务
*/
void sqlite_task (int operation_t, float Voltage_t, float elecpower_t)
{
	
	char sql[1024];

	int res;

	switch(operation_t)
	{
	case 1:

		sprintf (sql, "insert into tb_elec values(NULL,now(),%.1f);",Voltage_t);

		res = mysql_query(&my_connection,sql);//向mysql数据库插入数据

		if(!res)

		{
			printf("Inserted VolA successed\n");

		}

		else
		{

			printf("Inserted VolA Failed\n");

		}

		break;

	case 2:

		sprintf (sql, "insert into tb_elec1 values(NULL,now(),%.1f);",Voltage_t);

		res = mysql_query(&my_connection,sql);//向mysql数据库插入数据

		if(!res)

		{
			printf("Inserted VolB successed\n");

		}

		else
		{

			printf("Inserted VolB Failed\n");

		}

		break;

	case 3:

		sprintf (sql, "insert into tb_elec2 values(NULL,now(),%.1f);",Voltage_t);

		res = mysql_query(&my_connection,sql);//向mysql数据库插入数据

		if(!res)

		{
			printf("Inserted VolC successed\n");

		}

		else
		{

			printf("Inserted VolC Failed\n");

		}

		break;

	case 4:

		sprintf (sql, "insert into tb_pelec values(NULL,now(),%.2f);",elecpower_t);

		res = mysql_query(&my_connection,sql);//向mysql数据库插入数据

		if(!res)

		{
			printf("Inserted PE successed\n");

		}

		else
		{

			printf("Inserted PE Failed\n");

		}

		break;

	case 5:

		sprintf (sql, "insert into tb_telec values(NULL,now(),%.2f);",elecpower_t);

		res = mysql_query(&my_connection,sql);//向mysql数据库插入数据

		if(!res)

		{
			printf("Inserted TE successed\n");

		}

		else
		{

			printf("Inserted TE Failed\n");

		}

		break;
	}

}

void *pthread_mysql (void *arg)
{
	slinkHead = sqlite_CreateEmptyLinklist();
	slinklist buf = NULL;
	printf ("slinkHead ok\n");

	printf ("pthread_sqlite is ok\n");

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
#if DEBUG_SQLITE
		printf ("pthread_sqlite is up\n");
#endif
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
			sqlite_task (buf->operation_data, buf->Voltage, buf->elecpower);
			free (buf);
			buf = NULL;
		}
#if DEBUG_SQLITE
		printf ("info come on\n");
#endif
	}
//	return 0;
}




