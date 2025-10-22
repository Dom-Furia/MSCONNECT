import { Routes } from '@angular/router';
import { DashboardComponent } from './components/dashboard/dashboard';
import { UserListComponent } from './components/user-list/user-list';
import { UserFormComponent } from './components/user-form/user-form';
import { NotFoundComponent } from './components/not-found/not-found';

export const routes: Routes = [
  {
    path: 'Dashboard',
    component: DashboardComponent
  },

  {
    path: '',
    redirectTo: 'Dashboard',
    pathMatch: 'full'
  },

  {
    path: 'users',
    component: UserListComponent
  },

  {
    path: 'users/cadastro',
    component: UserFormComponent
  },

  {
    path: 'users/edit/:id',
    component: UserFormComponent
  },

  { path: 'not-found',
    component: NotFoundComponent },

  { path: '**',
    redirectTo: 'not-found'
  }
];
