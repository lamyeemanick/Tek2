##
## EPITECH PROJECT, 2019
## Plazza
## File description:
## Makefile
##

SRC	=	main.cpp	\
		./src/Reception.cpp	\
		./src/MiniShell.cpp

OBJ	=	$(SRC:.cpp=.o)

INC	=	./include/

CXXFLAGS=	-W -Wall -Wextra -g -I $(INC)

NAME	=	plazza

all:	$(OBJ)
	g++ -o $(NAME) $(OBJ)

clean:
	rm -rf $(OBJ)

fclean:	clean
	rm -rf $(NAME)

re:	fclean all

.PHONY:	all clean fclean re