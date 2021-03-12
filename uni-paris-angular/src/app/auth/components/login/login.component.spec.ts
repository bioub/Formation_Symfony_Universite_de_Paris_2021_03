import { ComponentFixture, TestBed } from '@angular/core/testing';

import { LoginComponent } from './login.component';
import { AuthService } from '../../services/auth.service';
import { DebugElement } from '@angular/core';
import { By } from '@angular/platform-browser';
import { of } from 'rxjs';

fdescribe('LoginComponent', () => {
  let component: LoginComponent;
  let fixture: ComponentFixture<LoginComponent>;
  let debug: DebugElement;

  let authSpy: jasmine.SpyObj<AuthService>;

  beforeEach(async () => {
    const aSpy = jasmine.createSpyObj('AuthService', ['login']);
    await TestBed.configureTestingModule({
      declarations: [ LoginComponent ],
      providers: [
        { provide: AuthService, useValue: aSpy }
      ]
    })
    .compileComponents();
    authSpy = TestBed.inject(AuthService) as jasmine.SpyObj<AuthService>;
  });

  beforeEach(() => {
    fixture = TestBed.createComponent(LoginComponent);
    component = fixture.componentInstance;
    debug = fixture.debugElement;
    fixture.detectChanges();
  });

  it('should create', () => {
    expect(component).toBeTruthy();
  });

  it('should call login when button clicked', () => {
    authSpy.login = jasmine.createSpy().and.returnValue(of(null));

    const button = debug.query(By.css('button'));
    button.nativeElement.click();
    fixture.detectChanges();

    expect(authSpy.login).toHaveBeenCalledTimes(1);
  });
});
