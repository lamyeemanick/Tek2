##
## EPITECH PROJECT, 2019
## strace
## File description:
## Makefile
##

NAME	= test

ASM	= nasm

LD	= gcc

SRC	= main.S

OBJ	= ${SRC:.S=.o}

LDFLAGS	= -fno-builtin

ASMFLAGS= -f elf64

.S.o:
	$(ASM) $(ASMFLAGS) $< -o $@

$(NAME): $(OBJ)
	$(LD) $(OBJ) -o $(NAME) $(LDFLAGS)

all: $(NAME)

clean:
	rm -fr $(OBJ)

fclean: clean
	rm -fr $(NAME)

re: fclean all

.PHONY: all clean fclean re
