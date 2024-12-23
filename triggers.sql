-- trigger validar acomodaccciones


CREATE OR REPLACE FUNCTION validate_accommodations()
RETURNS TRIGGER AS $$
BEGIN
    IF (NEW.room_type_id = 1 AND NEW.assignment_id NOT IN (1, 2)) OR
       (NEW.room_type_id = 2 AND NEW.assignment_id NOT IN (3, 4)) OR
       (NEW.room_type_id = 3 AND NEW.assignment_id NOT IN (1, 2, 3)) THEN
        -- SIGNAL SQLSTATE '45000' SET MESSAGE_TEXT = 'La asignación no es válida para este tipo de habitación';
        RAISE EXCEPTION 'La asignación no es válida para este tipo de habitación';
    END IF;

    RETURN NEW;
END;

$$ LANGUAGE plpgsql;


CREATE TRIGGER validate_accommodations_trigger
BEFORE INSERT OR UPDATE ON accommodations
FOR EACH ROW
EXECUTE FUNCTION validate_accommodations();

-- trigger validar hibitaciones maximas


CREATE OR REPLACE FUNCTION validate_max_rooms()
RETURNS TRIGGER AS $$
DECLARE
    total_rooms INT;
BEGIN

    SELECT COALESCE(SUM(quantity), 0)
    INTO total_rooms
    FROM rooms
    WHERE hotel_id = NEW.hotel_id;


    IF total_rooms + NEW.quantity > (SELECT max_rooms FROM hotels WHERE id = NEW.hotel_id) THEN
        RAISE EXCEPTION 'el numero total de habitaciones exceden el maximo permitido para este hotel.';
    END IF;

    RETURN NEW;
END;
$$ LANGUAGE plpgsql;


CREATE TRIGGER validate_max_rooms_trigger
BEFORE INSERT OR UPDATE ON rooms
FOR EACH ROW
EXECUTE FUNCTION validate_max_rooms();

-- trigger validar habitaciones

CREATE OR REPLACE FUNCTION validate_rooms()
RETURNS TRIGGER AS $$
BEGIN
    IF (TG_OP = 'INSERT') THEN
        -- Validar que no exista la combinación de hotel_id y accommodation_id
        IF (NEW.hotel_id = (SELECT hotel_id FROM rooms WHERE hotel_id = NEW.hotel_id AND accommodation_id = NEW.accommodation_id)) THEN
            RAISE EXCEPTION 'Ya existen habitaciones configuradas con esos parámetros';
        END IF;
    END IF;

    -- Si estamos actualizando, verificamos si hay cambios en hotel_id o accommodation_id
    IF (TG_OP = 'UPDATE') THEN
        -- Si se modifica el hotel_id o accommodation_id, comprobamos si ya existe la combinación
        IF (NEW.hotel_id <> OLD.hotel_id OR NEW.accommodation_id <> OLD.accommodation_id) THEN
            -- Validar que la nueva combinación no exista
            IF EXISTS (SELECT 1 FROM rooms WHERE hotel_id = NEW.hotel_id AND accommodation_id = NEW.accommodation_id) THEN
                RAISE EXCEPTION 'Ya existen habitaciones configuradas con estos parámetros';
            END IF;
        END IF;
    END IF;

    RETURN NEW;
END;

$$ LANGUAGE plpgsql;


CREATE TRIGGER validate_rooms_trigger
BEFORE INSERT OR UPDATE ON rooms
FOR EACH ROW
EXECUTE FUNCTION validate_rooms();
