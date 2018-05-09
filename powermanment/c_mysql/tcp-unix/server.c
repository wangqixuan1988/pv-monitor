#include <stdio.h>
#include <stdlib.h>
#include <unistd.h>
#include <sys/socket.h>
#include <netinet/in.h>
#include <sys/types.h>
#include <arpa/inet.h>
#include <sys/select.h>
#include <string.h>
#include <signal.h>
#include <sys/un.h>

#define  N  128

#define err_log(errlog)  do{perror(errlog); exit(1);}while(0)


int main(int argc, const char *argv[])
{
	
	int sockfd;
	int acceptfd;
	char buf[N] = {};

	struct sockaddr_un  serveraddr, clientaddr;
	socklen_t addrlen = sizeof(clientaddr);


	if((sockfd = socket(AF_UNIX, SOCK_STREAM, 0)) < 0)
	{
		err_log("fail to socket");
	}

	serveraddr.sun_family = AF_UNIX;
	strcpy(serveraddr.sun_path, "mysocket");

	if(bind(sockfd, (struct sockaddr *)&serveraddr, sizeof(serveraddr)) < 0)
	{
		err_log("fail to bind");
	}

	if(listen(sockfd, 5) < 0)
	{
		err_log("fail to listen");
	}

	if((acceptfd = accept(sockfd, (struct sockaddr *)&clientaddr, &addrlen)) < 0)
	{
		err_log("fail to accept");
	}

	while(1)
	{
		if(recv(acceptfd, buf, N, 0) < 0)
		{
			err_log("fail to recv");
		}
		printf("From client:%s\n", buf);
		if(strncmp(buf, "quit", 4) == 0)
		{
			break;
		}
		strcat(buf," from server....");
		if(send(acceptfd, buf, N, 0) < 0)
		{
			err_log("fail to send");
		}
	}

	return 0;
}
