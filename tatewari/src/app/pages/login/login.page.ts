import { Component, OnInit } from '@angular/core';
import { NavController } from '@ionic/angular';
import { Router } from '@angular/router';

import {
  Auth,
  signInWithEmailAndPassword,
  createUserWithEmailAndPassword,
  signOut
} from '@angular/fire/auth';

@Component({
  selector: 'app-login',
  templateUrl: './login.page.html',
  styleUrls: ['./login.page.scss'],
})
export class LoginPage implements OnInit {
  email: string = "";
  password: string = "";
  
  constructor(public navCntrl: NavController, private auth: Auth, private router: Router) {}

  async login() {
    try {
      const user = await signInWithEmailAndPassword(
        this.auth,
        this.email,
        this.password
      );
      console.log(user);
      this.router.navigate(['/tabs']);
    } catch (error) {
      console.error("Error de inicio de sesión:", error);
    }
  }

  gotoSignup() {
    this.navCntrl.navigateForward('signup');
  }

  ngOnInit() {
  }

}