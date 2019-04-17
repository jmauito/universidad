DELIMITER $$
USE pruebas $$
DROP PROCEDURE if EXISTS mae_personaInsert $$
CREATE PROCEDURE mae_personaInsert(_nombreCompleto varchar(243)
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
	set @maxCodigo := CONVERT ( (select max(persona) from mae_persona) , INT ) ;
    
	set @persona = LPAD( (@maxCodigo+1),8,0 );
    
    INSERT INTO mae_persona (persona
                            ,nombreCompleto
                            ,apellidoPaterno,apellidoMaterno
                            ,primerNombre,segundoNombre
                            ,correoInstitucional,correoPersonal
                            ,cedulaIdentidad,ruc) 
           VALUES (@persona
                            ,_nombreCompleto
                            ,_apellidoPaterno,_apellidoMaterno
                            ,_primerNombre,_segundoNombre
                            ,_correoInstitucional,_correoPersonal
                            ,_cedulaIdentidad,_ruc);
           SELECT @persona as result;

END $$
DELIMITER ;
