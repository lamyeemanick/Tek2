/*
** EPITECH PROJECT, 2019
** bootstrap
** File description:
** main
*/

#include <string.h>
#include <unistd.h>
#include <dlfcn.h>
#include <elf.h>
#include  <fcntl.h>
#include  <stdio.h>
#include  <sys/mman.h>
#include  <sys/stat.h>

void toto(void)
{
    write(1, "toto-camion\n", 12);
}

// int main(int ac, char **av)
// {
//     void (*abt)(void);

//     void *handle;
//     handle = dlopen(av[1], RTLD_LAZY);
//     if (!handle)
//         fprintf(stderr, "Fail open gros\n");
//     else {
//         abt = (void (*)(void)) dlsym(handle, "about");
//         (*abt)();
//         dlclose(handle);
//     }
// }

int main(int ac , char **av)
{
    void *buf;
    struct stat s;
    Elf64_Ehdr *elf;
    int fd = open(av[1], O_RDONLY);

    if (fd !=  -1) {
        fstat(fd, &s);
        buf = mmap(NULL, s.st_size, PROT_READ, MAP_PRIVATE, fd, 0);
        if (buf !=  -1) {
            printf("mmap(%s) : %08x\n", av[1], buf);
            elf = buf;
            printf("Section Header Table : addr = %08x, nb = %d\n", elf ->e_shoff , elf ->e_shnum);
        } else {
            perror("mmap");
        }
        close(fd);
    }
}