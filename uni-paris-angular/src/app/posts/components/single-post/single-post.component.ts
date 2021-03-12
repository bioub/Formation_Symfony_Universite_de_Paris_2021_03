import { Component, OnInit } from '@angular/core';
import { ActivatedRoute, Router } from '@angular/router';
import { Observable, combineLatest } from 'rxjs';
import { map, shareReplay, switchMap, tap } from 'rxjs/operators';

import { User } from '../../../core/models/user.model';
import { UserService } from '../../../core/services/user.service';
import { Post } from '../../models/post.model';
import { PostsService } from '../../services/posts.service';

@Component({
  selector: 'app-single-post',
  templateUrl: './single-post.component.html',
  styleUrls: ['./single-post.component.scss']
})
export class SinglePostComponent implements OnInit {

  post$: Observable<Post>;
  user$: Observable<User>;
  currentUser$: Observable<User>;
  postIsMine$: Observable<boolean>;

  constructor(private postsService: PostsService,
              private route: ActivatedRoute,
              private router: Router,
              private userService: UserService) { }

  ngOnInit(): void {
    const id = this.route.snapshot.params.id;
    this.post$ = this.postsService.getPostById(id).pipe(
      shareReplay(1)
    );
    this.user$ = this.post$.pipe(
      switchMap(post => this.userService.getUserByUserId(post.user.id)),
    );
    this.currentUser$ = this.userService.getCurrentUser();
    this.postIsMine$ = combineLatest([this.post$, this.currentUser$]).pipe(
      map(([post, currentUser]) => post.user.id === currentUser.id)
    );
  }

  onClickBack(): void {
    this.router.navigateByUrl('/posts');
  }

  onModifyPost(id: string): void {
    this.router.navigateByUrl(`/posts/modify/${id}`);
  }

  onDeletePost(id: string): void {
    this.postsService.deletePost(id).pipe(
      tap(() => this.router.navigateByUrl('/posts'))
    ).subscribe();
  }

}
