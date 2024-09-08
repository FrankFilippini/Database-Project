USE `Starfish`;

-- AMMINISTRATORE
INSERT INTO `AMMINISTRATORI`(`codiceAmministratore`, `CF`, `nome`, `cognome`, `email`, `password`) 
VALUES (0,'MRORSI05X31C504K','Mario','Rossi','mario.rossi@admin.starfish.com','test');

-- AGENDA DEI TURNI
INSERT INTO `AGENDE_DEI_TURNI`(`mese`, `codiceAmministratore`)
VALUES (6, 0);

INSERT INTO `AGENDE_DEI_TURNI`(`mese`, `codiceAmministratore`)
VALUES (8, 0);

-- TURNO DI LAVORO
INSERT INTO `TURNI_DI_LAVORO`(`oraInizio`, `oraFine`) 
VALUES (TIME '08:00:00', TIME '13:00:00');

INSERT INTO `TURNI_DI_LAVORO`(`oraInizio`, `oraFine`) 
VALUES (TIME '08:00:00', TIME '13:00:00');

-- MEMBRI
INSERT INTO `MEMBRI`(`CF`,`nome`, `cognome`, `email`, `password`, `idTurno`) 
VALUES ('SLVSPS02R24E123W', 'Salvatore','Esposito','salvatore.esposito@starfish.com','test', 1);

INSERT INTO `MEMBRI`(`CF`,`nome`, `cognome`, `email`, `password`, `giorno`, `idTurno`) 
VALUES ('DVDGGN04F30D704Q', 'David','Goggins','david.goggins@starfish.com','test', 2);

INSERT INTO `MEMBRI`(`CF`,`nome`, `cognome`, `email`, `password`, `idTurno`) 
VALUES ('ANJD04F30D704Q', 'Alex','West','alex.west@starfish.com','test', 1);

-- CLIENTE
INSERT INTO `CLIENTI`(`numeroTelefono`, `CF`, `nome`, `cognome`, `email`, `password`)
VALUES (1234567890,'NCLNRI99F10G104Q','Nicola','Neri','nicola.neri@gmail.com','test');

INSERT INTO `CLIENTI`(`numeroTelefono`, `CF`, `nome`, `cognome`, `email`, `password`)
VALUES (1234567890,'DOCNDOVNOIJAO','Alberto','Bianchi','alberto.bianchi@gmail.com','test');


-- OMBRELLONI
INSERT INTO `OMBRELLONI`() VALUES();
INSERT INTO `OMBRELLONI`() VALUES();
INSERT INTO `OMBRELLONI`() VALUES();
INSERT INTO `OMBRELLONI`() VALUES();
INSERT INTO `OMBRELLONI`() VALUES();
INSERT INTO `OMBRELLONI`() VALUES();
INSERT INTO `OMBRELLONI`() VALUES();

-- LETTINI
INSERT INTO `LETTINI`() VALUES();
INSERT INTO `LETTINI`() VALUES();
INSERT INTO `LETTINI`() VALUES();
INSERT INTO `LETTINI`() VALUES();
INSERT INTO `LETTINI`() VALUES();
INSERT INTO `LETTINI`() VALUES();
INSERT INTO `LETTINI`() VALUES();
INSERT INTO `LETTINI`() VALUES();
INSERT INTO `LETTINI`() VALUES();

-- PEDALÒ
INSERT INTO `PEDALO`() VALUES();
INSERT INTO `PEDALO`() VALUES();
INSERT INTO `PEDALO`() VALUES();
INSERT INTO `PEDALO`() VALUES();
INSERT INTO `PEDALO`() VALUES();
INSERT INTO `PEDALO`() VALUES();
INSERT INTO `PEDALO`() VALUES();
INSERT INTO `PEDALO`() VALUES();




-- LISTINI

INSERT INTO `LISTINI`(`mese`, `codiceAmministratore`)
VALUES(1,0);
INSERT INTO `LISTINI`(`mese`, `codiceAmministratore`)
VALUES(2,0);
INSERT INTO `LISTINI`(`mese`, `codiceAmministratore`)
VALUES(3,0);
INSERT INTO `LISTINI`(`mese`, `codiceAmministratore`)
VALUES(4,0);
INSERT INTO `LISTINI`(`mese`, `codiceAmministratore`)
VALUES(5,0);
INSERT INTO `LISTINI`(`mese`, `codiceAmministratore`)
VALUES(6,0);
INSERT INTO `LISTINI`(`mese`, `codiceAmministratore`)
VALUES(7,0);
INSERT INTO `LISTINI`(`mese`, `codiceAmministratore`)
VALUES(8,0);
INSERT INTO `LISTINI`(`mese`, `codiceAmministratore`)
VALUES(9,0);
INSERT INTO `LISTINI`(`mese`, `codiceAmministratore`)
VALUES(10,0);
INSERT INTO `LISTINI`(`mese`, `codiceAmministratore`)
VALUES(11,0);
INSERT INTO `LISTINI`(`mese`, `codiceAmministratore`)
VALUES(12,0);

-- STORICO RECENSIONI

INSERT INTO `STORICO_RECENSIONI`(`mese`, `codiceAmministratore`)
VALUES (6,0);
INSERT INTO `STORICO_RECENSIONI`(`mese`, `codiceAmministratore`) 
VALUES (7,0);
INSERT INTO `STORICO_RECENSIONI`(`mese`, `codiceAmministratore`)
VALUES (8,0);