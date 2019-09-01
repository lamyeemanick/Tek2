/*
** EPITECH PROJECT, 2019
** toy
** File description:
** toy
*/

#include "Toy.hpp"

bool Toy::setAscii(const std::string &filepath)
{
    _pic = Picture(filepath);
    if (_pic.data == "ERROR")
        return (false);
    return (true);
}

Toy::Toy(const Toy &other)
{
    (*this) = other;
}

Toy::Toy(ToyType type, const std::string &name, const std::string &filepath)
{
    _type = type;
    setName(name);
    setAscii(filepath);
}

Toy::Toy()
{
    _type = BASIC_TOY;
    _name.assign("toy");
    _pic = Picture();
}

void Toy::operator=(const Toy &other)
{
    _type = other.getType();
    _name.assign(other.getName());
    _pic = other._pic;
}