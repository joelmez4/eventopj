(function(){
    var actualizarHora=function(){
    
		var fecha = new Date();
        horas = fecha.getHours(); 
        ampm=""; //temporal
        minutos = fecha.getMinutes(); 
        segundos = fecha.getSeconds(); 
        diaSemana = fecha.getDay(); 
        dia = fecha.getDate(); 
        mes = fecha.getMonth(); 
        mesbd = fecha.getMonth();
        year = fecha.getFullYear(); 

        

        
        var phoras=document.getElementById('horas');
        var pampm=document.getElementById('ampm');
        var pminutos=document.getElementById('minutos');
        var psegundos=document.getElementById('segundos');
        var pDiaSemana = document.getElementById('diaSemana'),
			pDia = document.getElementById('dia'),
			pMes = document.getElementById('mes'),
            pYear = document.getElementById('year');
            document.getElementById('horabd').value=horas+":"+minutos+":"+segundos; 
 
     
        var semana=['Domingo', 'Lunes', 'Martes', 'Miercoles', 'Jueves', 'Viernes', 'Sabado']; 
        pDiaSemana.textContent = semana[diaSemana];
        if(dia<10)
        {
            dia="0"+dia;
        }
        pDia.textContent=dia;
        var meses=['Enero', 'Febrero','Marzo', 'Abril', 'Mayo', 'Junio','Julio','Agosto', 'Septiembre','Octubre','Noviembre', 'Diciembre'];
        pMes.textContent=meses[mes];
        pYear.textContent=year;

              
      
        if(horas>=12)
        {
            horas=horas-12;
            ampm="PM";
        }
        else{
            ampm="AM";
        }
      
        if(horas==0)
        {
            horas=12;
        }
        if(horas<10)
        {
            horas="0"+horas;
        }
        phoras.textContent=horas; 
        pampm.textContent=ampm; 
       
        if(minutos<10)
        {
            minutos="0"+minutos;
        }
        if(segundos<10)
        {
            segundos="0"+segundos;
        }
        pminutos.textContent=minutos; 
        psegundos.textContent=segundos;   
    };
 
    actualizarHora();
    var intervalo=setInterval(actualizarHora,1000);

}())
