/*
** EPITECH PROJECT, 2019
** Plazza
** File description:
** Reception
*/

#include "MiniShell.hpp"
#include "Reception.hpp"

void Reception::promptStatus()
{
    std::cout << "Number of kitchen :" << std::endl;
    for (int i = 0; i != 3; i++) {
        std::cout << "Kitchen n°" << i + 1 << " : " <<std::endl;
        std::cout << "Stock :" << std::endl;
        for (int k = 0; k != _cooks; k++)
            std::cout << "Cook n°" << k + 1 << " : Free" << std::endl;
    }
    std::cout << ">>>>>>>>>><<<<<<<<<<" << std::endl;
}

void Reception::analyzeCmd()
{

}

Reception::Reception(double multiplier, int cooks, int t)
{
    _multiplier = multiplier;
    _cooks = cooks;
    _time = t;
    _kitchens = 0;

    MiniShell minishell;
    while (minishell.isRunning()) {
        _cmd = minishell.getCmd();
        if (_cmd.compare("status") == 0)
            promptStatus();
        else if (_cmd.compare("exit") == 0)
            break;
        else
            analyzeCmd();
    }
}

Reception::~Reception()
{
}