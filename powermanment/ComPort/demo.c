#include <stdio.h>  
#include <string.h>  
#include "serialport.h"  
  
int main(int argc,char *argv[])  
{  
    int iResult = -1;     
    int fd = -1,iCommPort,iBaudRate,iDataSize,iStopBit;  
    char cParity;  
    int iLen;  
    char szBuffer[30];  
      
    iCommPort = 1;  
    fd = open_port(iCommPort);  
    if( fd<0 )  
    {  
        perror("open_port error !");  
        return 1;  
    }  
      
    iBaudRate = 115200;  
    iDataSize = 8;  
    cParity = 'N';  
    iStopBit = 1;  
    iResult = set_port(fd,iBaudRate,iDataSize,cParity,iStopBit);      
    if( iResult<0 )  
    {  
        perror("set_port error !");  
        return 1;  
    }     
      
    printf("fd = %d \n",fd);  
      
    memset(szBuffer,0,sizeof(szBuffer));  
    iLen = read_port(fd,szBuffer,5);  
    
    if( iLen>0 )    
    printf("iLen =  %d ,szBuffer = %s \n",iLen,szBuffer);  
    return 0;  
}  
