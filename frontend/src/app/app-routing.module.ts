import { NgModule } from '@angular/core';
import { Routes, RouterModule } from '@angular/router';
import { HomeComponent } from './home/home.component';
import { WriteComponent } from './write/write.component';
import { RegisterComponent } from './register/register.component';
import { LoginComponent } from './login/login.component';

import { AuthGuard } from './auth.guard';

const routes: Routes = [
  { path: 'home', component: HomeComponent },
  { path: 'write', component: WriteComponent, canActivate: [AuthGuard] },
  { path: 'login', component: LoginComponent },
  { path: 'register', component: RegisterComponent },
  { path: '', redirectTo: 'home', pathMatch: 'full' }
];

@NgModule({
  imports: [RouterModule.forRoot(routes)],
  exports: [RouterModule]
})
export class AppRoutingModule { }
