import { Component } from '@angular/core';
import { ApiService } from 'src/app/services/api.service';
import { TopLevel } from 'src/app/interfaces'; // Importar la clase TopLevel desde index.ts

@Component({
  selector: 'app-tab2',
  templateUrl: 'tab2.page.html',
  styleUrls: ['tab2.page.scss']
})
export class Tab2Page {
    id_entrada?: number;
    id_usuario?: number;
    titulo?:     string;
    contenido?:  string;
    creado_en?:  Date;

  constructor(private apiService: ApiService) {}

  enviarDatos() {
    const datos: TopLevel = { // Utilizar la clase TopLevel para definir la estructura de datos
      id_usuario: this.id_usuario,
      titulo: this.titulo,
      contenido: this.contenido,
    };

    this.apiService.postDatos(datos).subscribe(resp => {
      console.log(resp);
      // Aquí puedes manejar la respuesta del servidor como desees
    });
  }
}

