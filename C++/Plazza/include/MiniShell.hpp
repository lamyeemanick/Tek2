/*
** EPITECH PROJECT, 2019
** Plazza
** File description:
** MiniShell
*/

#ifndef MINISHELL_HPP_
#define MINISHELL_HPP_

#include <iostream>
#include <stdbool.h>
#include "Errors.hpp"

class MiniShell {
	public:
		MiniShell();
		~MiniShell();

        std::string getCmd() const;
        bool isRunning();

	protected:
	private:
        std::string _line;
};

#endif /* !MINISHELL_HPP_ */
