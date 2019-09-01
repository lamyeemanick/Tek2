##
## EPITECH PROJECT, 2019
## ftrace
## File description:
## Makefile
##

SRC	=	main.c

SRC_TOTO=	toto.c

OBJ	=	$(SRC:.c=.o)

OBJ_TOTO=	$(SRC_TOTO:.c=.o)

NAME	=	symbol-finder

TOTO	=	toto

all:	symbol toto

symbol: $(OBJ)
	gcc -o $(NAME) $(OBJ) -lelf

toto:	$(OBJ_TOTO)
	gcc -o $(TOTO) -pipe -O2 $(OBJ_TOTO)

clean:
	rm -rf $(OBJ_TOTO)

fclean:	clean
	rm -rf $(TOTO)

re:	fclean all

.PHONY:	all clean fclean re