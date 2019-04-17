insert into mae_persona_aud (persona,nombreCompleto,primerNombre_old,segundoNombre_old,apellidoPaterno_old,
apellidoMaterno_old,correoInstitucional_old,correoPersonal_old,cedulaIdentidad_old,ruc_old,
estado_old,
nombreCompleto_new,primerNombre_new,segundoNombre_new,apellidoPaterno_new,apellidoMaterno_new,
correoInstitucional_new,correoPersonal_new,cedulaIdentidad_new,ruc_new,estado_new
,fecha,accion)
VALUES (OLD.nombreCompleto,OLD.primerNombre,OLD.segundoNombre,OLD.apellidoPaterno,OLD.apellidoMaterno,
OLD.correoInstitucional,OLD.correoPersonal,OLD.cedulaIdentidad,OLD.ruc,OLD.estado,
NEW.nombreCompleto,NEW.primerNombre,NEW.segundoNombre,NEW.apellidoPaterno,NEW.apellidoMaterno,
NEW.correoInstitucional,NEW.correoPersonal,NEW.cedulaIdentidad,NEW.ruc,NEW.estado,
date(),'U'
)
;