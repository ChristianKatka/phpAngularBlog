import { Injectable } from '@angular/core';
import { HttpClient } from '@angular/common/http';
import { Observable } from 'rxjs';

import { backendConnection } from './backendConnection';
import { Blog } from './models/blog';

@Injectable({
  providedIn: 'root'
})
export class BlogService {

  // http://localhost/PHP-master/phpAngularBlog/backend/api/blog/read.php
  public url = backendConnection + 'blog/';

  constructor(private _http: HttpClient) { }

  /** Retrieve all blog posts from database
   * 
   * Including user who wrote it, heading and the content itself.
   */
  public getBlogPosts(): Observable<Blog[]> {
    return this._http.get<Blog[]>(this.url + 'read.php');
  }

  /** Writes new blog post to the database
   * 
   * Makes POST request to the backend with input form data.
   * 
   * @param inputData form data: username, heading and content
   */
  public writeBlogPost(inputData): Observable<any> {
    return this._http.post<Blog>(this.url + 'create.php', inputData);
  }


  /** Deletes selected blog post
   * 
   * @param id What blog post is being deleted 
   */
  public deleteBlogPost(id): Observable<any> {
    console.log('servicen id: ', id);
    return this._http.post<Blog>(this.url + 'delete.php?blogid=' + id, Headers);
  }

  /** Updates blog post
   * 
   * 
   * @param inputData JSON blogid and content
   */
  public editBlogPost(inputData): Observable<any> {
    console.log('services: ', inputData);
    return this._http.post<Blog>(this.url + 'update.php', inputData);
  }

}
