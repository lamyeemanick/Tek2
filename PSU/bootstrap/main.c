/*
** EPITECH PROJECT, 2019
** main
** File description:
** main
*/

#include <string.h>
#include <stdio.h>
#include <unistd.h>
#include <dlfcn.h>

int main()
{
    char *str = sbrk(getpagesize());
    // char *str = malloc(6);
    strcpy(str, "hello");
    printf("%s\n", str);
    // printf("%s\n", str);
}
