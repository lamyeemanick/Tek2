##
## EPITECH PROJECT, 2018
## Makefile
## File description:
## Makefile
##

SRC	=	$(SRC_DIR)main.c	\

OBJ	=	$(SRC:.c=.o)

CFLAGS	=	-Lcpp_d03_2018 -lstring -I./cpp_d03_2018 -g

NAME	=	d03

all:	$(OBJ)
	@make -sC ./cpp_d03_2018
	@gcc -o $(NAME) $(OBJ) $(CFLAGS)

clean:
	@make -sC ./cpp_d03_2018 clean
	@rm -f $(OBJ)

fclean:	clean
	@make -sC ./cpp_d03_2018 fclean
	@rm -f $(NAME)

re:	fclean all
