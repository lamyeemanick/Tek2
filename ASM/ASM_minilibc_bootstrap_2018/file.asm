;;section     .text
;;global      _start  ;must be declared for linker (ld)
;;
;;_start:             ;tell linker entry point
;;
;;    mov     rdx,len ;message length
;;    mov     rcx,msg ;message to write
;;    mov     rbx,1   ;file descriptor (stdout)
;;    mov     rax,4   ;system call number (sys_write)
;;    int     0x80    ;call kernel
;;
;;    mov     rax,1   ;system call number (sys_exit)
;;    int     0x80    ;call kernel
;;
;;section     .data
;;
;;msg     db  'Hello, world!',0xa ;our dear string
;;len     equ $ - msg             ;length of our dear string
;;

section .data
fmt     db "%u  %s",10,0
msg1    db "Hello",0
msg2    db "Goodbye",0

    section .text
    extern printf
    global _start

_start:
    mov  rdx, msg1
    mov  rsi, 1
    mov  rdi, fmt
    mov  rax, 0     ; no f.p. args
    call printf

    mov  rdx, msg2
    mov  rsi, 2
    mov  rdi, fmt
    mov  rax, 0     ; no f.p. args
    call printf

    mov  rax, 60
    mov  rdi, 0
    syscall