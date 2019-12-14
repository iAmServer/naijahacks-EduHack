import { Component, OnInit, ViewChild } from '@angular/core';
import {IonSlides } from '@ionic/angular';
import { Router, ActivatedRoute } from '@angular/router';
import { HttpClient } from '@angular/common/http';

@Component({
  selector: 'app-details',
  templateUrl: './details.page.html',
  styleUrls: ['./details.page.scss'],
})
export class DetailsPage implements OnInit {
  isSave: boolean;
  data: string;
  courses: any;
  @ViewChild('slides', { static: true }) slider: IonSlides;
  segment = 0;

  constructor(private http: HttpClient, private route: ActivatedRoute, private router: Router) {
    this.data = this.route.snapshot.paramMap.get('id');
    this.http.get('http://invacxt.com/eduhack/api/course/' + this.data).subscribe((response) => {
      this.courses = response;
      console.log(this.courses);
    });
  }

  ngOnInit() {
  }

  async segmentChanged(ev: any) {
    await this.slider.slideTo(this.segment);
  }

  async slideChanged() {
    this.segment = await this.slider.getActiveIndex();
  }

  save() {
    this.isSave = !this.isSave;
    console.log(this.isSave);
  }
}
