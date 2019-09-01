/*
** EPITECH PROJECT, 2019
** PlazzaBootstrap
** File description:
** ThreadPool
*/

#include "Thread.hpp"

#ifndef THREADPOOL_HPP_
#define THREADPOOL_HPP_

class ThreadPool {
	public:
		ThreadPool(int size) {
            _size = size;
            for (int i = 0; i != _size; i ++)
                _thread[i] = new Thread;
        };
		~ThreadPool() {
            for (int i = 0; i != _size; i ++)
                delete _thread[i];
        };

        Thread *getThreadAt(int pos) { return (_thread[pos]); };

	protected:
	private:
        int _size;
        Thread *_thread[];

};

#endif /* !THREADPOOL_HPP_ */

