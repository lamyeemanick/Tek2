/*
** EPITECH PROJECT, 2019
** main
** File description:
** main
*/

#include  <iostream>
#include "Buzz.hpp"


int  main()
{
    Buzz  toto("Buzz Léklir");
    Toy ET(Toy::ALIEN , "green", "./alien.txt");

    toto.setName("TOTO !");
    if (toto.getType () == Toy:: BASIC_TOY)
        std::cout  << "basic  toy: " << toto.getName () << std::endl
            << toto.getAscii () << std::endl;
    if (ET.getType () == Toy:: ALIEN)
        std::cout  << "this  alien is: " << ET.getName () << std::endl
            << ET.getAscii () << std::endl;
    return  0;
}