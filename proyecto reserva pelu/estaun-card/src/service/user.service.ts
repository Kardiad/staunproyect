import { Usuario } from './../interfaces/usuario.interface';
import { Injectable } from '@angular/core';
import { HttpClient, HttpHeaders } from '@angular/common/http';
import { environment } from 'src/environments/environment';
import { Observable, catchError, map, of } from 'rxjs';
import { Respuesta } from 'src/interfaces/response.interface';

@Injectable({
  providedIn: 'root'
})
export class UserService{

  private url:string = environment.service;
  private incomingheaders! : HttpHeaders;

  constructor(private conn : HttpClient) {
      this.incomingheaders = new HttpHeaders();
      this.incomingheaders.set('Content-Type', 'multipart/form-data');
   }

  public get(endpoint:string):Observable<Usuario>{
    return this.conn.get<Usuario>(`${this.url}/${endpoint}`);
  }

  public post(endpoint:string, params:Usuario):Observable<Respuesta>{
    const formVal = this.usuarioForForm(params);
    return this.conn.post<Respuesta>(`${this.url}/${endpoint}`, 
    formVal, {
      headers: this.incomingheaders,
    });
  }

  public delete(endpoint:string):Observable<boolean>{
    return this.conn.delete<boolean>(`${this.url}/${endpoint}`)
      .pipe(
        catchError(err=>of(false)),
        map(res=>true)
      );
  }

  private usuarioForForm(usuario : Usuario):FormData{
    const formName = Object.keys(usuario);
    const formValue = Object.values(usuario);
    let form = new FormData();
    for(let i in formName){
      form.append(formName[i], formValue[i]);
    }
    return form;
  }
}
