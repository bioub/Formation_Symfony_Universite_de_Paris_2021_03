import { Component, OnInit } from '@angular/core';
import { FormBuilder, FormGroup, Validators } from '@angular/forms';
import { PostsService } from '../../services/posts.service';
import { ActivatedRoute, Router } from '@angular/router';
import { delay, map, shareReplay, switchMap, take, tap } from 'rxjs/operators';
import { Observable, of } from 'rxjs';
import { Post } from '../../models/post.model';

@Component({
  selector: 'app-new-post',
  templateUrl: './new-post.component.html',
  styleUrls: ['./new-post.component.scss']
})
export class NewPostComponent implements OnInit {

  newPostForm: FormGroup;
  loading: boolean;
  post$: Observable<Post>;
  pageTitle$: Observable<string>;

  constructor(private formBuilder: FormBuilder,
              private postsService: PostsService,
              private router: Router,
              private route: ActivatedRoute) {
  }

  ngOnInit(): void {
    this.loading = false;
    this.newPostForm = this.formBuilder.group({
      title: ['', [Validators.required, Validators.minLength(8)]],
      content: ['', Validators.required],
      fileUrl: [null]
    });
    this.post$ = this.route.params.pipe(
      take(1),
      switchMap(params => {
        if (params.id) {
          return this.postsService.getPostById(params.id);
        } else {
          return of(null);
        }
      }),
      tap(post => {
        if (post) {
          this.newPostForm.patchValue({
            title: post.title,
            content: post.content
          });
        }
      }),
      shareReplay(1)
    );

    this.post$.subscribe();

    this.pageTitle$ = this.post$.pipe(
      map(post => post ? 'Modifier' : 'Nouveau')
    );
  }

  getTitleError(): string {
    return this.newPostForm.get('title').hasError('minlength') ?
      'Le titre doit faire au moins 8 caractères.' : '';
  }

  handleFile(event: any): void {
    this.postsService.uploadFile(event.target.files[0]);
  }

  onSavePost(): void {
    this.loading = true;
    this.post$.pipe(
      switchMap(post => {
        if (post) {
          post.title = this.newPostForm.get('title').value;
          post.content = this.newPostForm.get('content').value;
          return this.postsService.modifyPost(post);
        } else {
          return this.postsService.createNewPost(this.newPostForm.value);
        }
      }),
      tap(() => {
        this.loading = false;
        this.router.navigateByUrl('/posts');
      })
    ).subscribe();
  }

}
