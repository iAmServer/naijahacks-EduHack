import { Component, OnInit, ViewChild } from '@angular/core';
import {IonSlides } from '@ionic/angular';

@Component({
  selector: 'app-details',
  templateUrl: './details.page.html',
  styleUrls: ['./details.page.scss'],
})
export class DetailsPage implements OnInit {
  isSave: boolean;
  @ViewChild('slides', { static: true }) slider: IonSlides;
  segment = 0;

  constructor() { }

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
