import { Component, Input, OnInit } from '@angular/core';
import { Post } from '../../../models/post.model';

@Component({
  selector: 'app-title-list',
  templateUrl: './title-list.component.html',
  styleUrls: ['./title-list.component.scss']
})
export class TitleListComponent implements OnInit {

  @Input() posts: Post[];

  constructor() { }

  ngOnInit(): void {
  }

  getTitleStyle(i: number): { color: 'green' | 'black' } {
    return { color: i % 2 === 0 ? 'green' : 'black' };
  }

}
