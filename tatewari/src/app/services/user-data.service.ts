import { Injectable } from '@angular/core';

@Injectable({
  providedIn: 'root'
})
export class UserDataService {
  constructor() { }

  setUserData(email: string, token: string) {
    sessionStorage.setItem('email', email);
    sessionStorage.setItem('token', token);
  }

  getCorreo(): string {
    return sessionStorage.getItem('email') || '';
  }

  getToken(): string {
    return sessionStorage.getItem('token') || '';
  }

  clearUserData() {
    sessionStorage.removeItem('email');
    sessionStorage.removeItem('token');
  }

  printUserData() {
    const email = this.getCorreo();
    const token = this.getToken();
    console.log('Correo del usuario:', email);
    console.log('Token del usuario:', token);
  }
}