import { Component, OnInit } from '@angular/core';
import { HttpClient, HttpHeaders} from '@angular/common/http';
import { LoadingController, AlertController } from '@ionic/angular';

@Component({
  selector: 'app-search',
  templateUrl: './search.page.html',
  styleUrls: ['./search.page.scss'],
})
export class SearchPage implements OnInit {
  courses: {};
  search: string = "";
  constructor(private http: HttpClient, public loadingController: LoadingController, private alertCtrl: AlertController) {
    // this.loadData();
  }

  ngOnInit() {
  }

  async loadData () {
    var headers = new HttpHeaders({
      'Content-Type':  'application/json'
    });

    const requestOptions ={ 
      headers: headers 
    };

    const postData = {
      "search": this.search
    };

    const loading = await this.loadingController.create({
      message: 'Please Wait',
      spinner: 'bubbles'
    });
    await loading.present();

    this.http.post('http://invacxt.com/eduhack/api/search', postData, requestOptions).subscribe(async (response) => {
      await loading.dismiss();
      this.courses = response;
      console.log(this.courses);
    },async error => {
      await loading.dismiss();
      const alert = await this.alertCtrl.create({
        header: 'Pesponse',
        message: 'Search not found',
        buttons: ['OK']
      });
  
      await alert.present();
    });
  }
}
