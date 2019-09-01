section .text
global my_strlen

my_strlen:
  mov rcx, 0
_beg:
  cmp byte [rdi+rcx], 0
  je _end
  inc rcx
  jmp _beg
_end:
  mov rax, rcx
  ret