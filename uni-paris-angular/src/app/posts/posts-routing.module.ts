import { RouterModule, Routes } from '@angular/router';
import {
  SinglePostComponent,
  PostListComponent,
  NewPostComponent
} from './components';
import { NgModule } from '@angular/core';

const routes: Routes = [
  { path: 'new', component: NewPostComponent },
  { path: 'modify/:id', component: NewPostComponent },
  { path: ':id', component: SinglePostComponent },
  { path: '', pathMatch: 'full', component: PostListComponent }
];
@NgModule({
  imports: [
    RouterModule.forChild(routes)
  ],
  exports: [
    RouterModule
  ]
})
export class PostsRoutingModule {}
