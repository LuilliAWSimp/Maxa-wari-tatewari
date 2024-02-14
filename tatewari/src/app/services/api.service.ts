<<<<<<< Updated upstream
import { Injectable, Pipe } from '@angular/core';
import { HttpClientModule, HttpClient } from '@angular/common/http';
=======
import { Injectable } from '@angular/core';
import { HttpClient } from '@angular/common/http';
>>>>>>> Stashed changes
import { TopLevel } from '../interfaces';
import { Observable, pipe } from 'rxjs';
import { map } from 'rxjs/operators';

<<<<<<< Updated upstream
@Injectable({
  providedIn: 'root',
})
export class ApiService {
  public apiUrl = 'http://127.0.0.1:80/api1/method.php'; // Reemplaza con la URL de tu API
  constructor(private http: HttpClient) {}
  getTopHeadlines(): Observable<TopLevel> {
    return this.http
      .get<TopLevel>('http://127.0.0.1:80/api1/method.php')
      .pipe(map((resp) => resp));
  }
  // Método para enviar datos por POST
  postDatos(datos: any): Observable<any> {
    return this.http.post<any>(this.apiUrl, datos);
  }
  eliminarDato(id_user: number): Observable<{}> {
    return this.http.delete<any>(`${this.apiUrl}?id=${id_user}`);
  }
=======

@Injectable({
  providedIn: 'root'
})
export class ApiService {
  public apiUrl = 'http://127.0.0.1:80/api1/method.php'; // Reemplaza con la URL de tu API

  constructor(private http: HttpClient) {}

  // Método para obtener los datos
  getTopHeadlines(): Observable<TopLevel> {
    return this.http.get<TopLevel>('http://127.0.0.1:80/api1/method.php').pipe(
      map(resp => resp)
    );
  }

  // Método para enviar datos por POST
  postDatos(datos: any): Observable<any> {
    return this.http.post<any>(this.apiUrl, datos, { responseType: 'text' as 'json' });
  }

  eliminarDato(id: number): Observable<string> {
  return this.http.delete<string>(`${this.apiUrl}?id=${id}`, { responseType: 'text' as 'json' });
}

>>>>>>> Stashed changes
}
