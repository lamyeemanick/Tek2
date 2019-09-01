/*
** EPITECH PROJECT, 2019
** graphic
** File description:
** Core
*/

#include "Core.hpp"
#include <dlfcn.h>

IDisplay *Core::loadLib()
{
    IDisplay *(*cosine)();
    IDisplay *lib;

    _handle = dlopen(_libpath.c_str(), RTLD_NOW);
    if (!_handle) {
        fprintf(stderr, "%s\n", dlerror());
        exit(EXIT_FAILURE);
    }
    cosine = (IDisplay *(*)())dlsym(_handle, "fuckYou");
    lib = cosine();
    return (lib);
}

Core::Core(char *libpath)
{
    _libpath.assign(libpath);
    _lib = loadLib();
    _lib->openWindow();
 }

Core::~Core()
{
    dlclose(_handle);
}
