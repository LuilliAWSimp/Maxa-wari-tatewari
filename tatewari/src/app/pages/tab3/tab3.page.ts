import { Component } from '@angular/core';
import { AuthService } from '../../services/auth.service';
import { Router } from '@angular/router';

@Component({
  selector: 'app-tab3',
  templateUrl: 'tab3.page.html',
  styleUrls: ['tab3.page.scss'],
})
export class Tab3Page {
  username: string = '';
  password: string = '';
  

  constructor(private authService: AuthService, private router: Router) {}

  login() {
    this.authService.login({ username: this.username, password: this.password })
      .subscribe(
        () => {
          // Redirige a la página principal después de iniciar sesión exitosamente
          this.router.navigate(['/home']); // Ajusta la ruta según sea necesario
        },
        (error: any) => {
          // Maneja errores de inicio de sesión
          console.error(error);
        }
      );
  }
}
