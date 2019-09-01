/*
** EPITECH PROJECT, 2019
** PlazzaBootstrap
** File description:
** main
*/

#include <pthread.h>
#include <unistd.h>
#include <iostream>
#include <vector>
#include "ScopeLock.hpp"
#include "Thread.hpp"
#include "Mutex.hpp"
#include "ThreadPool.hpp"

#define N_THREAD 15

Mutex mumu;

void *incrementCounter(void *args)
{
    ScopeLock scoopyDoo(&mumu);
    for (int i = 0; i != 10; i++) {
        *((int *)args) += 1;
        usleep(20000);
    }
    pthread_exit(NULL);
}

void exercise1()
{
    int n = 0;
    Thread t1;
    Thread t2;
    std::vector<Thread *> tp;

    for (int i = 0; i != N_THREAD; i++) {
        tp.push_back(new Thread);
    }
    for (int i = 0; i != N_THREAD; i++) {

        tp.at(i)->createThread(&incrementCounter, (void *)&n);
        tp.at(i)->joinThread();
    }
        
        std::cout << "n = " << n << std::endl;
}


int main()
{
    exercise1();
}