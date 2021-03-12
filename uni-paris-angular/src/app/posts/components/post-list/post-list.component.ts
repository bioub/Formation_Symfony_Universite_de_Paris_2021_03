import { Component, OnDestroy, OnInit } from '@angular/core';
import { Post } from '../../models/post.model';
import { PostsService } from '../../services/posts.service';
import { Observable, Subject } from 'rxjs';
import { map, shareReplay, switchMap } from 'rxjs/operators';
import { SearchService } from '../../../core/services/search.service';

@Component({
  selector: 'app-post-list',
  templateUrl: './post-list.component.html',
  styleUrls: ['./post-list.component.scss']
})
export class PostListComponent implements OnInit, OnDestroy {

  posts$: Observable<Post[]>;
  totalPosts$: Observable<number>;

  destroy$: Subject<boolean>;

  constructor(private postsService: PostsService,
              private searchService: SearchService) { }

  ngOnInit(): void {
    this.destroy$ = new Subject<boolean>();
    this.posts$ = this.searchService.getSearchText().pipe(
      // startWith(''),
      switchMap(searchText => this.postsService.getAllPosts(searchText)),
      shareReplay(1)
    );
    this.totalPosts$ = this.posts$.pipe(
      map(posts => posts.length)
    );
  }

  onPostButtonClicked(title: string): void {
    alert(title);
  }

  // onDeleteFirstPost(): void {
  //   this.postsService.deletePost(0);
  //   this.posts = this.postsService.getAllPosts();
  // }

  ngOnDestroy(): void {
    this.destroy$.next(true);
  }
}
