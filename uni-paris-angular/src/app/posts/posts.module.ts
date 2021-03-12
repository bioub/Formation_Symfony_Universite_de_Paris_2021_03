import { NgModule } from '@angular/core';
import {
  PostListComponent,
  PostComponent,
  SinglePostComponent,
  TitleListComponent,
  NewPostComponent
} from './components';
import { SharedModule } from '../shared/shared.module';
import { PostsRoutingModule } from './posts-routing.module';
import { PostsService } from './services/posts.service';
import { ReactiveFormsModule } from '@angular/forms';

@NgModule({
  declarations: [
    PostListComponent,
    PostComponent,
    SinglePostComponent,
    TitleListComponent,
    NewPostComponent
  ],
  imports: [
    SharedModule,
    PostsRoutingModule,
    ReactiveFormsModule
  ],
  exports: [
    PostListComponent,
    PostComponent,
    SinglePostComponent,
    TitleListComponent
  ],
  providers: [
    PostsService
  ]
})
export class PostsModule {}

