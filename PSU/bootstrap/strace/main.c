/*
** EPITECH PROJECT, 2019
** strace
** File description:
** main
*/

#include <stdio.h>
#include <unistd.h>
#include <sys/types.h>
#include <sys/time.h>
#include <sys/resource.h>
#include <sys/wait.h>
#include <syscall.h>
#include <stdlib.h>
#include <sys/user.h>
#include <limits.h>
#include <sys/ptrace.h>

void test_ptrace(char *program, char **arg, char **env)
{
    int w8 = 0;
    pid_t pid;
    int sysc;
    unsigned short instr;
    struct user_regs_struct regs;
    struct user_regs_struct regs_ret;
    
    pid = fork();
    if (pid == 0) {
        ptrace(PTRACE_TRACEME, 0, NULL, NULL);
        execve(program, arg, env);
    } else {
        wait4(pid, &w8, WUNTRACED, NULL);
        while ((WSTOPSIG(w8) == SIGTRAP || WSTOPSIG(w8) == SIGSTOP) && WIFSTOPPED(w8)) {
            if (ptrace(PTRACE_GETREGS, pid, NULL, &regs))
                perror ("ptrace");
            printf("system call %d ret 0x%x %x\n", regs.orig_rax, regs.rax, regs.rsi);
            if (ptrace(PTRACE_GETREGS, pid, NULL, &regs))
                perror ("ptrace");
            printf("system call %d ret 0x%x %x\n", regs.orig_rax, regs.rax, regs.rsi);
            // if (ptrace(PTRACE_SINGLESTEP, pid, NULL, NULL) == -1)
            //     perror ("ptrace");
            // instr = ptrace(PTRACE_PEEKTEXT, pid, regs.rip, 0);
            // if (ptrace(PTRACE_GETREGS, pid, NULL, &regs))
            //     perror ("ptrace");
            ptrace(PTRACE_SYSCALL, pid, NULL, NULL);
            wait4(pid, &w8, WUNTRACED, NULL);
        }
    }
    printf("The child tracing is done\n");
}

int main(int ac, char **av, char **env)
{
    if (ac < 2) {
        dprintf(2, "Need a program in argument");
        return (84);
    }
    test_ptrace(av[1], av + 1, env);
}