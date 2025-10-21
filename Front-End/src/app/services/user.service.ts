import { Injectable } from '@angular/core';
import { HttpClient } from '@angular/common/http';
import { Observable } from 'rxjs';

export interface User {
  id?: number;
  name: string;
  email: string;
  fone: string;
  created_at?: string;
  updated_at?: string;
}

@Injectable({
  providedIn: 'root'
})

export class UserService {
  private apiUrl = 'http://localhost:8080'; // URL do backend PHP

  constructor(private http: HttpClient) {}

  getUsers(): Observable<User[]> {
    return this.http.get<User[]>(`${this.apiUrl}/users`);
  }

  createUser(user: User): Observable<any> {
    return this.http.post(`${this.apiUrl}/users`, user);
  }

  updateUser(user: User): Observable<any> {
    return this.http.put(`${this.apiUrl}/users/${user.id}`, user);
  }

  deleteUser(id: number): Observable<any> {
    return this.http.delete(`${this.apiUrl}/${id}`);
  }
}
