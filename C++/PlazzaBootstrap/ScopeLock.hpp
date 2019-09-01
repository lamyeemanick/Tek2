/*
** EPITECH PROJECT, 2019
** PlazzaBootstrap
** File description:
** ScopeLock
*/

#ifndef SCOPELOCK_HPP_
#define SCOPELOCK_HPP_

#include "Mutex.hpp"

class ScopeLock {
	public:
		ScopeLock(Mutex *mutex) {
            _mutex = mutex;
            _mutex->lock();
        };
		~ScopeLock() { _mutex->unlock(); };

	protected:
	private:
        Mutex *_mutex;
};

#endif /* !SCOPELOCK_HPP_ */
