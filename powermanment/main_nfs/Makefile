#CC=gcc
CC=gcc
AFLAGS=-Wall -c -g
LDFLAGS= -lpthread  -I/usr/include/mysql  -lmysqlclient  
#LDFLAGS= -lpthread
OBJS=main.o data_global.o pthread_transfer.o pthread_analysis.o \
link_list.o pthread_mysql.o sqlite_link_list.o 

main :$(OBJS)
	$(CC) -o $@ $^ $(LDFLAGS)
$(OBJS):%.o:%.c
	$(CC) $(AFLAGS) $< -o $@

.PHONY:clean
clean:
	rm *.o main 

