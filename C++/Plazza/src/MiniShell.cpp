/*
** EPITECH PROJECT, 2019
** Plazza
** File description:
** MiniShell
*/

#include "MiniShell.hpp"

std::string MiniShell::getCmd() const
{
    return (_line);
}

bool MiniShell::isRunning()
{
    std::cout << "_> ";
    std::getline(std::cin, _line);
    if (!_line.empty())
        return (1);
    return (0);
}

MiniShell::MiniShell()
{
}

MiniShell::~MiniShell()
{
}
