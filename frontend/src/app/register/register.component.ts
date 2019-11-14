import { Component, OnInit } from '@angular/core';
import { AuthService } from '../auth.service';
import { Router } from '@angular/router';

@Component({
  selector: 'app-register',
  templateUrl: './register.component.html',
  styleUrls: ['./register.component.css']
})
export class RegisterComponent implements OnInit {

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

  registerUser() {

    this._authService.registerUser(this.credentials)
      .subscribe(
        // response from the server side
        res => {
          // Save username so we can use it to make blog post
          localStorage.setItem('username', this.credentials.user_name);

          let pData = JSON.parse(res);
          console.log(pData.jwt)
          localStorage.setItem('token', pData.jwt);
          // after succesful register user will be guided to the create post page
          this._router.navigate(['/write']);
        },
        err => console.log(err)
      );
    }

}
