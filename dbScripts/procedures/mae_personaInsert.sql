delimiter $$
use pruebas $$
drop PROCEDURE if EXISTS pruebas.mae_personaInsert $$

CREATE PROCEDURE `pruebas`.`mae_personaInsert`(_nombreCompleto varchar(243)
                            ,_apellidoPaterno varchar(60)
                            ,_apellidoMaterno varchar(60)
                            ,_primerNombre varchar(60)
                            ,_segundoNombre varchar(60)
                            ,_correoInstitucional varchar(200)
                            ,_correoPersonal varchar(200)
                            ,_cedulaIdentidad char(10)
                            ,_ruc char(13)
)
BEGIN
	
	declare _maxCodigo int DEFAULT 0;
	declare _persona char(8);
	set _maxCodigo := CONVERT ( (select max(persona) from mae_persona) , INT ) ;
    
	set _persona = LPAD( (_maxCodigo+1),8,0 );
    
    INSERT INTO mae_persona (persona
                            ,nombreCompleto
                            ,apellidoPaterno,apellidoMaterno
                            ,primerNombre,segundoNombre
                            ,correoInstitucional,correoPersonal
                            ,cedulaIdentidad,ruc) 
           VALUES (_persona
                            ,_nombreCompleto
                            ,_apellidoPaterno,_apellidoMaterno
                            ,_primerNombre,_segundoNombre
                            ,_correoInstitucional,_correoPersonal
                            ,_cedulaIdentidad,_ruc);
           SELECT _persona as result;

END $$

delimiter ;