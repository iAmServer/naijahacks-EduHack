import { Component, OnInit } from '@angular/core';
import { HttpClient } from '@angular/common/http';
import { LoadingController, AlertController } from '@ionic/angular';

@Component({
  selector: 'app-list',
  templateUrl: 'list.page.html',
  styleUrls: ['list.page.scss']
})
export class ListPage implements OnInit {
  courses: {};
  constructor(private http: HttpClient, public loadingController: LoadingController, private alertCtrl: AlertController) {
    this.da();
  }

  ngOnInit() {
  }

  async da () {
    const loading = await this.loadingController.create({
      message: 'Please Wait',
      spinner: 'bubbles'
    });
    await loading.present();
    this.http.get('http://invacxt.com/eduhack/api/courses').subscribe(async (response) => {
      this.courses = response;
      await loading.dismiss();      
    }, async error =>{
      await loading.dismiss();
      const alert = await this.alertCtrl.create({
        header: 'Error',
        message: 'Please check your internet connection and try again',
        buttons: ['OK']
      });
  
      await alert.present();
    });
  }

  open () {
    
  }
}
