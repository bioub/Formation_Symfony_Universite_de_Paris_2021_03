import { Injectable } from '@angular/core';
import { Router } from '@angular/router';
import { Observable, BehaviorSubject, EMPTY } from 'rxjs';
import { HttpClient } from '@angular/common/http';
import { environment } from '../../../environments/environment';
import { catchError, map, switchMap, tap } from 'rxjs/operators';
import { UserService } from '../../core/services/user.service';
import { User } from '../../core/models/user.model';

@Injectable({ providedIn: 'root' })
export class AuthService {

  private isLoggedIn$ = new BehaviorSubject<boolean>(false);
  private token$ = new BehaviorSubject<string>('');

  constructor(private router: Router,
              private http: HttpClient,
              private userService: UserService) {}

  getAuthStatus(): Observable<boolean> {
    return this.isLoggedIn$.asObservable();
  }

  getToken(): Observable<string> {
    return this.token$.asObservable();
  }

  signUp(): Observable<User> {
    return this.http.get<{ token: string }>(`${environment.apiUrl}/auth`).pipe(
      tap(({ token }) => {
        this.isLoggedIn$.next(true);
        this.token$.next(token);
      }),
      switchMap(() => this.userService.getAllUsers()),
      map(users => users[0]),
      tap(user => {
        this.userService.setCurrentUser(user);
        this.router.navigateByUrl('/posts');
      }),
      catchError(error => {
        alert(error.message);
        return EMPTY;
      })
    );
  }

  login(): Observable<User> {
    return this.http.get<{ token: string }>(`${environment.apiUrl}/auth`).pipe(
      tap(({ token }) => {
        this.isLoggedIn$.next(true);
        this.token$.next(token);
      }),
      switchMap(() => this.userService.getAllUsers()),
      map(users => users[0]),
      tap(user => {
        this.userService.setCurrentUser(user);
        this.router.navigateByUrl('/posts');
      }),
      catchError(error => {
        alert(error.message);
        return EMPTY;
      })
    );
  }

  logout(): void {
    this.isLoggedIn$.next(false);
    this.token$.next('');
    this.router.navigateByUrl('/auth/login');
  }
}
