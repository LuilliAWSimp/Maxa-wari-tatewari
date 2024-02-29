import { Component } from '@angular/core';
import { NavController } from '@ionic/angular'; // Importa NavController
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

  constructor(private navCtrl: NavController) {}

  register() {
    // Simplemente navega de vuelta a la tab1
    this.navCtrl.navigateBack('/tabs/tab1');
  }
}