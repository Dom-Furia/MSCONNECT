import { Component, inject, OnInit } from '@angular/core';
import { UserService, User } from '../../services/user.service';
import { Router } from '@angular/router';

@Component({
  selector: 'app-user-list',
  standalone: true,
  imports: [],
  templateUrl: './user-list.html',
  styleUrl: './user-list.css'
})
export class UserListComponent implements OnInit {
  users: User[] = [];
  listUser: any[] = [];

  private userService = inject(UserService);
  private router = inject(Router);

  ngOnInit() {
    this.carregarUsuarios();
  };

  carregarUsuarios() {
    this.userService.getUsers().subscribe({
      next: (res) => {
        this.listUser = res;

      },
      error: (err) => console.error('Erro ao carregar usuários:', err)
    });
  };

  editarUsuario(user: User) {
    this.router.navigate(['/users/edit', user.id]);
  };

   excluirUsuario(user: User) {
    if (confirm(`Tem certeza que deseja excluir o usuário ${user.name}?`)) {
      this.userService.deleteUser(user.id!).subscribe({
        next: () => {
          alert('Usuário excluído com sucesso.');
          this.carregarUsuarios(); // Atualiza a lista
        },
        error: (err) => {
          alert('Erro ao excluir usuário.');
        }
      });
    }
  }

}
