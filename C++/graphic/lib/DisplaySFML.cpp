/*
** EPITECH PROJECT, 2019
** graphic
** File description:
** DisplaySFML
*/

#include "DisplaySFML.hpp"

void DisplaySFML::openWindow()
{
    sf::RenderWindow window(sf::VideoMode(800, 600), "SFML window");
    while (window.isOpen()) {
        sf::Event event;
        while (window.pollEvent(event)) {
            if (event.type == sf::Event::Closed)
                window.close();
        }
        window.clear();
        window.display();
    }
}

DisplaySFML::DisplaySFML()
{
}

DisplaySFML::~DisplaySFML()
{
}

extern "C" {
    IDisplay *fuckYou() {
        return (new DisplaySFML());
    }
}