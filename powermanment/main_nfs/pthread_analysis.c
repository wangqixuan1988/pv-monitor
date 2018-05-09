#include "data_global.h"
#include "link_list.h"
#include "sqlite_link_list.h"

extern linklist linkHead;
extern linklist slinkHead;

extern pthread_mutex_t mutex_linklist;
extern pthread_mutex_t mutex_analysis;
extern pthread_mutex_t mutex_global;
extern pthread_cond_t cond_analysis;
extern pthread_cond_t cond_mysql;
extern pthread_mutex_t mutex_slinklist;

void Messageparsing(link_datatype *buf)
{   
	int m;
	unsigned char a[8],b[5];
	float tm1,tm2,tm3,tm4,result,result1;

	a[0]=buf->text[32];
	a[1]=buf->text[31]; 
	a[2]=buf->text[30]; 
	a[3]=buf->text[29];
	a[4]=buf->text[28]; 
	a[5]=buf->text[27]; 
	a[6]=buf->text[26]; 

	for (m = 0; m < 4; m++)
	{

		b[m]=a[m]-0x33;//对数据做以-33

	}


	tm1 = (b[0]/16)*10+b[0]%16;

	tm2 = (b[1]/16)*10+b[1]%16;

	tm3 = (b[2]/16)*10+b[2]%16;

	tm4 = (b[3]/16)*10+b[3]%16;//十六进制转浮点型

	result = tm1*10000 + tm2*100 + tm3 + tm4/100;//电能值

	result1 = tm3*10 + tm4/10;//电压值

    pthread_mutex_lock(&mutex_slinklist);

	sqlite_InsertLinknode (buf->flag1, result1, result);

	pthread_mutex_unlock (&mutex_slinklist);

	pthread_cond_signal (&cond_mysql);

    return;
	
}



void *pthread_analysis (void *arg)
{
	linklist node;
	link_datatype buf;
	printf ("pthread_analysis is ok\n");
	while (1)
	{
		pthread_mutex_lock (&mutex_analysis);
		pthread_cond_wait (&cond_analysis, &mutex_analysis);
		pthread_mutex_unlock (&mutex_analysis);

		//		printf ("wake pthread_analysis wake up\n");
		while (1)
		{
			pthread_mutex_lock (&mutex_linklist);

			if ((node = GetLinknode (linkHead)) == NULL)
			{
				pthread_mutex_unlock (&mutex_linklist);
				break;
			}
			buf = node->data;
			free (node);
			pthread_mutex_unlock (&mutex_linklist);

			 if (buf.msg_type[0] == 0x16 && buf.msg_type[1] == 0x34 )
			{
				buf.flag1 = 1;
				Messageparsing(&buf);
			}

			else if(buf.msg_type[0] == 0x16 && buf.msg_type[1] == 0x35 )
			{
				buf.flag1 = 2;
				Messageparsing(&buf);
			}

			else if (buf.msg_type[0] == 0x16 && buf.msg_type[1] == 0x36 )
			{
				buf.flag1 = 3;
				Messageparsing(&buf);
			}

			else if (buf.msg_type[2] == 0x33 && buf.msg_type[3] == 0x34 )
			{
				buf.flag1 = 4;
				Messageparsing(&buf);
			} 

			else if (buf.msg_type[2] == 0x33 && buf.msg_type[3] == 0x33 )
			{
				buf.flag1 = 5;
				Messageparsing(&buf);
			}

		}
	}
	return 0;
}


