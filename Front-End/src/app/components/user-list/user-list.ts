import { Component, OnInit } from '@angular/core';
import { CommonModule } from '@angular/common';
import { UserService, User } from '../../services/user.service';
import { Router } from '@angular/router';

@Component({
  selector: 'app-user-list',
  standalone: true,
  imports: [CommonModule],
  templateUrl: './user-list.html',
  styleUrl: './user-list.css'
})
export class UserListComponent implements OnInit {
  users: User[] = [];

  constructor(private userService: UserService, private router: Router) {}

  ngOnInit() {
    this.carregarUsuarios();
  };

  carregarUsuarios() {
    this.userService.getUsers().subscribe({
      next: (res) => this.users = res,
      error: (err) => console.error('Erro ao carregar usuários:', err)
    });
  };

  editarUsuario(user: User) {
    this.router.navigate(['/users/edit', user.id]);
  };

   excluirUsuario(user: User) {
    console.log('Excluindo usuário:', user.id);
    if (confirm(`Tem certeza que deseja excluir o usuário ${user.name}?`)) {
      this.userService.deleteUser(user.id!).subscribe({
        next: () => {
          alert('Usuário excluído com sucesso.');
          this.carregarUsuarios(); // Atualiza a lista
        },
        error: (err) => {
          console.error('Erro ao excluir usuário:', err);
          alert('Erro ao excluir usuário.');
        }
      });
    }
  }

}
