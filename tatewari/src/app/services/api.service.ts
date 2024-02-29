import { Injectable } from '@angular/core';
import { HttpClient } from '@angular/common/http';
import { Observable } from 'rxjs';
import { TopLevel } from '../interfaces';

@Injectable({
  providedIn: 'root',
})
export class ApiService {
  public apiUrl = 'http://127.0.0.1:80/api1/rikki.php'; // Reemplaza con la URL de tu API
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

  eliminarDato(id_user: number): Observable<string> {
    return this.http.delete<string>(`${this.apiUrl}?id_user=${id_user}`, {
      responseType: 'text' as 'json',
    });
  }
}
