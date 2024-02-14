import { Injectable } from '@angular/core';
import { HttpClient } from '@angular/common/http';
import { TopLevel } from '../interfaces';
import { Observable } from 'rxjs';
import { map } from 'rxjs/operators';

@Injectable() // Agrega @Injectable() aquí
export class ApiService {
  public apiUrl = 'http://127.0.0.1:80/api1/method.php'; // Reemplaza con la URL de tu API
  constructor(private http: HttpClient) {}

  getTopHeadlines(): Observable<TopLevel[]> { // Cambia el tipo de retorno a un arreglo TopLevel[]
    return this.http
      .get<TopLevel[]>(this.apiUrl) // Utiliza this.apiUrl
      .pipe(map((resp) => resp));
  }

  postDatos(datos: any): Observable<any> {
    return this.http.post<any>(this.apiUrl, datos);
  }

  eliminarDato(id_user: number): Observable<{}> {
    return this.http.delete<any>(`${this.apiUrl}?id_user=${id_user}`); // Utiliza `${this.apiUrl}?id_user=${id_user}`
  }
}
