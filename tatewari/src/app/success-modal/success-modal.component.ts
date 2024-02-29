import { Component, OnInit } from '@angular/core';

@Component({
  selector: 'app-success-modal',
  templateUrl: './success-modal.component.html',
  styleUrls: ['./success-modal.component.scss'],
})
export class SuccessModalComponent implements OnInit {
  successMessage: string = ''; // Propiedad para almacenar el mensaje de éxito

  constructor() { }

  ngOnInit() {}

  // Método para mostrar el modal de éxito con un mensaje específico
  showSuccessModal(message: string) {
    this.successMessage = message;
    // Aquí podrías agregar lógica adicional para mostrar el modal, si es necesario
  }

  // Método para cerrar el modal de éxito y limpiar el mensaje
  closeSuccessModal() {
    this.successMessage = 'rikki';
    // Aquí podrías agregar lógica adicional para cerrar el modal, si es necesario
  }
}
