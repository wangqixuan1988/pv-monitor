#ifndef __SQLITE_LIST_QUEUE_H____
#define __SQLITE_LIST_QUEUE_H____
#include "data_global.h"

#if 0
typedef struct msg_pack
{
	char msg_type;
	char text[27];
}link_datatype;
//typedef int link_datatype;
#endif 

typedef struct _snode_
{
	int operation_data;
	float Voltage;
	float elecpower;
	struct _snode_ *next;
}slinknode, *slinklist;

extern slinklist sqlite_CreateEmptyLinklist ();
extern int sqlite_EmptyLinklist (slinklist h);
extern slinklist sqlite_GetLinknode (slinklist h);
extern int sqlite_InsertLinknode (int operation, float Voltage_l, float elecpower_l);

#endif
