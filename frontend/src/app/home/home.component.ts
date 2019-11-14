import { Component, OnInit } from '@angular/core';
import { BlogService } from '../blog.service';

import { NgxUiLoaderService } from 'ngx-ui-loader';
import { HttpClient } from '@angular/common/http';
import { AuthService } from '../auth.service';

@Component({
  selector: 'app-home',
  templateUrl: './home.component.html',
  styleUrls: ['./home.component.css']
})
export class HomeComponent implements OnInit {

  public detailItems = [
    {
      title: "Otsikko1",
      name: "teksti"
    },
    {
      title: "Otsikko2",
      name: "Teksti2"
    }
  ];



  public loggedIn = false;
  public blogs = [];

  // Are you sure you want to delete this blog post
  public confirmDelete = false;

  constructor(private _blogService: BlogService,
    private _authService: AuthService,
    private ngxLoader: NgxUiLoaderService,
    private _http: HttpClient) {


  }

  ngOnInit() {
    // Come to page loader
    this.ngxLoader.start();
    this._http.get(`https://api.npmjs.org/downloads/range/last-month/ngx-ui-loader`).subscribe((res: any) => {
      console.log(res);
      this.ngxLoader.stop();
    });

    this.getAllBlogPosts();
    if(this._authService.loggedIn()) {
      this.loggedIn = true;
    }
  }

  /** Retrieves all blog posts from database
   * 
   * Using blog service we get blog posts from data base to front end
   */
  public getAllBlogPosts(): void {
    this._blogService.getBlogPosts().subscribe(data => {
      console.log(data);
      this.blogs = data;
    })
  }

  /**Delete blog post from database
   * 
   * Deletes selected blog post from database through service
   * 
   * @param id blog id which was selected
   */
  public deleteBlogPost(id) {
    console.log(id);
    if (confirm("Are you sure to delete this blog post")) {
      this._blogService.deleteBlogPost(id).subscribe(
        (error: any) => console.log(error),
        () => console.log('Success!')
      )
      location.reload();
    }
    else {
      console.log('Cancel');
    }
  }



  /** Updates selected post content
   * 
   * Sends data to service as JSON what is used in the server side
   * 
   * @param _id what blog post is being updated 
   * @param _content user input text what will be changed
   */
  public editBlogPost(_id, _content) {

    const inputData = {
      Blogid: _id,
      content: _content
    }

    const JSONinputData = JSON.stringify(inputData);
    this._blogService.editBlogPost(JSONinputData).subscribe(
      (error: any) => console.log(error),
      () => console.log('Success!')
    );

    location.reload();

  }


}
