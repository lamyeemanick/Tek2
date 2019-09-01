section .data
  my_str db "Grosse bite", 0

section .text
  extern my_strlen
  global _start

_start:
  mov rdi, my_str
  call my_strlen
_debug:
  mov rax, 60
  mov rdi, 0
  syscall