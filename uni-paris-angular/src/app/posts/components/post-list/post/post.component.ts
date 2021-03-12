import { Component, EventEmitter, Input, OnInit, Output } from '@angular/core';
import { Observable } from 'rxjs';

import { User } from '../../../../core/models/user.model';
import { UserService } from '../../../../core/services/user.service';
import { Post } from '../../../models/post.model';

@Component({
  selector: 'app-post',
  templateUrl: './post.component.html',
  styleUrls: ['./post.component.scss']
})
export class PostComponent implements OnInit {

  @Input() postObject: Post;
  @Input() counter: number;
  @Output() buttonClicked = new EventEmitter<string>();
  buttonText: string;
  // user$: Observable<User>;
  user: User;

  constructor(private userService: UserService) { }

  ngOnInit(): void {
    this.buttonText = 'Click me!';
    this.user = this.postObject.user;
    // this.user$ = this.userService.getUserByUserId(this.postObject.userId);
  }

  onClickButton(): void {
    this.buttonText = 'Clicked!';
    this.counter++;
    this.buttonClicked.emit(this.postObject.title);
  }

}
