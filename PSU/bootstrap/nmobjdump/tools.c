/*
** EPITECH PROJECT, 2019
** epo
** File description:
** tools
*/

#include <stdlib.h>
#include <stdio.h>
#include <unistd.h>
#include <dlfcn.h>

void myputchar(char c)
{
    write(1, &c, 1);
}

int my_strlen(char *str)
{
    return ((*str != '\0') ? 1 + my_strlen(str + 1) : 0);
}

// void my_putstr(char *str)
// {
//     void (*putchar)(char);

//     void *handle;
//     handle = dlopen("./libshar.so", RTLD_LAZY);
//     if (!handle)
//         fprintf(stderr, "No such lib there.\n");
//     else {
//         putchar = (void (*)(char)) dlsym(handle, "myputchar");
//         for (int i = 0; str[i] != '\0'; i++)
//             (*putchar)(str[i]);
//     }
//     dlclose(handle);
// }

// void *malloc(size_t size)
// {
//     write(2, "Flying cats are the best!!:", 27);
// }q