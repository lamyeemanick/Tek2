/*
** EPITECH PROJECT, 2019
** queue
** File description:
** ex04
*/

#include <unistd.h>
#include <stdlib.h>
#include <stdio.h>
#include "queue.h"
#include "generic_list.h"

unsigned int queue_get_size(queue_t queue)
{
    int size = 0;

    for (size = 0; queue != NULL; size++, queue = queue->next);
    return (size);
}

bool_t queue_is_empty(queue_t queue)
{
    if (queue == NULL)
        return (TRUE);
    return (FALSE);
}

bool_t queue_push(queue_t *queue_ptr, void *elem)
{
    queue_t node = malloc(sizeof(*node));
    queue_t tmp = *queue_ptr;

    if (node == NULL)
        return (FALSE);
    node->value = elem;
    node->next = NULL;
    if (queue_is_empty(*queue_ptr) == TRUE)
        *queue_ptr = node;
    else {
        for (tmp; tmp->next != NULL; tmp = tmp->next);
        tmp->next = node;
    }
    return (TRUE);
}

bool_t queue_pop(queue_t *queue_ptr)
{
    queue_t tmp = *queue_ptr;

    if (queue_is_empty(*queue_ptr))
        return (FALSE);
    *queue_ptr = (*queue_ptr)->next;
    free(tmp);
    return (TRUE);
}

void *queue_front(queue_t queue)
{
    if (queue_is_empty(queue))
        return (0);
    return (queue->value);
}
