/*
** EPITECH PROJECT, 2019
** constructor
** File description:
** rush01 ex01
*/

#include <string.h>
#include "new.h"
#include "object.h"
#include "player.h"
#include "raise.h"

Object  *new(Class *class, ...)
{
    Class *to_re = malloc(class->__size__);
    va_list ap;

    if (class == NULL)
        return (NULL);
    if (to_re == NULL)
        raise("The memory cannot be allocated");
    to_re = memcpy(to_re, class, class->__size__);
    va_start(ap, class);
    class->__ctor__(to_re, &ap);
    va_end(ap);
    return ((Object *)to_re);
}

Object  *va_new(Class *class, va_list *ap)
{
    Class *to_re;

    if (class == NULL)
        return (NULL);
    to_re = malloc(class->__size__);
    if (to_re == NULL)
        raise("The memory cannot be allocated");
    to_re = memcpy(to_re, class, class->__size__);
    class->__ctor__(to_re, ap);
    return ((Object *)to_re);
}

void    delete(Object *ptr)
{
    Class *buffer;

    if (ptr != NULL) {
        buffer = (Class *)ptr;
        buffer->__dtor__(ptr);
        buffer = NULL;
    }
}
