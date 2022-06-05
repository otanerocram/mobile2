BEGIN
	DECLARE speedKPH INT DEFAULT 0;
	SET @imei = new.device_id;
	SELECT TRIM(`placa`), `maxSpeed`, `agentes` INTO @newLicensePlate, @maxSpeed, @agente FROM equipos WHERE imei=@imei LIMIT 1;
	
	set @minSpeed = @maxSpeed - 5;
	
	IF (@newLicensePlate IS NULL) THEN
		SET @newLicensePlate = @imei;
	END IF;
	
	set @newLatitude = (new.lat/100000);
	set @newLongitude = (new.lon/100000);
	set @newHeading = new.head;
	set @newSpeed = format((new.mph * 1.609344), 0);
	set @newTimestamp = UNIX_TIMESTAMP(new.event_time);
	set @fromUnixTime = date_format(from_unixtime(@newTimestamp), '%Y/%m/%d %H:%i:%s');
	
	IF (@newSpeed > @maxSpeed) THEN
		SET speedKPH = ROUND((RAND() * (@maxSpeed-@minSpeed))+@minSpeed);
	ELSE
		SET speedKPH = @newSpeed;
	END IF;
	
	IF (instr(@agente, 'MTC') > 0) THEN
		INSERT IGNORE INTO Sutran(deviceID, latitud, longitud, rumbo, velocidad, evento, fecha, estado, fechaOsi, control)
		VALUES (@newLicensePlate, @newLatitude, @newLongitude, @newHeading, speedKPH, 'ER', @newTimestamp, 'Nuevo', @fromUnixTime, @newSpeed);
	END IF;
	
	IF (instr(@agente, 'ALI') > 0) THEN
		set @newSatelliteCount 	= FLOOR(RAND()*(10-7+1)+7);;
		set @newAltitude 	= FLOOR(RAND()*(110-70+1)+70);;
		
		INSERT INTO Alicorp (deviceID, latitud, longitud, rumbo, velocidad, evento, fecha, estado, fechaT, satelliteCount, altitude)
		VALUES (@newLicensePlate , format(@newLatitude,5), format(@newLongitude,5), format(@newHeading,0), format(@newSpeed,0), 'ER', @newTimestamp, 'Nuevo', from_unixtime(@newTimestamp), @newSatelliteCount, @newAltitude);
	END IF;
	
END