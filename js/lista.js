/* 
 Sript para los buscadores del sistema, controla el texto de búsqueda,
el botón buscar y el botón para nuevo registro
 */
function init() {
    
    divResult = document.getElementById('divData');
        
    var btnSearch = document.getElementById('btnSearch');
    var btnNew = document.getElementById('btnNew');
    
    btnSearch.addEventListener('click',search,false);
    btnNew.addEventListener('click',insert,false);
}

function result(e) {
    
	divResult.innerHTML = e.target.responseText; //La respuesta de php la tenemos en responseText
}

function search(){
    
    var url = document.getElementById('hdController').value;
    var codigo = document.getElementById('txtSearch').value;
    var datos = new FormData();
    datos.append('codigo',codigo);
    datos.append('action','search');    
    
    var solicitud = new XMLHttpRequest();
    
    solicitud.addEventListener('load',result,false);
    solicitud.open('POST',url,true);
    solicitud.send(datos);
    
}

function insert(){
    
    var url = document.getElementById('hdController').value;
    var datos = new FormData();
        datos.append('action','new');
        datos.append('codigo','00000000');
    
    var solicitud = new XMLHttpRequest();
        solicitud.addEventListener('load',result,false);
        solicitud.open('POST',url,true);
        solicitud.send(datos);
}

window.addEventListener('load',init,false);

