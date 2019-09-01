/*
** EPITECH PROJECT, 2019
** woody
** File description:
** woody
*/

#ifndef WOODY_HPP_
	#define WOODY_HPP_

#include "Toy.hpp"

class Woody : public Toy {
	public:
		Woody(const std::string &name, const std::string &filepath = "woody.txt");
		~Woody() {};

	protected:
	private:
};

#endif /* !WOODY_HPP_ */
