import { Injectable } from '@angular/core';
import { Router } from '@angular/router';
import { HttpClient } from '@angular/common/http';
import { Observable } from 'rxjs';

import { backendConnection } from './backendConnection';

@Injectable({
  providedIn: 'root'
})
export class AuthService {

  // http://localhost/PHP-master/phpAngularBlog/backend/api/user/getuserid.php?username=asd
  // http://localhost/PHP-master/phpAngularBlog/backend/api/user/login.php
  // http://localhost/PHP-master/phpAngularBlog/backend/api/user/register.php

  public url = backendConnection + 'user/';

  // Fixes HTTP error thats expecting JSON.
  public requestOptions: Object = {
    /* other options here */
    responseType: 'text'
  }

  constructor(private _http: HttpClient, private _router: Router) { }


  getUserId(username): Observable<any> {
    return this._http.get<any>(this.url + 'getuserid.php?username=' + username , this.requestOptions);
  }

  /**Register user to the application
   * Credentials object will be converted to JSON
   * @param credentials username and password
   */
  registerUser(credentials): Observable<any> {
    let data = JSON.stringify(credentials);
    return this._http.post<any>(this.url + 'register.php', data, this.requestOptions)
  }

  /**Login to the application
   * Credentials object will be converted to JSON
   * sends JSON to the server
   * @param credentials username and password
   */
  loginUser(credentials) {
    let data = JSON.stringify(credentials);
    return this._http.post<any>(this.url + 'login.php', data, this.requestOptions);
  }

  /**Logout 
   * 
   * Delete token from local storage and reroute user.
   */
  logoutUser() {
    localStorage.removeItem('token');
    this._router.navigate(['/home']);
    // if on home page and logs out. edit button has to dissapear
    location.reload();
  }

  /**Checks if you are not logged in or registered
   * if localstorage contains token. Returns true
   */
  loggedIn() {
    // !! returns boolean value
    return !!localStorage.getItem('token');
  }

}
