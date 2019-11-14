import { Component, OnInit } from '@angular/core';
import { AuthService } from '../auth.service';
import { Router } from '@angular/router';

@Component({
  selector: 'app-login',
  templateUrl: './login.component.html',
  styleUrls: ['./login.component.css']
})
export class LoginComponent implements OnInit {

  credentials: {
    user_name: '',
    password: ''
  };

  constructor(private _authService: AuthService, private _router: Router) {
    // Angular error cant read undefined. So this is why thats here
    this.credentials = {
      user_name: '',
      password: ''
    };
  }

  ngOnInit() {
  }


  loginUser() {


    this._authService.loginUser(this.credentials)
      .subscribe(
        // response from the server side
        res => {
          // Save username so we can use it to make blog post
          localStorage.setItem('username', this.credentials.user_name);

          let pData = JSON.parse(res);
          localStorage.setItem('token', pData.jwt);
          this._router.navigate(['/write']);
        },
        err => console.log(err)
      );
  }


}
