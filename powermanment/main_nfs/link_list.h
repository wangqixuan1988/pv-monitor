#ifndef __LIST_QUEUE_H____
#define __LIST_QUEUE_H____
#include "data_global.h"

typedef struct msg_pack
{
unsigned char msg_type[4];
int flag1;
unsigned char text[35];
}link_datatype;

typedef struct _node_
{
	link_datatype data;
	struct _node_ *next;
}linknode, *linklist;

extern linklist CreateEmptyLinklist ();
extern int EmptyLinklist (linklist h);
extern linklist GetLinknode (linklist h);
extern int InsertLinknode (link_datatype x);

#endif
