/*
** EPITECH PROJECT, 2019
** toy
** File description:
** toy
*/

#ifndef TOY_HPP_
	#define TOY_HPP_

#include <iostream>
#include "Picture.hpp"

class Toy {
	public:
        typedef enum {
            BASIC_TOY,
            ALIEN
        } ToyType;

        Toy(ToyType type, const std::string &name, const std::string &filepath);
        Toy(const Toy &other);
		Toy();
		~Toy() {};

        const ToyType &getType() const { return (_type); };
        const std::string &getName() const { return (_name); };
        void setName(const std::string &name) { _name.assign(name.c_str()); };
        bool setAscii(const std::string &filepath);
        const std::string &getAscii() { return (_pic.data); };

        void operator=(const Toy &other);

	protected:
	private:
        ToyType _type;
        std::string _name;
        Picture _pic;
};

#endif /* !TOY_HPP_ */
