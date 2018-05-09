#include <stdio.h>
#include <pthread.h>
#include <errno.h>
#include <signal.h>
#include <unistd.h>
#include <sys/shm.h>
#include <sys/sem.h>
#include <sys/ipc.h>
#include "data_global.h"


extern pthread_cond_t cond_mysql;
extern pthread_cond_t cond_analysis;


extern pthread_mutex_t mutex_mysql;
extern pthread_mutex_t mutex_analysis;
extern pthread_mutex_t mutex_linklist;
extern pthread_mutex_t mutex_global;
extern pthread_mutex_t mutex_slinklist;


pthread_t	id_mysql,
			id_analysis,
			id_transfer;


void ReleaseResource (int signo)
{
	pthread_mutex_destroy (&mutex_linklist);
	pthread_mutex_destroy (&mutex_global);
	pthread_mutex_destroy (&mutex_analysis);
	pthread_mutex_destroy (&mutex_mysql);
	pthread_mutex_destroy (&mutex_slinklist);

	pthread_cond_destroy (&cond_analysis);
	pthread_cond_destroy (&cond_mysql);

	pthread_cancel (id_transfer);
	pthread_cancel (id_analysis);
	pthread_cancel (id_mysql);
#if 0
	msgctl (msgid, IPC_RMID, NULL);
	shmctl (shmid, IPC_RMID, NULL);
	semctl (semid, 1, IPC_RMID, NULL);

	pthread_cancel (id_refresh);
	pthread_cancel (id_sms);
	pthread_cancel (id_camera);
	pthread_cancel (id_led);
	pthread_cancel (id_buzzer);
	pthread_cancel (id_infrared);
	pthread_cancel (id_client_request);
	pthread_cancel (id_uart_cmd);

	close (dev_camera_fd);
	close (dev_led_fd);
	close (dev_buzzer_fd);
	close (dev_infrared_fd);
	close (dev_sms_fd);
	close (dev_uart_fd);
#endif

	printf ("All quit\n");

	exit(0);
}


int main(int argc, char **argv)
{
    
	pthread_mutex_init (&mutex_mysql, NULL);
	pthread_mutex_init (&mutex_analysis, NULL);
	pthread_mutex_init (&mutex_linklist, NULL);
    pthread_mutex_init (&mutex_slinklist, NULL);

	pthread_cond_init (&cond_mysql, NULL);
	pthread_cond_init (&cond_analysis, NULL);
#if 0
	pthread_mutex_init (&mutex_uart_cmd, NULL);
	pthread_mutex_init (&mutex_slinklist, NULL);
	pthread_mutex_init (&mutex_client_request, NULL);
	pthread_mutex_init (&mutex_infrared, NULL);
	pthread_mutex_init (&mutex_buzzer, NULL);
	pthread_mutex_init (&mutex_led, NULL);
	pthread_mutex_init (&mutex_camera, NULL);
	pthread_mutex_init (&mutex_sms, NULL);
	pthread_mutex_init (&mutex_refresh, NULL);
	pthread_mutex_init (&mutex_refresh_updata, NULL);
	pthread_mutex_init (&mutex_global, NULL);
#endif

#if 0
	pthread_cond_init (&cond_uart_cmd, NULL);
	pthread_cond_init (&cond_client_request, NULL);
	pthread_cond_init (&cond_infrared, NULL);
	pthread_cond_init (&cond_buzzer, NULL);
	pthread_cond_init (&cond_led, NULL);
	pthread_cond_init (&cond_camera, NULL);
	pthread_cond_init (&cond_sms, NULL);
	pthread_cond_init (&cond_refresh, NULL);
	pthread_cond_init (&cond_refresh_updata, NULL);
#endif

	signal (SIGINT, ReleaseResource);


	sleep (1);

	pthread_create (&id_analysis, 0, pthread_analysis, NULL);
	pthread_create (&id_transfer, 0, pthread_transfer, NULL);
	pthread_create (&id_mysql,0, pthread_mysql, NULL);

	sleep (1);
	pthread_join (id_mysql, NULL);
	printf ("g1\n");
	pthread_join (id_analysis, NULL);
	printf ("g2\n");
	pthread_join (id_transfer, NULL);
	printf ("g3\n");

#if 0
	pthread_create (&id_sqlite, 0, pthread_sqlite, NULL);
	pthread_create (&id_uart_cmd, 0, pthread_uart_cmd, NULL);
	pthread_create (&id_client_request, 0, pthread_client_request, NULL);
	pthread_create (&id_infrared, 0, pthread_infrared, NULL);
	pthread_create (&id_buzzer, 0, pthread_buzzer, NULL);
	pthread_create (&id_led, 0, pthread_led, NULL);
	pthread_create (&id_camera, 0, pthread_camera, NULL);
	pthread_create (&id_sms, 0, pthread_sms, NULL);
	pthread_create (&id_refresh, 0, pthread_refresh, NULL);

	pthread_join (id_sqlite, NULL);
	printf ("g1\n");
	pthread_join (id_uart_cmd, NULL);
	printf ("g4\n");
	pthread_join (id_client_request, NULL);
	printf ("g5\n");
	pthread_join (id_infrared, NULL);
	printf ("g6\n");
	pthread_join (id_buzzer, NULL);
	printf ("g7\n");
	pthread_join (id_led, NULL);
	printf ("g8\n");
	pthread_join (id_camera, NULL);
	printf ("g9\n");
	pthread_join (id_sms, NULL);
	printf ("g10\n");
	pthread_join (id_refresh, NULL);
	printf ("g11\n");
#endif

	return 0;
}
