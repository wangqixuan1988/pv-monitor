#include <stdlib.h>  
#include <stdio.h>  
#include "mysql.h"  

int main (int argc, char *argv[])  
{  
	MYSQL *conn_ptr;  
	conn_ptr=mysql_init(NULL); //连接初始化  
	if(!conn_ptr){  
		fprintf(stderr, "mysql_init failed\n");  
		return EXIT_FAILURE;  
	}  

	conn_ptr = mysql_real_connect(conn_ptr, "localhost", "root","1","db_pursey", 0, NULL, 0); //建立实际连接参数分别为：连接成功返回操作句柄，否则返回NULL,初始化的连接句柄指针，主机名（或者IP），用户名，密码，数据库名，0，NULL，0）后面三个参数在默认安装mysql>的情况下不用改  
	if(conn_ptr){  
		printf("Connection success\n");  
	}                                                                                        
	else
	{  
		printf("Connection failed\n");  
	}  
	if(mysql_query(conn_ptr,"update tb_info set type=家教信息"))
	{
		printf("执行失败：%s",mysql_error(conn_ptr));
		return;
	}
	printf("更新成功，共更新完成%d条",mysql_affected_rows(conn_ptr));
}

	mysql_close(conn_ptr);	//关闭连接  
	return EXIT_SUCCESS;  
}
