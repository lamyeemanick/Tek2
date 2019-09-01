/*
** EPITECH PROJECT, 2019
** ftrace
** File description:
** main
*/

#include <stdlib.h>
#include <stdio.h>

void tutu()
{
    printf("I am in tutu()\n");
}

void toto()
{
    printf("I am in toto()\n");
}

int main(int ac, char **av)
{
    toto();
    tutu();
    exit(0);
}