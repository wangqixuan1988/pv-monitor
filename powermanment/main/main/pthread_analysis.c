#include "data_global.h"
#include "link_list.h"
#include "mysql_link_list.h"

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
	unsigned char a[11],b[11];
	float tm0,tm1,tm2,tm3,tm4,result,result1,result2,result3;
	float tm5,tm6,tm7,tm8,tm9;

	a[0]=buf->text[611]; 
	a[1]=buf->text[610]; 
	a[2]=buf->text[609]; 
	a[3]=buf->text[608]; 
	a[4]=buf->text[456];
	a[5]=buf->text[455]; 
	a[6]=buf->text[379]; 
	a[7]=buf->text[378];
	a[8]=buf->text[302]; 
	a[9]=buf->text[301]; 

	for (m = 0; m < 10; m++)
	{

		b[m]=a[m]-0x33;//对数据做以-33

	}


	tm0 = (b[0]/16)*10+b[0]%16;

	tm1 = (b[1]/16)*10+b[1]%16;

	tm2 = (b[2]/16)*10+b[2]%16;

	tm3 = (b[3]/16)*10+b[3]%16;

	tm4 = (b[4]/16)*10+b[4]%16;

	tm5 = (b[5]/16)*10+b[5]%16;

	tm6 = (b[6]/16)*10+b[6]%16;

	tm7 = (b[7]/16)*10+b[7]%16;

	tm8 = (b[8]/16)*10+b[8]%16;

	tm9 = (b[9]/16)*10+b[9]%16;



	result = tm0*10000 + tm1*100 + tm2 + tm3/100;//电能值

	result1 = tm4*10 + tm5/10;//C电压值

	result2 = tm6*10 + tm7/10;//B电压值

	result3 = tm8*10 + tm9/10;//A电压值

    pthread_mutex_lock(&mutex_slinklist);

	sqlite_InsertLinknode (result3,result2,result1,result);

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
            Messageparsing(&buf);

		}
	}
	return 0;
}


