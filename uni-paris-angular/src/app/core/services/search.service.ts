import { Injectable } from '@angular/core';
import { BehaviorSubject, Observable } from 'rxjs';

@Injectable({ providedIn: 'root' })
export class SearchService {
  private searchText$ = new BehaviorSubject<string>('');

  getSearchText(): Observable<string> {
    return this.searchText$.asObservable();
  }

  setSearchText(text: string): void {
    this.searchText$.next(text);
  }
}
