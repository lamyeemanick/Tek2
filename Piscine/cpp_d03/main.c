/*
** EPITECH PROJECT, 2019
** main
** File description:
** main
*/

#include <stdlib.h>
#include <unistd.h>
#include <stdio.h>
#include <string.h>
#include "string.h"


int  main()
{
    string_t s;
    string_init (&s, "Hello  World");
    printf("%sn", s.str);
    string_destroy (&s);
    return  (0);
}
