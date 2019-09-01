/*
** EPITECH PROJECT, 2019
** graphic
** File description:
** DisplaySFML
*/

#ifndef DISPLAYSFML_HPP_
	#define DISPLAYSFML_HPP_

#include <SFML/Graphics.hpp>
#include "IDisplay.hpp"

class DisplaySFML : public IDisplay {
	public:
		DisplaySFML();
		~DisplaySFML();

        void openWindow();

	protected:
	private:
};

#endif /* !DISPLAYSFML_HPP_ */
