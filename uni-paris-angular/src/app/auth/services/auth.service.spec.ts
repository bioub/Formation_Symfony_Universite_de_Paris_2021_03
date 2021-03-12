import { TestBed } from '@angular/core/testing';
import { AuthService } from './auth.service';
import { Router } from '@angular/router';
import { HttpClient } from '@angular/common/http';
import { UserService } from '../../core/services/user.service';
import { skip } from 'rxjs/operators';
import { of } from 'rxjs';
import { HttpClientTestingModule, HttpTestingController } from '@angular/common/http/testing';
import { User } from '../../core/models/user.model';

fdescribe('AuthService', () => {

  let authService: AuthService;
  let routerSpy: jasmine.SpyObj<Router>;
  let userSpy: jasmine.SpyObj<UserService>;

  let httpClient: HttpClient;
  let httpTestCtrl: HttpTestingController;

  beforeEach(() => {
    const rSpy = jasmine.createSpyObj('Router', ['navigateByUrl']);
    const uSpy = jasmine.createSpyObj('UserService', ['getAllUsers', 'setCurrentUser']);
    TestBed.configureTestingModule({
      imports: [
        HttpClientTestingModule
      ],
      providers: [
        AuthService,
        { provide: Router, useValue: rSpy },
        { provide: UserService, useValue: uSpy }
      ]
    });
    httpClient = TestBed.inject(HttpClient);
    httpTestCtrl = TestBed.inject(HttpTestingController);
    authService = TestBed.inject(AuthService);
    routerSpy = TestBed.inject(Router) as jasmine.SpyObj<Router>;
    userSpy = TestBed.inject(UserService) as jasmine.SpyObj<UserService>;
  });

  it('should navigate to login after logout', () => {
    authService.logout();
    expect(routerSpy.navigateByUrl).toHaveBeenCalledTimes(1);
    expect(routerSpy.navigateByUrl).toHaveBeenCalledWith('/auth/login');
  });

  it('should emit false on logout', () => {
    authService.getAuthStatus().pipe(skip(1)).subscribe(isLoggedIn => {
      expect(isLoggedIn).toBe(false);
    });
    authService.logout();
  });

  it('should emit empty token on logout', () => {
    authService.getToken().pipe(skip(1)).subscribe(token => {
      expect(token).toBe('');
    });
    authService.logout();
  });

  it('should emit token on successful login', () => {
    const testToken = 'TEST_TOKEN';
    userSpy.getAllUsers = jasmine.createSpy().and.returnValue(of([]));
    authService.getToken().pipe(skip(1)).subscribe(token => {
      expect(token).toBe(testToken);
    });
    authService.login().subscribe();

    const req = httpTestCtrl.expectOne('http://localhost:3000/auth');
    req.flush({ token: testToken });
  });

  it('should emit true on successful login', () => {
    const testToken = 'TEST_TOKEN';
    userSpy.getAllUsers = jasmine.createSpy().and.returnValue(of([]));
    authService.getAuthStatus().pipe(skip(1)).subscribe(status => {
      expect(status).toBe(true);
    });
    authService.login().subscribe();

    const req = httpTestCtrl.expectOne('http://localhost:3000/auth');
    req.flush({ token: testToken });
  });

  it('should make GET request to auth API on login', () => {
    authService.login().subscribe();
    const req = httpTestCtrl.expectOne('http://localhost:3000/auth');
    expect(req.request.method).toBe('GET');
  });

  it('should set correct current user on successful login', () => {
    const testToken = 'TEST_TOKEN';
    const testUser = new User();
    testUser.firstName = 'Toto';
    testUser.lastName = 'Kafka';
    userSpy.getAllUsers = jasmine.createSpy().and.returnValue(of([testUser]));
    authService.login().subscribe();
    const req = httpTestCtrl.expectOne('http://localhost:3000/auth');
    req.flush({ token: testToken });
    expect(userSpy.setCurrentUser).toHaveBeenCalledTimes(1);
    expect(userSpy.setCurrentUser).toHaveBeenCalledWith(testUser);
  });

  afterEach(() => {
    httpTestCtrl.verify();
  });
});
