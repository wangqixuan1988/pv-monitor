CC=gcc
CFLAGS=-Wall -c -O2
OBJS=server
OBJ=client

all:$(OBJS) $(OBJ)

$(OBJS):$(OBJS).o
	$(CC) $< -o $@

$(OBJ):$(OBJ).o
	$(CC) $< -o $@

$(OBJS).o:$(OBJS).c
	$(CC) $(CFLAGS) $^ -o $@

$(OBJ).o:$(OBJ).c
	$(CC) $(CFLAGS) $^ -o $@

.PHONY: clean

clean:
	rm *.o $(OBJS) $(OBJ) -rf

