import { Component, OnInit, ViewChild } from '@angular/core';
import { Point } from './interfaces/points.iterface';
import { IonDatetime, NavController } from '@ionic/angular';
import { CalendarMode, Step } from 'ionic2-calendar';
import { event } from './interfaces/event.interface';

@Component({
  selector: 'app-tab3',
  templateUrl: 'tab3.page.html',
  styleUrls: ['tab3.page.scss']
})

export class Tab3Page implements OnInit{

  @ViewChild('Fecha')
  date!: IonDatetime;

  public time : Date = new Date();

  public isOpen : boolean = false;

  public user : String = "Usuario";

  public dayList : Array<event> = [];

  public selectedDay: Date = new Date();

  public points : Array<Point> = [
    {
      nombre: "Nada",
      icon : 'ellipse-outline',
      descuento: 0,
      id: 1
    },{
      nombre: "0.5€ Dto",
      icon : 'logo-euro',
      descuento: 0.5,
      id: 2
    },{
      nombre: "Nada",
      icon : 'ellipse-outline',
      descuento: 0,
      id: 3
    },{
      nombre: "1€ Dto",
      icon : 'logo-euro',
      descuento: 1.0,
      id: 4
    },{
      nombre: "Nada",
      icon : 'ellipse-outline',
      descuento: 0,
      id: 5
    },{
      nombre: "Sobre sorpresa",
      icon : 'mail-outline',
      descuento: 0,
      id: 6
    },{
      nombre: "Nada",
      icon : 'ellipse-outline',
      descuento: 0,
      id: 7
    },{
      nombre: "Regalo sorpresa",
      icon : 'cube-outline',
      descuento: 0,
      id: 8
    }
    
  ];

  private currentDiscount : number = 4;

  public currentPoint : Point  = {
    nombre: "",
    icon : '',
    descuento: 0,
    id: 0
  };

  public eventSource: { 
    title: string; 
    startTime: Date; 
    endTime: Date; 
    allDay: boolean; 
  }[] = [];
    viewTitle!: string;
    isToday!:boolean;
    
  calendar = {
      startingDayWeek: 1,
      startingDayMonth: 1,
      startHour : 10,
      endHour : 22,
      locale: 'es-ES',
      mode: 'month' as CalendarMode,
      step: 30 as Step,
      currentDate: new Date()
  };

    reloadTime(ev : any){
      this.dayList = this.eventSource.filter((e)=>
            e.startTime.getDate() == ev.selectedTime.getDate() &&
            e.endTime.getDate() == ev.selectedTime.getDate() 
            && e.allDay==false);
    }

    constructor(private navController:NavController) {
      if(this.currentDiscount != 0){
        this.currentPoint = this.points
          .find((e)=>e.id==this.currentDiscount)!;
      }
    }
  ngOnInit(): void {
    //Añadir el endpoint del servicio que tiene que dejar todos los 
    //eventos mayores al día de hoy, no creo que sean muchos, máximo 
    // si son 15 min la sesión y abren 8h entonces serán = 4 sesiones
    // hora, de modo que 4*8*4*12, el total al año serán de 1536 sesiones
    // máximo. Son pocos datos.
    
  }

    public extractDate(){
      if(this.date.value != null || this.date.value != undefined){
        const dateSelected : any = this.date.value;
        let dateParsed : Date = new Date(dateSelected);
        dateParsed.setMonth(this.selectedDay.getMonth());
        dateParsed.setDate(this.selectedDay.getDate());
        dateParsed.setFullYear(this.selectedDay.getFullYear())
        const selectedDatePlus15 : Date = new Date(dateSelected);
        const endDate : Date = new Date(selectedDatePlus15
          .setMinutes(dateParsed.getMinutes() +15));
        if(!this.thereIsNotDate(dateParsed)){
          this.eventSource.push({
            title:'Cita de Usuario',
            allDay:false,
            startTime : dateParsed,
            endTime : endDate,
          });
        }else{
          alert('fecha seleccionada por otro usuario');
        }
        this.setEventsInDay({selectedTime:dateParsed});
      }else{
        alert('Selecciona fecha');
      }
    }

    thereIsNotDate(dateParsed : Date): boolean{
      return this.eventSource.some(e=>
        e.startTime.getHours() == dateParsed.getHours() &&
        e.startTime.getMinutes() == dateParsed.getMinutes() &&
        e.startTime.getSeconds() == dateParsed.getSeconds() &&
        e.startTime.getDate() === dateParsed.getDate() &&
        e.startTime.getMonth() === dateParsed.getMonth() &&
        e.startTime.getFullYear() === dateParsed.getFullYear() 
      )
    }

    onViewTitleChanged(title : string) {
        this.viewTitle = title;
    }

    changeMode(mode :any) {
        this.calendar.mode = mode;
    }

    today() {
        this.calendar.currentDate = new Date();
    }

    setEventsInDay(ev: any) {
      this.dayList = this.eventSource.filter((e)=>{
        return e.startTime.getDate() == ev.selectedTime.getDate() &&
        e.startTime.getMonth() == ev.selectedTime.getMonth() &&
        e.startTime.getFullYear() == ev.selectedTime.getFullYear()
      });
    }

    onTimeSelected(ev:any) {
      //Este se supone que rescata las citas
      this.selectedDay = ev.selectedTime;
      if(this.eventSource.length != 0){
        this.setEventsInDay(ev);
        console.log({
          'dayList':this.dayList, 
          'eventSource':this.eventSource
        })
      }
      //Esto es para que la modal sólo se abra en los días de cita
      if(ev.selectedTime.getDay()!=0 &&
          ev.selectedTime.getDay()!=6 && 
          ev.selectedTime > new Date()){
           this.setOpen(true);
         }
    }

    public setOpen(open : boolean){
      this.isOpen = open;
    }

    onCurrentDateChanged(event:Date) {
        var today = new Date();
        today.setHours(0, 0, 0, 0);
        event.setHours(0, 0, 0, 0);
        this.isToday = today.getTime() === event.getTime();
    }

    createRandomEvents() {
        var events = [];
        for (var i = 0; i < 50; i += 1) {
            var date = new Date();
            var eventType = Math.floor(Math.random() * 2);
            var startDay = Math.floor(Math.random() * 90) - 45;
            var endDay = Math.floor(Math.random() * 2) + startDay;
            var startTime;
            var endTime;
            if (eventType === 0) {
                startTime = new Date(Date.UTC(date.getUTCFullYear(), date.getUTCMonth(), date.getUTCDate() + startDay));
                if (endDay === startDay) {
                    endDay += 1;
                }
                endTime = new Date(Date.UTC(date.getUTCFullYear(), date.getUTCMonth(), date.getUTCDate() + endDay));
            } else {
                var startMinute = Math.floor(Math.random() * 24 * 60);
                var endMinute = Math.floor(Math.random() * 180) + startMinute;
                startTime = new Date(date.getFullYear(), date.getMonth(), date.getDate() + startDay, 0, date.getMinutes() + startMinute);
                endTime = new Date(date.getFullYear(), date.getMonth(), date.getDate() + endDay, 0, date.getMinutes() + endMinute);
                events.push({
                    title: 'Event - ' + i,
                    startTime: startTime,
                    endTime: endTime,
                    allDay: false
                });
            }
        }
        return events;
    }

    onRangeChanged(ev:any) {
        console.log('range changed: startTime: ' + ev.startTime + ', endTime: ' + ev.endTime);
    }

    markDisabled = (date:Date) => {
        var current = new Date();
        current.setHours(0, 0, 0);
        return date < current 
          || date.getDay() == 0 
          || date.getDay() == 6;
    };

}
