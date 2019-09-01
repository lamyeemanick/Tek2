/*
** EPITECH PROJECT, 2019
** graphic
** File description:
** main
*/

#include <SFML/Graphics.hpp>
#include "Core.hpp"
#include "IDisplay.hpp"

int main(int ac, char **av)
{
    if (ac != 2)
        return (84);
    Core bite(av[1]);
}