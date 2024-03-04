import { Component, ElementRef, Input, ViewChild, ViewChildren } from '@angular/core';
import type { OnInit, QueryList } from '@angular/core';
import { Router } from '@angular/router';
import type { Animation } from '@ionic/angular';
import { AnimationController, IonCard, IonCardContent, IonImg } from '@ionic/angular';
import { UserService } from 'src/service/user.service';


@Component({
  selector: 'app-tab2',
  templateUrl: 'tab2.page.html',
  styleUrls: ['tab2.page.scss']
})
export class Tab2Page {
  @ViewChild(IonImg, { read: ElementRef }) img: ElementRef<HTMLIonImgElement> | undefined;
  @ViewChild(IonCardContent, {read: ElementRef}) form : ElementRef<HTMLIonCardContentElement> | undefined;
  @Input('email') email: string = '';
  @Input('pass') pass: string = '';
  private animationCard : Animation = null!;
  private animationForm : Animation = null!;
  private height : number;
  private width : number;
  
  constructor(
    private animationControler : AnimationController,
    private usuario : UserService,
    private router : Router
    ) {
    this.height = globalThis.screen.availHeight - 400;
    this.width = globalThis.screen.availWidth;
  }
  ngAfterViewInit() {
    this.cardAnimation();
    this.showForm();
  }
  private cardAnimation(){
    this.animationCard = this.animationControler
    .create()
    .addElement(this.img!.nativeElement)
    .duration(1000)
    .iterations(1)
    .keyframes([
      {offset: 0, 
        transform: `rotateX(0deg)`, 
        width: `${this.height+100}px`, 
        height: `${this.width+100}px`},
      {offset: 0.2, 
        transform: `rotateX(0deg) translateY(${this.height}px)`, 
        width: `${this.height+100}px`, 
        height: `${this.width+100}px`},
      {offset: 0.75,
        width: `${this.height+100}px`, 
        height: `${this.width+100}px`},
      {offset: 1, opacity: '0.75', 
        width: `${this.height+100}px`, 
        height: `${this.width+100}px`}
    ])
    this.animationCard.play();
  }

  private showForm(){
    this.animationForm = this.animationControler
      .create()
      .addElement(this.form?.nativeElement!)
      .duration(3000)
      .iterations(1)
      .keyframes([
        {offset: 0, opacity : `0`},
        {offset: 0.25, opacity : `0`},
        {offset: 0.5, opacity : `0`},
        {offset : 0.75, opacity: `0.5`},
        {offset : 1, opacity: `1`, 
          width: `${this.width-this.width/5}px`,
          heigth: `${this.height}px`}
      ]);
      this.animationForm.play();
  }

  public getFormValues(){
    console.log({email:this.email, pass:this.pass})
    this.usuario.post('customerlogin', {
      email: this.email,
      contrasena: this.pass,
      nombre : '',
      apellido : '', 
      id : 0
    }).subscribe(data=>{
      if(typeof data.response == 'object' ){
        this.router.navigate(['/tabs/tab3'])
      }
    })
    
  }

}
