##
## EPITECH PROJECT, 2019
## cryptotrader-engine-java
## File description:
## Makefile
##

SRC	=	./c++/main.cpp

OBJ	=	$(SRC:.cpp=.o)

CXXFLAGS	=	-g -Wextra -Wall

NAME	=	trade

all:	$(OBJ)
	g++ -o $(NAME) $(OBJ)

clean:
	rm -rf $(OBJ)

fclean: clean
	rm -rf $(NAME)

re:	fclean all

.PHONY: make re clean fclean all