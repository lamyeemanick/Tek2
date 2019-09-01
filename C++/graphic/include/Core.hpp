/*
** EPITECH PROJECT, 2019
** graphic
** File description:
** Core
*/

#ifndef CORE_HPP_
#define CORE_HPP_

#include <iostream>
#include "IDisplay.hpp"

class Core {
	public:
		Core(char *libpath);
		~Core();

    IDisplay *loadLib();

	protected:
	private:
        std::string _libpath;
        IDisplay *_lib;
        void *_handle;
};

#endif /* !CORE_HPP_ */
