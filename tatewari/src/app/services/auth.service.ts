import { Injectable } from '@angular/core';
import { HttpClient } from '@angular/common/http';
import { Observable } from 'rxjs';

@Injectable({
  providedIn: 'root'
})
export class AuthService {

  constructor(private http: HttpClient) { }

  login(credentials: { username: string, password: string }): Observable<any> {
    // Envía una solicitud HTTP al servidor para iniciar sesión
    return this.http.post<any>('http://127.0.0.1:80/login', credentials);
  }

  // Otros métodos relacionados con la autenticación pueden ir aquí, como verificar el estado de autenticación, cerrar sesión, etc.
}
