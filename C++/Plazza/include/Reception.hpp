/*
** EPITECH PROJECT, 2019
** Plazza
** File description:
** Reception
*/

#ifndef RECEPTION_HPP_
    #define RECEPTION_HPP_

class Reception {
	public:
		Reception(double multiplier, int cooks, int t);
		~Reception();

        void promptStatus();
        void analyzeCmd();
	protected:
	private:
        double  _multiplier;
        int     _cooks;
        int     _time;
        int     _kitchens;

        std::string _cmd;
};

#endif /* !RECEPTION_HPP_ */
