function enroll(codigo){
    
    var url = document.getElementById('hdController').value;
    var datos = new FormData();
        datos.append('action','enroll');
        datos.append('codigo',codigo);
        
    var solicitud = new XMLHttpRequest();
        solicitud.addEventListener('load',result,true);
        solicitud.open('POST',url,true);
        solicitud.send(datos);
}

function registrarMatricula(){
   var url = document.getElementById('hdController').value;
   var persona = document.getElementById('hdPersona').value;
   //var semestre = document.getElementById('lsSemetre').value;
   //var sede = document.getElementById('lsSede').value;
   //var carrera = document.getElementById('lsCarrera').value;
   
    var datos = new FormData();
        datos.append('action','registrarMatricula');
        datos.append('codigo',persona);
        //datos.append('codigo',codigo);
        
    //var url = '../controller/matricula.controller.php';
    var solicitud = new XMLHttpRequest();
        solicitud.addEventListener('load',result,true);
        solicitud.open('POST',url,true);
        solicitud.send(datos); 
}

function insertAlumno(){
    var url = document.getElementById('hdController').value;
    var hdAction = document.getElementById('hdAction').value;
    var persona = document.getElementById('hdCodigo').value;

    var primerNombre = document.getElementById('txtPrimerNombre').value;
    var segundoNombre = document.getElementById('txtSegundoNombre').value;
    var apellidoPaterno = document.getElementById('txtApellidoPaterno').value;
    var apellidoMaterno = document.getElementById('txtApellidoMaterno').value;
    var correoInstitucional = document.getElementById('txtCorreoInstitucional').value;
    var correoPersonal = document.getElementById('txtCorreoPersonal').value;
    var cedulaIdentidad = document.getElementById('txtCedulaIdentidad').value;
    var ruc = document.getElementById('txtRuc').value;
    var condicion = document.getElementById('txtCondicion').value;
    
    var datos = new FormData(); //Creamos un objeto FormData que es un formulario virtual para pasar por POST
	datos.append('action',hdAction);
        datos.append('codigo',persona);
        datos.append('primerNombre',primerNombre);
        datos.append('segundoNombre',segundoNombre);
        datos.append('apellidoPaterno',apellidoPaterno);
        datos.append('apellidoMaterno',apellidoMaterno);
        datos.append('correoInstitucional',correoInstitucional);
        datos.append('correoPersonal',correoPersonal);
        datos.append('cedulaIdentidad',cedulaIdentidad);
        datos.append('ruc',ruc);
        datos.append('condicion',condicion);
        
    var solicitud = new XMLHttpRequest();
	
	solicitud.addEventListener('load',result,false);
	solicitud.open('POST',url,true);
	solicitud.send(datos); 

}