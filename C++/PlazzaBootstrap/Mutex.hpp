/*
** EPITECH PROJECT, 2019
** PlazzaBootstrap
** File description:
** Mutex
*/

#ifndef MUTEX_HPP_
#define MUTEX_HPP_

#include <pthread.h>
#include "IMutex.hpp"

class Mutex : public IMutex {
	public:
		Mutex() { _mutex = PTHREAD_MUTEX_INITIALIZER; };
		~Mutex() { pthread_mutex_destroy( &_mutex); };

        void lock() { pthread_mutex_lock(&_mutex); };
        void unlock() { pthread_mutex_unlock(&_mutex); };
        void trylock() { pthread_mutex_trylock(&_mutex); };

	protected:
	private:
        pthread_mutex_t _mutex;
};

#endif /* !MUTEX_HPP_ */
