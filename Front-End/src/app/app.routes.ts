import { Routes } from '@angular/router';
import { DashboardComponent } from './components/dashboard/dashboard';
import { UserListComponent } from './components/user-list/user-list';
import { UserFormComponent } from './components/user-form/user-form';

export const routes: Routes = [
  {
    path: '',
    component: DashboardComponent
  },
  {
    path: 'users',
    component: UserListComponent
  },
  {
    path: 'users/new',
    component: UserFormComponent
  }
];
