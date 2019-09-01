/*
** EPITECH PROJECT, 2019
** graphic
** File description:
** IDisplay
*/

#ifndef IDISPLAY_HPP_
	#define IDISPLAY_HPP_

class IDisplay {
	public:
		virtual ~IDisplay() = default;

        virtual void openWindow() = 0;

	protected:
	private:
};

#endif /* !IDISPLAY_HPP_ */
