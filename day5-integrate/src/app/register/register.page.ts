import { Component, OnInit } from '@angular/core';
import { Router } from '@angular/router';
import { HttpClient, HttpHeaders} from '@angular/common/http';
import { LoadingController, AlertController, MenuController } from '@ionic/angular';

@Component({
  selector: 'app-register',
  templateUrl: './register.page.html',
  styleUrls: ['./register.page.scss'],
})
export class RegisterPage implements OnInit {

  constructor(private alertCtrl: AlertController, public loadingController: LoadingController, private http: HttpClient, private menuCtrl: MenuController, private router: Router) { }

  ngOnInit() {
    this.ionViewWillEnter();
  }

  ionViewWillEnter() {
    this.menuCtrl.enable(false);
  }

  async register(form) {
    var headers = new HttpHeaders({
      'Content-Type':  'application/json'
    });

    const requestOptions ={ 
      headers: headers 
    };

    let postData = {
      "name": form.value.name,
      "email": form.value.email,
      "password": form.value.password,
      "c_password": form.value.c_password
    }

    const loading = await this.loadingController.create({
      message: 'Please Wait',
      spinner: 'bubbles'
    });
    await loading.present();

    this.http.post('http://invacxt.com/eduhack/api/register', postData, requestOptions).subscribe(async (response) => {
      await loading.dismiss();
      const alert = await this.alertCtrl.create({
        header: 'Success',
        message: 'Registration, please login to continue',
        buttons: ['OK']
      });
  
      await alert.present();
      this.router.navigateByUrl('login');
    },async error => {
      await loading.dismiss();
      const alert = await this.alertCtrl.create({
        header: 'Error',
        message: 'Unable to register, please try again',
        buttons: ['OK']
      });
  
      await alert.present();
    });
  }

}
