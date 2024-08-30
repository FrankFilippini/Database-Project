USE `Starfish`;

-- AMMINISTRATORE
INSERT INTO `AMMINISTRATORI`(`codiceStaff`, `CF`, `nome`, `cognome`, `email`, `password`) 
VALUES (0,'MRORSI05X31C504K','Mario','Rossi','mario.rossi@admin.starfish.com','test');

-- AGENDA DEI TURNI
INSERT INTO `AGENDE_DEI_TURNI`(`mese`, `codiceStaff`)
VALUES (6, 0);

-- TURNO DI LAVORO
INSERT INTO `TURNI_DI_LAVORO`(`giorno`, `oraInizio`, `oraFine`, `mese`) 
VALUES (5, TIME '08:00:00', TIME '13:00:00', 6);

-- MEMBRI
INSERT INTO `MEMBRI`(`CF`,`nome`, `cognome`, `email`, `password`, `giorno`, `mese`) 
VALUES ('SLVSPS02R24E123W', 'Salvatore','Esposito','salvatore.esposito@starfish.com','test', 5, 6);

INSERT INTO `MEMBRI`(`CF`,`nome`, `cognome`, `email`, `password`, `giorno`, `mese`) 
VALUES ('DVDGGN04F30D704Q', 'David','Goggins','david.goggins@starfish.com','test', 5, 6);

-- CLIENTE
INSERT INTO `CLIENTI`(`numeroTelefono`, `CF`, `nome`, `cognome`, `email`, `password`)
VALUES (1234567890,'NCLNRI99F10G104Q','Nicola','Neri','nicola.neri@gmail.com','test');