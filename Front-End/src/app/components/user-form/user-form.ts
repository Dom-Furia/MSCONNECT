import { Component, inject} from '@angular/core';
import { ActivatedRoute, Router } from '@angular/router';
import { FormBuilder, ReactiveFormsModule, Validators } from '@angular/forms';
import { User, UserService } from '../../services/user.service';

@Component({
  selector: 'app-user-form',
  standalone: true,
  imports: [ReactiveFormsModule],
  templateUrl: './user-form.html',
  styleUrls: ['./user-form.css']
})
export class UserFormComponent {

  nametext: string = 'Novo Usuário';
  textbutton: string = 'Salvar';

  private fb = inject(FormBuilder);
  private route = inject(ActivatedRoute);
  private userService = inject(UserService);
  private router = inject(Router);

  userId?: number;

  form = this.fb.group({
    name: ['', Validators.required],
    email: ['', [Validators.required, Validators.email]],
    fone: ['']
  });

  ngOnInit() {
    this.userId = Number(this.route.snapshot.paramMap.get('id'));


    if (this.userId) {
      this.nametext = 'Editar Usuário';
      this.textbutton = 'Atualizar';
      this.userService.getUserById(this.userId).subscribe(user => {
        this.form.patchValue(user);
      });
    }
  }

  onSubmit() {

    //Verifica se o formulário é válido
    if (this.form.invalid) {
      this.form.markAllAsTouched();
      return;
    }

    const user = this.form.value as User;

    if (this.userId) {

      // Edição parcial: envia apenas campos alterados
      const camposAlterados: any = {};
      Object.keys(this.form.controls).forEach(campo => {
        const controle = this.form.get(campo);
        if (controle?.dirty) camposAlterados[campo] = controle.value;
      });

      if (Object.keys(camposAlterados).length === 0) {
        alert('Nenhuma alteração foi feita.');
        return;
      }

      this.userService.updateUser(this.userId,camposAlterados).subscribe({
        next: (res) => {
          alert(res.message);
          this.router.navigate(['/users']);
        },
        error: err => {
          alert('Erro ao atualizar usuário: ' + err.error?.error);

        }
      });

    } else {
      // Cria Novo usuário
      this.userService.createUser(user).subscribe({
        next: () => {
          alert('Usuário cadastrado com sucesso!');
          this.router.navigate(['/users']);
        },
        error: err => alert('Erro ao cadastrar usuário: ' + err.message)
      });
    }
  }
}
