##
## EPITECH PROJECT, 2019
## PSU_2018_malloc
## File description:
## Makefile
##

SRC	=	tools.c

OBJ	=	$(SRC:.c=.o)

NAME	=	as.so

all:
	gcc -c -fpic $(SRC)
	gcc -shared -o $(NAME) $(OBJ)

clean:
	rm -rf $(OBJ)

fclean:	clean
	rm -rf $(NAME)

re:	fclean all
