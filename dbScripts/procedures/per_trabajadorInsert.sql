delimiter $$
use pruebas $$
drop PROCEDURE if EXISTS pruebas.per_trabajadorInsert $$

CREATE PROCEDURE `pruebas`.`per_trabajadorInsert`(_persona char(8),_cargo char(3)
)
BEGIN
	INSERT INTO per_trabajador (persona,cargo)
		VALUES (_persona,_cargo);
	select _persona as result;
END $$

delimiter ;