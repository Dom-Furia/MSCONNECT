import { Component, inject} from '@angular/core';
import { UserService } from '../../services/user.service';
import { Router } from '@angular/router';

@Component({
  selector: 'app-dashboard',
  imports: [],
  templateUrl: './dashboard.html',
  styleUrl: './dashboard.css'
})
export class DashboardComponent {

usuarios: any[] = []; // ou o tipo certo
quantidadeUsuarios = 0;

 private userService = inject(UserService);
 private router = inject(Router);

 ngOnInit(){
  this.userService.getUsers().subscribe(res => {
    this.quantidadeUsuarios = res.length;
  });
 }

 onClique(caminho: string){
  this.router.navigate([caminho]);
 }


}
