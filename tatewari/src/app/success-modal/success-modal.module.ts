import { NgModule } from '@angular/core';
import { CommonModule } from '@angular/common';
import { IonicModule } from '@ionic/angular'; // Importa IonicModule
import { SuccessModalComponent } from './success-modal.component'; // Importa el componente SuccessModelComponent

@NgModule({
  declarations: [SuccessModalComponent],
  imports: [
    CommonModule,
    IonicModule // Asegúrate de importar IonicModule aquí
  ],
  exports: [SuccessModalComponent]
})
export class SuccessModelModule { }
