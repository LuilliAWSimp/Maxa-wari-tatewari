import { Component } from '@angular/core';
import { NavController } from '@ionic/angular'; // Importa NavController
import { ApiService } from 'src/app/services/api.service';
import { HttpHeaders } from '@angular/common/http';
import { TopLevel } from 'src/app/interfaces';

@Component({
  selector: 'app-tab2',
  templateUrl: 'tab2.page.html',
  styleUrls: ['tab2.page.scss'],
})
export class Tab2Page {
  name?: string;
  email?: string;
  password?: string;

  constructor(private apiService: ApiService, private navCtrl: NavController) {}

  enviarDatos() {
    const datos: TopLevel = {
      name: this.name,
      email: this.email,
      password: this.password,
    };

    const headers = new HttpHeaders({
      'Content-Type': 'application/json',
    });

    this.apiService.postDatos(datos).subscribe(
      (resp) => {
        console.log(resp);
        // Navega a la página que muestra el componente SuccessModalComponent después de un registro exitoso
        this.navCtrl.navigateForward('/success-modal');
      },
      (error) => {
        console.error('Error al enviar los datos:', error);
      }
    );
  }
}
