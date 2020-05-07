(function(){
    var actualizarHora=function(){
    // Obtenemos la fecha actual, incluyendo las horas, minutos, segundos, dia de la semana, dia del mes, mes y año;
		var fecha = new Date();
        horas = fecha.getHours(); //obtiene a hora de la pc
        ampm=""; //temporal
        minutos = fecha.getMinutes(); //minutos de la pc
        segundos = fecha.getSeconds(); //segundos de la pc
        diaSemana = fecha.getDay(); //saca el dia de la semana del 0 al 7
        dia = fecha.getDate(); //obtiene el dia en numeri
        mes = fecha.getMonth(); //obtiene el mes el numero de 1 al 12
        mesbd = fecha.getMonth();//para mibd recordad que enero es 0
        year = fecha.getFullYear(); //obtiene el año

        

        // Accedemos a los elementos del DOM para agregar mas adelante sus correspondientes valores
        var phoras=document.getElementById('horas');
        var pampm=document.getElementById('ampm');
        var pminutos=document.getElementById('minutos');
        var psegundos=document.getElementById('segundos');
        var pDiaSemana = document.getElementById('diaSemana'),
			pDia = document.getElementById('dia'),
			pMes = document.getElementById('mes'),
            pYear = document.getElementById('year');
            document.getElementById('horabd').value=horas+":"+minutos+":"+segundos; //hora añadido a input text para bd
 
        // Obtenemos el dia se la semana y lo mostramos
        var semana=['Domingo', 'Lunes', 'Martes', 'Miercoles', 'Jueves', 'Viernes', 'Sabado']; //del 0 al 7
        pDiaSemana.textContent = semana[diaSemana];
        if(dia<10)
        {
            dia="0"+dia;
        }
        pDia.textContent=dia;
        var meses=['Enero', 'Febrero','Marzo', 'Abril', 'Mayo', 'Junio','Julio','Agosto', 'Septiembre','Octubre','Noviembre', 'Diciembre'];
        pMes.textContent=meses[mes];
        pYear.textContent=year;

              
        //cambiar el formato de 24 a 12 horas
        if(horas>=12)
        {
            horas=horas-12;
            ampm="PM";
        }
        else{
            ampm="AM";
        }
        //cuando sea las 00 horas lo transformmos a 12
        if(horas==0)
        {
            horas=12;
        }
        if(horas<10)
        {
            horas="0"+horas;
        }
        phoras.textContent=horas; //mostrar hora
        pampm.textContent=ampm; //mostrar AM  o PM segun el if
        //concatenando el 0 cuando los numeros sea menos que 10
        if(minutos<10)
        {
            minutos="0"+minutos;
        }
        if(segundos<10)
        {
            segundos="0"+segundos;
        }
        pminutos.textContent=minutos; //muesra los minutos
        psegundos.textContent=segundos;   //muestra los segundos
    };
    //llamando a la funcion cada 1 segundo
    actualizarHora();
    var intervalo=setInterval(actualizarHora,1000);

}())
