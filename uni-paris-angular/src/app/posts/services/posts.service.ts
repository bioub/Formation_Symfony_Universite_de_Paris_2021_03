import { HttpClient } from '@angular/common/http';
import { Injectable } from '@angular/core';
import { EMPTY, Observable } from 'rxjs';
import { catchError, map, switchMap } from 'rxjs/operators';
import * as uuid from 'uuid';

import { environment } from '../../../environments/environment';
import { UserService } from '../../core/services/user.service';
import { Post, PostDto } from '../models/post.model';

@Injectable()
export class PostsService {

  constructor(private http: HttpClient,
              private userService: UserService) {
  }

  getAllPosts(searchText?: string): Observable<Post[]> {
    const url = searchText ?
      `${environment.postsApiUrl}?q=${searchText}` :
      `${environment.postsApiUrl}`;
    return this.http.get<Post[]>(url);
  }

  getPostById(id: string): Observable<Post> {
    return this.http.get<Post>(`${environment.postsApiUrl}/${id}`);
  }

  uploadFile(file: File): void {
    const formData = new FormData();
    formData.append('file', file);
    this.http.post(`${environment.postsApiUrl}/endpoint-qui-marche`, formData);
  }

  createNewPost(formValue: PostDto): Observable<Post> {
    return this.userService.getCurrentUser().pipe(
      map(user => {
        const post = new Post();
        // post.id = uuid.v4();
        post.title = formValue.title;
        post.content = formValue.content;
        post.comments = [];
        post.user = user;
        return post;
      }),
      switchMap(post => this.http.post<Post>(`${environment.postsApiUrl}`, post)),
      catchError(error => {
        alert(error);
        return EMPTY;
      })
    );
  }

  modifyPost(post: Post): Observable<{}> {
    return this.http.put(`${environment.postsApiUrl}/${post.id}`, post);
  }

  deletePost(id: string): Observable<{}> {
    return this.http.delete(`${environment.postsApiUrl}/${id}`);
  }

  // getPostByIndex(index: number): Post {
  //   return this.posts[index] || null;
  // }

  // deletePost(index: number): void {
  //   this.posts.splice(index, 1);
  // }
}
