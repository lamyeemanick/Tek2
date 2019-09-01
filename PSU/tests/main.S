[BITS 64]
global main
section .data
  my_str db "Leloz", 0
  len equ $ - my_str

section .text

main:
  mov rax, 1
  mov rdi, 1
  mov rsi, my_str
  mov rdx, len
  syscall
  mov rax, 60
  mov rdi, 15
  syscall