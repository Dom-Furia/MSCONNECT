import { Component } from '@angular/core';
import { User, UserService } from '../../services/user.service';
import { CommonModule } from '@angular/common';
import { FormsModule } from '@angular/forms';

@Component({
  selector: 'app-user-form',
  imports: [CommonModule, FormsModule],
  templateUrl: './user-form.html',
  styleUrl: './user-form.css'
})
export class UserFormComponent {

   user: User = { name: '', email: '', fone: '' };


  constructor(private userService: UserService) {}


  onSubmit() {
    this.userService.createUser(this.user).subscribe({
      next: (res) => {
        console.log('Resposta PHP', res);
        alert('Usuário cadastrado com sucesso!');

      },
      error: (err) => alert('Erro ao cadastrar usuário: ' + err.error?.error)

    });
  }

}

