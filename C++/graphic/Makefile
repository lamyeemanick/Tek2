##
## EPITECH PROJECT, 2019
## OOP_nanotekspice_2018
## File description:
## Makefile
##

SRC_DIR	=	./core/

SRC	=	main.cpp 		\
		$(SRC_DIR)Core.cpp

LIB_DIR	=	lib/

GAME_DIR=	games/

OBJ	=	$(SRC:.cpp=.o)

CXXFLAGS=	-W -Wall -Wextra -Iinclude -ldl

NAME	=	arcade

all:	$(OBJ)
	make -sC lib/
	@g++ -o $(NAME) $(OBJ) $(CXXFLAGS)

clean:
	make -sC lib/ clean
	@rm -f $(OBJ)

fclean:	clean
	make -sC lib/ fclean
	@rm -f $(NAME)

re:	fclean all
