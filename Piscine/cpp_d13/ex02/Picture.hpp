/*
** EPITECH PROJECT, 2019
** pic
** File description:
** pic
*/

#ifndef PICTURE_HPP_
	#define PICTURE_HPP_

#include <iostream>

class Picture {
	public:
        Picture(const std::string &filepath) { getPictureFromFile(filepath); };
        Picture(const Picture &other);
		Picture() { data.assign(""); };
		~Picture() {} ;

        bool getPictureFromFile(const std::string &filepath);

        void operator=(const Picture &other);

        std::string data;

	protected:
	private:
};

#endif /* !PICTURE_HPP_ */
