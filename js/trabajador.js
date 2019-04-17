
function view(codigo) {
    
    var url = document.getElementById('hdController').value;
    var datos = new FormData(); //Creamos un objeto FormData que es un formulario virtual para pasar por POST
        datos.append('codigo',codigo); //Agregamos variables al formulario virtual con append (nombre,valor)
	datos.append('action','view');
	
	var solicitud = new XMLHttpRequest();
	
	solicitud.addEventListener('load',result,false);
	solicitud.open('POST',url,true);
	solicitud.send(datos); //Ahora en el send, enviamos como parámetro el formulario virtual
}

function edit(codigo){
    
    var url = document.getElementById('hdController').value;
    var datos = new FormData(); //Creamos un objeto FormData que es un formulario virtual para pasar por POST
        datos.append('codigo',codigo); //Agregamos variables al formulario virtual con append (nombre,valor)
	datos.append('action','edit');
	//var url = 'trabajador.controller.php';
	var solicitud = new XMLHttpRequest();
	
	solicitud.addEventListener('load',result,false);
	solicitud.open('POST',url,true);
	solicitud.send(datos); //Ahora en el send, enviamos como parámetro el formulario virtual
}

function drop(codigo){
    
    var url = document.getElementById('hdController').value;
    var datos = new FormData();
        datos.append('codigo',codigo);
        datos.append('action','delete');
        //var url = 'trabajador.controller.php';
        var solicitud = new XMLHttpRequest();
        
        solicitud.addEventListener('load',result,false);
        solicitud.open('POST',url,true);
        solicitud.send(datos);
}

function aceptar() {
    
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
    var cargo = document.getElementById('txtCargo').value;
    
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
        datos.append('cargo',cargo);
        
    var solicitud = new XMLHttpRequest();
	
	solicitud.addEventListener('load',result,false);
	solicitud.open('POST',url,true);
	solicitud.send(datos); 
}

function eliminar(){
    
    var url = document.getElementById('hdController').value;
    var codigo = document.getElementById('hdCodigo').value;
    
    var datos = new FormData();
        datos.append('action','eliminar');
        datos.append('codigo',codigo);
        
    var solicitud = new XMLHttpRequest();
    
        solicitud.addEventListener('load',result,true);
        solicitud.open('POST',url,true);
        solicitud.send(datos);
}

