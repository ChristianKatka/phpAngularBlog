import { Component, OnInit } from '@angular/core';
import { AuthService } from '../auth.service';

@Component({
  selector: 'app-navbar',
  templateUrl: './navbar.component.html',
  styleUrls: ['./navbar.component.css']
})
export class NavbarComponent implements OnInit {

  // Used in HTML
  constructor(private _authService: AuthService) { }

  ngOnInit() {
  }

  public lol() {
    this._authService.loggedIn();
  }

}
