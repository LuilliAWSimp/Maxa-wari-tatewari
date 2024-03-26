import { Injectable } from '@angular/core';
import { HttpClient, HttpHeaders } from '@angular/common/http';
import { Observable } from 'rxjs';
import { TopLevel, User } from '../interfaces';

@Injectable({
  providedIn: 'root',
})
export class ApiService {
  public apiUrl = 'http://127.0.0.1:80/api1/rikki.php'; // Reemplaza con la URL de tu API
  public apiUrl_usuarios = 'http://127.0.0.1:80/api1/rikki.php'; //APi de usuarios
  constructor(private http: HttpClient) {}

  getTopHeadlines(): Observable<TopLevel> {
    return this.http.get<TopLevel>(this.apiUrl);
  }

  // Método para enviar datos por POST
  postDatos(datos: TopLevel): Observable<any> {
    return this.http.post<any>(this.apiUrl, datos, {
      responseType: 'text' as 'json',
    });
  }

  // Método para enviar datos de registro por POST
  postRegistro(datos: any): Observable<any> {
    return this.http.post<any>(`${this.apiUrl}/registro`, datos, {
      responseType: 'text' as 'json',
    });
  }

  eliminarDato(id_user: number): Observable<string> {
    return this.http.delete<string>(`${this.apiUrl}?id_user=${id_user}`, {
      responseType: 'text' as 'json',
    });
  }
//Usuarios
saveUserData(user: User): Observable<any> {
  const httpOptions = {
    headers: new HttpHeaders({ 'Content-Type': 'application/json' }),
    responseType: 'text' as 'json'
  };
  return this.http.post<any>(`${this.apiUrl_usuarios}`, user, {...httpOptions});
}

  
}
