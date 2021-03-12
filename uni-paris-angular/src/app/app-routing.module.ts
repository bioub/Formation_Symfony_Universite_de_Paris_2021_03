import { RouterModule, Routes } from '@angular/router';
import { NgModule } from '@angular/core';
import { FourOhFourComponent } from './core/components/four-oh-four/four-oh-four.component';
import { AuthGuard } from './auth/guards/auth.guard';

const routes: Routes = [
  { path: 'posts', canActivate: [AuthGuard], loadChildren: () => import('./posts/posts.module').then(m => m.PostsModule) },
  { path: 'auth', loadChildren: () => import('./auth/auth.module').then(m => m.AuthModule) },
  { path: '404', component: FourOhFourComponent },
  { path: '', pathMatch: 'full', redirectTo: 'posts' },
  { path: '**', redirectTo: '404' }
];
@NgModule({
  imports: [
    RouterModule.forRoot(routes)
  ],
  exports: [
    RouterModule
  ]
})
export class AppRoutingModule {}
