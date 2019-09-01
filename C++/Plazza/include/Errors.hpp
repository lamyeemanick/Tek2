/*
** EPITECH PROJECT, 2019
** Plazza
** File description:
** Errors
*/

#ifndef ERRORS_HPP_
#define ERRORS_HPP_

#include <iostream>

class Errors : public std::exception {
	public:
		Errors(std::string const &message) : _msg(message) {};
		~Errors();

        const char *what() const noexcept override { return (_msg.c_str()); };
	protected:
        std::string _msg;
	private:
};

#endif /* !ERRORS_HPP_ */
