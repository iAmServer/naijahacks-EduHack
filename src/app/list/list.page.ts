import { Component, OnInit } from '@angular/core';
import { HttpClient } from '@angular/common/http';

@Component({
  selector: 'app-list',
  templateUrl: 'list.page.html',
  styleUrls: ['list.page.scss']
})
export class ListPage implements OnInit {
  courses: {};
  results: any;
  toSearch: '';
  constructor(private http: HttpClient) {
    this.http.get('http://invacxt.com/eduhack/api/courses').subscribe((response) => {
      this.courses = response;
    });
  }

  ngOnInit() {
  }
}
