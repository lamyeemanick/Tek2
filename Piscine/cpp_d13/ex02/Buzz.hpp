/*
** EPITECH PROJECT, 2019
** uz
** File description:
** buz
*/

#ifndef BUZZ_HPP_
	#define BUZZ_HPP_

#include "Toy.hpp"

class Buzz : public Toy {
	public:
		Buzz(const std::string &name, const std::string &filepath = "buzz.txt");
		~Buzz() {};

	protected:
	private:
};

#endif /* !BUZZ_HPP_ */
