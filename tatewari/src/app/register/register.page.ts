import { Component } from '@angular/core';
import { ApiService } from 'src/app/services/api.service';

@Component({
  selector: 'app-register',
  templateUrl: 'register.page.html',
  styleUrls: ['register.page.scss'],
})
export class RegisterPage {
  name: string = '';
  email: string = '';
  password: string = '';

  constructor(private apiService: ApiService) {}

  register() {
    // Validar que se hayan ingresado datos
    if (!this.name || !this.email || !this.password) {
      console.error('Por favor, complete todos los campos.');
      return;
    }

    // Crear objeto con los datos del usuario
    const userData = {
      name: this.name,
      email: this.email,
      password: this.password
    };

    // Llamar al servicio de la API para enviar los datos de registro
    this.apiService.postRegistro(userData).subscribe(
      (response) => {
        console.log('Registro exitoso:', response);
        // Aquí puedes manejar la respuesta del servidor como desees
      },
      (error) => {
        console.error('Error en el registro:', error);
        // Aquí puedes manejar los errores de registro
      }
    );
  }
}
