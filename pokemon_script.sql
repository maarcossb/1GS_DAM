/*
Creamos un trigger que se ejecute cada vez que se borre un pokemon de la tabla pokemon para que se guarde
en la tabla pokemon_deleted el id y el nombre del pokemon borrado.
*/

-- Tabla de los pokemon borrados
CREATE TABLE IF NOT EXISTS pokemon_deleted (
    id INT NOT NULL AUTO_INCREMENT,
    deleted_at DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
    pokemon_id INT NOT NULL,
    pokemon_name VARCHAR(40) NOT NULL,
    PRIMARY KEY (id)
);

-- Trigger de borrado de pokemon
DELIMITER $$
DROP TRIGGER IF EXISTS pokemon_deleted_trigger;
CREATE TRIGGER pokemon_deleted_trigger AFTER DELETE ON pokemon
FOR EACH ROW
BEGIN
    INSERT INTO pokemon_deleted (pokemon_id, pokemon_name) VALUES (OLD.pok_id, OLD.pok_name);
END$$
DELIMITER ;

/*
Creamos un trigger que se ejecute cada vez que se inserte un pokemon en la tabla pokemon para que se guarde
en la tabla pokemon_created el id y el nombre del pokemon insertado.
*/

-- Tabla de los pokemon creados
CREATE TABLE IF NOT EXISTS pokemon_created (
    id INT NOT NULL AUTO_INCREMENT,
    created_at DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
    pokemon_id INT NOT NULL,
    pokemon_name VARCHAR(40) NOT NULL,
    PRIMARY KEY (id)
);

-- Trigger de inserción de pokemon
DELIMITER $$
DROP TRIGGER IF EXISTS pokemon_created_trigger;
CREATE TRIGGER pokemon_created_trigger AFTER INSERT ON pokemon
FOR EACH ROW
BEGIN
    INSERT INTO pokemon_created (pokemon_id, pokemon_name) VALUES (NEW.pok_id, NEW.pok_name);
END$$
DELIMITER ;

/*
Cursor en la tabla pokemon que asigna un alias a cada pokemon de la tabla pokemon a través de la función create_alias,
que recibe el nombre y el id del pokemon y devuelve un alias con los tres primeros caracteres del nombre y el id.
*/

-- Nueva columna alias
ALTER TABLE pokemon ADD COLUMN alias VARCHAR(10);

-- Función para crear alias
DELIMITER $$
DROP FUNCTION IF EXISTS create_alias;
CREATE FUNCTION create_alias(pokName VARCHAR(40), pokId INT)
RETURNS VARCHAR(10)
BEGIN
    DECLARE alias VARCHAR(10);
    SET alias = CONCAT(LEFT(pokName, 3), '-', pokId);
    RETURN alias;
END$$
DELIMITER ;

-- Cursor para insertar alias
DELIMITER $$
DROP PROCEDURE IF EXISTS insert_alias;
CREATE PROCEDURE insert_alias()
BEGIN
    DECLARE done INT DEFAULT FALSE;
    DECLARE pokId INT;
    DECLARE pokName VARCHAR(40);
    DECLARE cur CURSOR FOR SELECT pok_id, pok_name FROM pokemon;
    DECLARE CONTINUE HANDLER FOR NOT FOUND SET done = TRUE;
    OPEN cur;
    read_loop: LOOP
        FETCH cur INTO pokId, pokName;
        IF done THEN
            LEAVE read_loop;
        END IF;
        UPDATE pokemon SET alias = create_alias(pokName, pokId) WHERE pok_id = pokId;
    END LOOP;
    CLOSE cur;
END$$
DELIMITER ;
CALL insert_alias();


/*
Creamos un trigger que cree el alias de un pokemon cada vez que se inserte un pokemon en la tabla pokemon.
 */

-- Trigger de inserción de alias
DELIMITER $$
DROP TRIGGER IF EXISTS alias_created_trigger;
CREATE TRIGGER alias_created_trigger BEFORE INSERT ON pokemon
FOR EACH ROW
BEGIN
    SET NEW.alias = create_alias(NEW.pok_name, NEW.pok_id);
END$$
DELIMITER ;

/*
Cursor que asigna una imagen a cada pokemon de la tabla pokemon para meterla en una nueva columna columna image.
 */

-- Nueva columna image
ALTER TABLE pokemon ADD COLUMN pok_image VARCHAR(100);

-- Cursor para insertar imagen
DELIMITER $$
DROP PROCEDURE IF EXISTS insert_image;
CREATE PROCEDURE insert_image()
BEGIN
    DECLARE done INT DEFAULT FALSE;
    DECLARE pokId INT;
    DECLARE cur CURSOR FOR SELECT pok_id FROM pokemon;
    DECLARE CONTINUE HANDLER FOR NOT FOUND SET done = TRUE;
    OPEN cur;
    read_loop: LOOP
        FETCH cur INTO pokId;
        IF done THEN
            LEAVE read_loop;
        END IF;
        IF(pokId < 10) THEN
            UPDATE pokemon SET pok_image = CONCAT('https://assets.pokemon.com/assets/cms2/img/pokedex/detail/00', pokId, '.png') WHERE pok_id = pokId;
        ELSEIF(pokId < 100) THEN
            UPDATE pokemon SET pok_image = CONCAT('https://assets.pokemon.com/assets/cms2/img/pokedex/detail/0', pokId, '.png') WHERE pok_id = pokId;
        ELSE
            UPDATE pokemon SET pok_image = CONCAT('https://assets.pokemon.com/assets/cms2/img/pokedex/detail/', pokId, '.png') WHERE pok_id = pokId;
        END IF;
    END LOOP;
    CLOSE cur;
END$$
DELIMITER ;
CALL insert_image();

