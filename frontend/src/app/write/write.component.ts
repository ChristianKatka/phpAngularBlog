import { Component, OnInit } from '@angular/core';
import { Router } from '@angular/router';
import { HttpClient } from '@angular/common/http';

import { BlogService } from '../blog.service';

import { NgxUiLoaderService } from 'ngx-ui-loader';
import { AuthService } from '../auth.service';

@Component({
  selector: 'app-write',
  templateUrl: './write.component.html',
  styleUrls: ['./write.component.css']
})
export class WriteComponent implements OnInit {

  // all input fields required, error
  error = false;

  loggedinUser = '';

  data: {
    userid: number,
    heading: '',
    content: ''
  };

  constructor(private _blogService: BlogService,
    private _authService: AuthService,
    private ngxLoader: NgxUiLoaderService,
    private _http: HttpClient,
    private _router: Router) {
    // Angular error cant read undefined. So this is why thats here
    this.data = {
      userid: 0,
      heading: '',
      content: ''
    };
  }

  ngOnInit() {
    // get logged in username from local storage
    this.loggedinUser = localStorage.getItem('username');
    // console.log(this.data.username);

    // Come to page loader
    this.ngxLoader.start();
    this._http.get(`https://api.npmjs.org/downloads/range/last-month/ngx-ui-loader`).subscribe((res: any) => {
      console.log(res);
      this.ngxLoader.stop();
    });
  }

  /** Send user input data to backend
   * Blog post data inserted to the form is handled here and sent to the backend through service. 
   * 
   * First we need user id of the logged in user because server side write function needs it
   * 
   *  
   */
  onSubmit() {
    this._authService.getUserId(this.loggedinUser).subscribe(
      res => {
        let id = parseInt(JSON.parse(res));
        this.data.userid = id;

        // If user has inputted valid values. (only white space is not valid value)
        if (this.data.heading.trim() && this.data.content.trim()) {
          this.error = false;
          this._blogService.writeBlogPost(this.data).subscribe(
            (error: any) => console.log(error),
            () => console.log('Success!')
          )
          this._router.navigate(['/home']);
        }
        else {
          console.log('Error: all fields are required');
          this.error = true;
        }
      },
      err => console.log(err)
    );



  }

}
