#include <stdio.h>
#include <stdlib.h>
#include <unistd.h>
#include <sys/socket.h>
#include <netinet/in.h>
#include <sys/types.h>
#include <arpa/inet.h>
#include <string.h>
#include <sys/un.h>


#define   N  128
#define err_log(errlog)  do{perror(errlog); exit(1);}while(0)

int main(int argc, const char *argv[])
{
	
	int sockfd;
	struct sockaddr_un  serveraddr, clientaddr;
	socklen_t addrlen = sizeof(clientaddr);
	char buf[N] = {};

	if((sockfd = socket(AF_UNIX, SOCK_STREAM, 0)) < 0)
	{
		err_log("fail to socket");
	}

	serveraddr.sun_family = AF_UNIX;
	strcpy(serveraddr.sun_path, "mysocket");

	if(connect(sockfd, (struct sockaddr *)&serveraddr, sizeof(serveraddr)) < 0)
	{
		err_log("fail to connect");
	}
	while(1)
	{

		printf("Input >");
		fgets(buf, N, stdin);
		buf[strlen(buf)-1] = '\0';
		
		if(send(sockfd, buf, N, 0) < 0)
		{
			err_log("fail to send");
		}
		if(strncmp(buf, "quit", 4) == 0)
		{
			break;
		}
		if(recv(sockfd, buf, N, 0) < 0)
		{
			err_log("fail to recv");
		}
		printf("%s\n", buf);

	}

	close(sockfd);

	return 0;
}
