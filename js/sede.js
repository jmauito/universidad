
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
        var solicitud = new XMLHttpRequest();
        
        solicitud.addEventListener('load',result,false);
        solicitud.open('POST',url,true);
        solicitud.send(datos);
}

function aceptar() {
    var url = document.getElementById('hdController').value;
    var hdAction = document.getElementById('hdAction').value;
    var sede = document.getElementById('hdCodigo').value;

    var nombre = document.getElementById('txtNombre').value;
    var alias = document.getElementById('txtAlias').value;
    
    
    var datos = new FormData(); //Creamos un objeto FormData que es un formulario virtual para pasar por POST

    datos.append('action',hdAction);
        datos.append('codigo',sede);
        datos.append('nombre',nombre);
        datos.append('alias',alias);
        
        
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

