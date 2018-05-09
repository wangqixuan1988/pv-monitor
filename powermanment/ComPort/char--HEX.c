#include <stdio.h>
#include <string.h>
 
unsigned char t[256] = {
     0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0,
     0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0,
     0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0,
     0, 1, 2, 3, 4, 5, 6, 7, 8, 9,10,11,12,13,14,15,
     0,10,11,12,13,14,15, 0, 0, 0, 0, 0, 0, 0, 0, 0,
     0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0,
     0,10,11,12,13,14,15, 0, 0, 0, 0, 0, 0, 0, 0, 0,
     0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0,
     0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0,
};
 
int s2h(const char *s, char *h)
{
    int r, i, n;
    char *p, q;
 
    p = h;
    n = strlen(s);
    if (n % 2) {
        h[0] = t[(unsigned char)s[0]];
        ++p;
        ++s;
    }
 
    for (i = 0; i < n; i = i + 2) {
        *(p++) = (t[(unsigned char)s[i]] << 4) | t[(unsigned char)s[i + 1]];
    }
 
    return (n + 1) / 2;
}
 
int main(int argc, char *argv[])
{
    char s[] = "a4e56EF";
    char h[1024];
    int i, n;
 
    n = s2h(s, h);
    for (i = 0; i < n; ++i) {
        printf("%02x\n", (unsigned char)h[i]);
    }

    return 0;
}