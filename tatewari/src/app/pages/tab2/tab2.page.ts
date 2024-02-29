import { Component } from '@angular/core';
import { NavController, AlertController } from '@ionic/angular'; // Importa NavController y AlertController
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

  constructor(private apiService: ApiService, private navCtrl: NavController, private alertController: AlertController) {} // Inyecta NavController y AlertController

  async enviarDatos() { // Utiliza async/await para manejar la alerta de manera asíncrona
    const datos: TopLevel = {
      name: this.name,
      email: this.email,
      password: this.password,
    };

    // Configura los encabezados para indicar que se está enviando JSON
    const headers = new HttpHeaders({
      'Content-Type': 'application/json',
    });
    // Llama al método postDatos() del servicio ApiService para enviar los datos al servidor
    try {
      const resp = await this.apiService.postDatos(datos).toPromise(); // Utiliza await para esperar la respuesta del servidor
      console.log(resp);
      // Muestra una alerta de éxito cuando el registro es exitoso
      await this.mostrarAlerta('Éxito', '¡Registro exitoso!');
    } catch (error) {
      console.error('Error al enviar los datos:', error);
      // Muestra una alerta de error si hay un problema con el registro
      await this.mostrarAlerta('Error', 'Hubo un problema al registrar los datos.');
    }
  }

  async mostrarAlerta(titulo: string, mensaje: string) {
    const alert = await this.alertController.create({
      header: titulo,
      message: mensaje,
      buttons: ['OK']
    });

    await alert.present();
  }
}
  