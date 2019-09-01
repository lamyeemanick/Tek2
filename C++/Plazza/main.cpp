/*
** EPITECH PROJECT, 2019
** Plazza
** File description:
** main
*/

#include <iostream>
#include "Reception.hpp"
#include "Errors.hpp"

int usage(void)
{
    std::cerr << "USAGE:\n\t./plazza x y z" << std::endl;
    std::cerr << "\nDESCRIPTION:" << std::endl;
    std::cerr << "\tx\tmultiplier for the cooking time of the pizzas." << std::endl;
    std::cerr << "\ty\tnumber of cooks per kitchen." << std::endl;
    std::cerr << "\tz (ms)\ttime used by the kitchen stock to replace ingredients." << std::endl;
    return (84);
}

int main(int ac, char **av)
{
    if (ac != 4)
        return (usage());

    /* Welcome to the pizzeria */
    Reception recept(std::atof(av[1]), std::atoi(av[2]), std::atoi(av[3]));
    return (0);
}