import { Component, OnDestroy, OnInit } from '@angular/core';
import { AuthService } from './auth/services/auth.service';
import { Observable, Subject } from 'rxjs';
import { debounceTime, distinctUntilChanged, takeUntil, tap } from 'rxjs/operators';
import { Router } from '@angular/router';
import { FormBuilder, FormGroup } from '@angular/forms';
import { SearchService } from './core/services/search.service';

@Component({
  selector: 'app-root',
  templateUrl: './app.component.html',
  styleUrls: ['./app.component.scss']
})
export class AppComponent implements OnInit, OnDestroy {

  isLoggedIn$: Observable<boolean>;

  destroy$: Subject<boolean>;

  searchForm: FormGroup;

  constructor(private authService: AuthService,
              private router: Router,
              private formBuilder: FormBuilder,
              private searchService: SearchService) {
  }

  ngOnInit(): void {
    this.destroy$ = new Subject<boolean>();
    this.isLoggedIn$ = this.authService.getAuthStatus().pipe(
      takeUntil(this.destroy$),
      tap(value => console.log(value)),
      // map(value => value ? 'Authentifié !' : 'Non authentifié !'),
      // tap(value => console.log(value))
    );

    this.searchForm = this.formBuilder.group({
      search: ['']
    });

    this.searchForm.get('search').valueChanges.pipe(
      takeUntil(this.destroy$),
      debounceTime(300),
      distinctUntilChanged(),
      tap(searchText => this.searchService.setSearchText(searchText)),
    ).subscribe();

    // this.isLoggedIn$.subscribe();
  }

  onLogout(): void {
    this.authService.logout();
  }

  onNewPost(): void {
    this.router.navigateByUrl('/posts/new');
  }

  ngOnDestroy(): void {
    this.destroy$.next(true);
  }

}
