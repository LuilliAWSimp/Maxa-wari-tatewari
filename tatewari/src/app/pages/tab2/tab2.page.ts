import { Component } from '@angular/core';
import { ApiService } from 'src/app/services/api.service';
import { TopLevel } from 'src/app/interfaces'; // Importa la clase TopLevel desde index.ts

@Component({
  selector: 'app-tab2',
  templateUrl: 'tab2.page.html',
  styleUrls: ['tab2.page.scss'],
})
export class Tab2Page {
  id_user?: number;
  name?: string;
  email?: string;
  password?: string;

  constructor(private apiService: ApiService) {}

  enviarDatos() {
    // Crea un objeto con los datos a enviar al servidor
      const datos: TopLevel = {
      name: this.name,
      email: this.email,
      password: this.password
    };

    // Llama al método postDatos() del servicio ApiService para enviar los datos al servidor
    this.apiService.postDatos(datos).subscribe((resp) => {
      console.log(resp);
      // Aquí puedes manejar la respuesta del servidor como desees
    });
  }
}
