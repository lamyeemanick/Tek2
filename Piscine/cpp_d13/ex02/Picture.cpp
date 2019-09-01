/*
** EPITECH PROJECT, 2019
** pic
** File description:
** pic
*/

#include <fstream>
#include "Picture.hpp"

bool Picture::getPictureFromFile(const std::string &filepath)
{
    std::ifstream file(filepath.c_str());

 	if (!file.is_open()) {
		data.assign("ERROR");
		return (false);
	}
    data.assign((std::istreambuf_iterator<char>(file)),
                    (std::istreambuf_iterator<char>()));
    file.close();
    return (true);
}

Picture::Picture(const Picture &other)
{
    (*this) = other;
}

void Picture::operator=(const Picture &other)
{
    data.assign(other.data);
}