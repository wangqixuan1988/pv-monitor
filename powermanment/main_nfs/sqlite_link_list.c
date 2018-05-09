#include "sqlite_link_list.h"
#include "data_global.h"

extern slinklist slinkHead, slinkTail;

slinklist sqlite_CreateEmptyLinklist ()
{
	slinklist h;
	h = (slinklist)malloc (sizeof (slinknode));
	printf ("%d\n", sizeof (slinknode));
	slinkTail = h;
	h->next = NULL;
	return h;
}

int sqlite_EmptyLinklist (slinklist h)
{
		return NULL == h->next;
}

slinklist sqlite_GetLinknode (slinklist h)
{
	if (1 == sqlite_EmptyLinklist (h))	
	{
		return NULL;
	}
	slinklist p = h->next;
	h->next = p->next;
	if (p->next == NULL)
		slinkTail = h;
	return p;
}

int sqlite_InsertLinknode (int operation, float Voltage_l, float elecpower_l)
{

	slinklist q = (slinklist)malloc (sizeof (slinknode));
	if (NULL == q)
	{
		printf ("InsertLinknode Error\n");
		return -1;
	}
	slinkTail->next = q;
	slinkTail = q;
	q->operation_data = operation;
	q->Voltage = Voltage_l;
	q->elecpower = elecpower_l;
	q->next = NULL;
	return 0;
}


