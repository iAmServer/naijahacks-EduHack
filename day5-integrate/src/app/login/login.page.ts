import { Component, OnInit } from '@angular/core';
import { Router } from '@angular/router';
import { HttpClient, HttpHeaders} from '@angular/common/http';
import { LoadingController, AlertController, MenuController } from '@ionic/angular';

@Component({
  selector: 'app-login',
  templateUrl: './login.page.html',
  styleUrls: ['./login.page.scss'],
})
export class LoginPage implements OnInit {

  constructor(private alertCtrl: AlertController, public loadingController: LoadingController, private http: HttpClient, private menuCtrl: MenuController, private router: Router) { }

  ngOnInit() {
    this.ionViewWillEnter();
  }

  ionViewWillEnter() {
    this.menuCtrl.enable(false);
  }

  async login(form) {
    var headers = new HttpHeaders({
      'Content-Type':  'application/json'
    })
    const requestOptions ={ 
      headers: headers 
    };

    let postData = {
      "email": form.value.email,
      "password": form.value.password
    }

    const loading = await this.loadingController.create({
      message: 'Please Wait',
      spinner: 'bubbles',
      // duration: 2000
    });
    await loading.present();

    this.http.post('http://invacxt.com/eduhack/api/login', postData, requestOptions).subscribe(async (response) => {
      await loading.dismiss();
      this.router.navigateByUrl('/home');
    },async error => {
      await loading.dismiss();
      const alert = await this.alertCtrl.create({
        header: 'Error',
        message: 'Incorrect Details, please try again!',
        buttons: ['OK']
      });
  
      await alert.present();
    });
    
  }
}
