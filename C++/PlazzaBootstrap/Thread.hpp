/*
** EPITECH PROJECT, 2019
** PlazzaBootstrap
** File description:
** Thread
*/

#ifndef THREAD_HPP_
#define THREAD_HPP_

#include "Mutex.hpp"

class Thread {
    public:
        enum status_e {
            STARTED,
            RUNNING,
            DEAD
        };
		Thread() { _status = STARTED; };
		~Thread() {};

        void createThread(void *(*fct)(void *), void *args) {
            pthread_create(&_thread, NULL, fct, args);
            _status = RUNNING;
        };
        void joinThread() {
            pthread_join(_thread, NULL);
            _status = DEAD;
        };

	protected:
	private:
        pthread_t _thread;
        status_e _status;
};

#endif /* !THREAD_HPP_ */
