USE `Starfish`;

-- AMMINISTRATORE
INSERT INTO `AMMINISTRATORI`(`codiceAmministratore`, `CF`, `nome`, `cognome`, `email`, `password`) 
VALUES (0,'MRORSI05X31C504K','Mario','Rossi','mario.rossi@admin.starfish.com','test');

-- TURNO DI LAVORO
INSERT INTO `TURNI_DI_LAVORO`(`oraInizio`, `oraFine`) 
VALUES (TIME '08:00:00', TIME '12:00:00');

INSERT INTO `TURNI_DI_LAVORO`(`oraInizio`, `oraFine`) 
VALUES (TIME '12:00:00', TIME '16:00:00');

INSERT INTO `TURNI_DI_LAVORO`(`oraInizio`, `oraFine`) 
VALUES (TIME '16:00:00', TIME '20:00:00');

INSERT INTO `TURNI_DI_LAVORO`(`oraInizio`, `oraFine`) 
VALUES (TIME '20:00:00', TIME '24:00:00');

-- MEMBRI
INSERT INTO `MEMBRI`(`CF`,`nome`, `cognome`, `email`, `password`) 
VALUES ('SLVSPS02R24E123W', 'Salvatore','Esposito','salvatore.esposito@starfish.com','test');

INSERT INTO `MEMBRI`(`CF`,`nome`, `cognome`, `email`, `password`) 
VALUES ('DVDGGN04F30D704Q', 'David','Goggins','david.goggins@starfish.com','test');

INSERT INTO `MEMBRI`(`CF`,`nome`, `cognome`, `email`, `password`) 
VALUES ('ANJD04F30D704Q', 'Alex','West','alex.west@starfish.com','test');

-- AGENDA DEI TURNI
INSERT INTO `AGENDE_DEI_TURNI`(`codiceStaff`, `idTurno`, `dataTurno`, `codiceAmministratore`)
VALUES (1,1, '2024-06-24',0);

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