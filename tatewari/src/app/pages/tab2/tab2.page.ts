import { Component } from '@angular/core';
import { ApiService } from 'src/app/services/api.service';
import { TopLevel } from 'src/app/interfaces'; // Importar la clase TopLevel desde index.ts

@Component({
  selector: 'app-tab2',
  templateUrl: 'tab2.page.html',
<<<<<<< Updated upstream
  styleUrls: ['tab2.page.scss'],
})
export class Tab2Page {
  id_user?: number;
  name?: string;
  email?: string;
  password?: string;

  constructor(private apiService: ApiService) {}

  enviarDatos() {
    const datos: TopLevel = {
      // Utilizar la clase TopLevel para definir la estructura de datos
      id_user: this.id_user,
      name: this.name,
      email: this.email,
      password: this.password,
    };

    this.apiService.postDatos(datos).subscribe((resp) => {
      console.log(resp);
      // Aquí puedes manejar la respuesta del servidor como desees
    });
  }
=======
  styleUrls: ['tab2.page.scss']
})
export class Tab2Page {
  id?:     number;
  titulo?: string;
  cuerpo?: string;
  fecha?: Date;

constructor(private apiService: ApiService) {}

enviarDatos() {
  const datos: TopLevel = { // Utilizar la clase TopLevel para definir la estructura de datos
    id: this.id,
    titulo: this.titulo,
    cuerpo: this.cuerpo,
    fecha: this.fecha
  };

  this.apiService.postDatos(datos).subscribe(resp => {
    console.log(resp);
    // Aquí puedes manejar la respuesta del servidor como desees
  });
}
>>>>>>> Stashed changes
}
