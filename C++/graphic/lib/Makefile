##
## EPITECH PROJECT, 2019
## graphic
## File description:
## Makefile
##

SRC	=	DisplaySFML.cpp

OBJ	=	$(SRC:.cpp=.o)

INC_DIR	=	../include

CXXFLAGS=	-fPIC -shared -W -Wall -Wextra -I$(INC_DIR)

LDFLAGS	=	-lsfml-graphics -lsfml-window

SFML	=	lib_arcade_sfml.so

all:	sfml

sfml:	$(OBJ)
	@g++ -o $(SFML) $(OBJ) $(CXXFLAGS) $(LDFLAGS)

clean:
	@rm -f $(OBJ)

fclean:	clean
	@rm -f $(SFML)

re:	fclean all
