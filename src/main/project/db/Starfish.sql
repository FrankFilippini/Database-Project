-- *********************************************
-- * Standard SQL generation                   
-- *--------------------------------------------
-- * DB-MAIN version: 11.0.2              
-- * Generator date: Sep 14 2021              
-- * Generation date: Mon Aug 19 10:11:13 2024 
-- * LUN file: C:\Users\Gemma\Documents\BASI DI DATI\ELABORATO\Sito di uno stabilimento balneare.lun 
-- * Schema: schema relazionale finale/1 
-- ********************************************* 


-- Database Section
-- ________________

DROP DATABASE IF EXISTS `Starfish`;
CREATE DATABASE `Starfish` DEFAULT CHARACTER SET 'utf8mb4' COLLATE 'utf8mb4_bin';
USE `Starfish`;


-- Tables Section
-- ________________

CREATE TABLE `AGENDE_DEI_TURNI` (
     `mese` INT UNSIGNED NOT NULL CHECK (`mese` BETWEEN 1 AND 12),
     `codiceStaff` INT UNSIGNED NOT NULL,
     CONSTRAINT `ID_AGENDA_DEI_TURNI_PK` PRIMARY KEY (`mese`));

CREATE TABLE `AMMINISTRATORI` (
     `codiceStaff` INT UNSIGNED NOT NULL,
     `CF` VARCHAR(50) NOT NULL,
     `nome` VARCHAR(50) NOT NULL DEFAULT '',
     `cognome` VARCHAR(50) NOT NULL DEFAULT '',
     `email` VARCHAR(50) UNIQUE DEFAULT NULL,
     `password` VARCHAR(25) NOT NULL,
     CONSTRAINT `ID_AMMINISTRATORE_PK` PRIMARY KEY (`codiceStaff`));

CREATE TABLE `CLIENTI` (
     `codiceCliente` INT UNSIGNED NOT NULL AUTO_INCREMENT,
     `numeroTelefono` INT UNSIGNED NOT NULL DEFAULT 0,
     `CF` VARCHAR(50) NOT NULL,
     `nome` VARCHAR(50) NOT NULL DEFAULT '',
     `cognome` VARCHAR(50) NOT NULL DEFAULT '',
     `email` VARCHAR(50) UNIQUE DEFAULT NULL,
     `password` VARCHAR(25) NOT NULL,
     CONSTRAINT `ID_CLIENTI_PK` PRIMARY KEY (`codiceCliente`));

CREATE TABLE `EVENTI` (
     `codiceEvento` INT UNSIGNED NOT NULL AUTO_INCREMENT,
     `dataInizio` DATETIME NOT NULL,
     `dataFine` DATETIME NOT NULL,
     `numeroPosti` INT UNSIGNED,
     `codiceStaff` INT UNSIGNED NOT NULL,
     CONSTRAINT `ID_EVENTO_PK` PRIMARY KEY (`codiceEvento`));

CREATE TABLE `ISCRIZIONI` (
     `codiceEvento` INT UNSIGNED NOT NULL,
     `codiceCliente` INT UNSIGNED NOT NULL,
     CONSTRAINT `FKR_1_ID` UNIQUE (`codiceCliente`),
     CONSTRAINT `ID_ISCRIZIONI_PK` PRIMARY KEY (`codiceEvento`, `codiceCliente`));

CREATE TABLE `LETTINI` (
     `codiceLettino` INT UNSIGNED NOT NULL AUTO_INCREMENT,
     CONSTRAINT `ID_LETTINO_PK` PRIMARY KEY (`codiceLettino`));

CREATE TABLE `LISTINI` (
     `mese` INT UNSIGNED NOT NULL CHECK (`mese` BETWEEN 1 AND 12), 
     `codiceStaff` INT UNSIGNED NOT NULL,
     CONSTRAINT `ID_LISTINO_PK` PRIMARY KEY (`mese`));

CREATE TABLE `MEMBRI` (
     `CF` VARCHAR(50) NOT NULL,
     `codiceStaff` INT UNSIGNED NOT NULL AUTO_INCREMENT,
     `IdTurno` INT UNSIGNED NOT NULL,
     `nome` VARCHAR(50) NOT NULL DEFAULT '',
     `cognome` VARCHAR(50) NOT NULL DEFAULT '',
     `email` VARCHAR(50) UNIQUE DEFAULT NULL,
     `password` VARCHAR(25) NOT NULL,
     CONSTRAINT `ID_MEMBRO_PK` PRIMARY KEY (`codiceStaff`),
     CONSTRAINT `FKR_ID` UNIQUE (`IdTurno`));

CREATE TABLE `OMBRELLONI` (
     `codiceOmbrellone` INT UNSIGNED NOT NULL AUTO_INCREMENT,
     CONSTRAINT `ID_OMBRELLONE_PK` PRIMARY KEY (`codiceOmbrellone`));

CREATE TABLE `PEDALO'` (
     `codicePedalò` INT UNSIGNED NOT NULL AUTO_INCREMENT,
     CONSTRAINT `ID_PEDALO__PK` PRIMARY KEY (`codicePedalò`));

CREATE TABLE `PRENOTAZIONI` (
     `dataInizio` DATETIME NOT NULL,
     `dataFine` DATETIME NOT NULL,
     `codicePrenotazione` INT UNSIGNED NOT NULL AUTO_INCREMENT,
     `codiceCliente` INT UNSIGNED NOT NULL,
     `mese` INT UNSIGNED NOT NULL CHECK (`mese` BETWEEN 1 AND 12),
     CONSTRAINT `ID_PRENOTAZIONE_PK` PRIMARY KEY (`codicePrenotazione`),
     CONSTRAINT `FKR_ID` UNIQUE (`codiceCliente`));

CREATE TABLE `RECENSIONI` (
     `codiceRecensione` INT UNSIGNED NOT NULL AUTO_INCREMENT,
     `codiceCliente` INT UNSIGNED NOT NULL,
     `valutazione` INT UNSIGNED,
     `codiceStaff` INT UNSIGNED NOT NULL,
     `mese` INT UNSIGNED NOT NULL CHECK (`mese` BETWEEN 1 AND 12),
     CONSTRAINT `ID_RECENSIONI_PK` PRIMARY KEY (`codiceRecensione`),
     CONSTRAINT `FKR_ID` UNIQUE (`codiceCliente`));

CREATE TABLE `STORICO_RECENSIONI` (
     `mese` INT UNSIGNED NOT NULL CHECK (`mese` BETWEEN 1 AND 12),
     `codiceStaff` INT UNSIGNED NOT NULL,
     CONSTRAINT `ID_STORICO_RECENSIONI_PK` PRIMARY KEY (`mese`));

CREATE TABLE `TAVOLI` (
     `numeroTavolo` INT UNSIGNED NOT NULL AUTO_INCREMENT,
     `numero_persone` INT UNSIGNED NOT NULL,
     CONSTRAINT `ID_TAVOLO_PK` PRIMARY KEY (`numeroTavolo`));

CREATE TABLE `TIPOLOGIE` (
     `codicePrenotazione` INT UNSIGNED NOT NULL,
     `codiceOmbrellone` INT UNSIGNED NOT NULL,
     `codiceLettino` INT UNSIGNED NOT NULL,
     `numeroTavolo` INT UNSIGNED NOT NULL,
     `codicePedalò` INT UNSIGNED NOT NULL,
     CONSTRAINT `FKR_ID` UNIQUE (`codiceLettino`),
     CONSTRAINT `FKR_1_ID` UNIQUE (`numeroTavolo`),
     CONSTRAINT `FKR_2_ID` UNIQUE (`codicePedalò`),
     CONSTRAINT `ID_TIPOLOGIE_PK` PRIMARY KEY (`codicePrenotazione`, `codiceOmbrellone`, `codiceLettino`, `numeroTavolo`, `codicePedalò`));

CREATE TABLE `TURNI_DI_LAVORO` (
     `giorno` INT UNSIGNED NOT NULL CHECK (`giorno` BETWEEN 1 AND 7),
     `oraInizio` TIME NOT NULL,
     `oraFine` TIME NOT NULL,
     `mese` INT UNSIGNED NOT NULL CHECK (`mese` BETWEEN 1 AND 12),
     `IdTurno` INT UNSIGNED NOT NULL AUTO_INCREMENT,
     CONSTRAINT `IDTURNI_DI_LAVORO_PK` PRIMARY KEY (`IdTurno`));

CREATE TABLE VISUALIZZAZIONI (
     `codicePrenotazione` INT UNSIGNED NOT NULL,
     `codiceStaff` INT UNSIGNED NOT NULL,
     CONSTRAINT `ID_VISUALIZZAZIONI_PK` PRIMARY KEY (`codicePrenotazione`, `codiceStaff`));


-- CONSTRAINTs Section
-- ___________________ 

ALTER TABLE `AGENDE_DEI_TURNI` ADD CONSTRAINT `FKCONSULTAZIONE_FK`
     FOREIGN KEY (`codiceStaff`)
     REFERENCES `AMMINISTRATORI`(`codiceStaff`);

ALTER TABLE `ISCRIZIONI`
ADD CONSTRAINT `FK_ISCRIZIONI_CLIENTI`
FOREIGN KEY (`codiceCliente`) REFERENCES `CLIENTI`(`codiceCliente`);

ALTER TABLE `PRENOTAZIONI`
ADD CONSTRAINT `FK_PRENOTAZIONI_CLIENTI`
FOREIGN KEY (`codiceCliente`) REFERENCES `CLIENTI`(`codiceCliente`); 

ALTER TABLE `RECENSIONI`
ADD CONSTRAINT `FK_RECENSIONI_CLIENTI`
FOREIGN KEY (`codiceCliente`) REFERENCES `CLIENTI`(`codiceCliente`); 

ALTER TABLE `EVENTI` ADD CONSTRAINT `FKCREAZIONE_FK`
     FOREIGN KEY (`codiceStaff`)
     REFERENCES `MEMBRI`(`codiceStaff`);

ALTER TABLE `ISCRIZIONI` ADD CONSTRAINT `FKISC_EVE_FK`
     FOREIGN KEY (`codiceEvento`)
     REFERENCES `EVENTI`(`codiceEvento`);

ALTER TABLE `ISCRIZIONI` ADD CONSTRAINT `FKR_1_FK`
     FOREIGN KEY (`codiceCliente`)
     REFERENCES `CLIENTI`(`codiceCliente`);

ALTER TABLE `TIPOLOGIE`
ADD CONSTRAINT `FK_TIPOLOGIE_LETTINO`
FOREIGN KEY (`codiceLettino`) REFERENCES `LETTINI`(`codiceLettino`);

ALTER TABLE `LISTINI` ADD CONSTRAINT `FKANALIZZAZIONE_FK`
     FOREIGN KEY (`codiceStaff`)
     REFERENCES `AMMINISTRATORI`(`codiceStaff`);

ALTER TABLE `MEMBRI` ADD CONSTRAINT `FKR_FK`
     FOREIGN KEY (`IdTurno`)
     REFERENCES `TURNI_DI_LAVORO`(`IdTurno`);

ALTER TABLE `TIPOLOGIE`
ADD CONSTRAINT `FK_TIPOLOGIE_OMBRELLONI`
FOREIGN KEY (`codiceOmbrellone`) REFERENCES `OMBRELLONI`(`codiceOmbrellone`);

ALTER TABLE `TIPOLOGIE`
ADD CONSTRAINT `FK_TIPOLOGIE_PEDALO`
FOREIGN KEY (`codicePedalò`) REFERENCES `PEDALO'`(`codicePedalò`); 

ALTER TABLE `TIPOLOGIE`
ADD CONSTRAINT `FK_TIPOLOGIE_PRENOTAZIONI`
FOREIGN KEY (`codicePrenotazione`) REFERENCES `PRENOTAZIONI`(`codicePrenotazione`); 

ALTER TABLE `VISUALIZZAZIONI`
ADD CONSTRAINT `FK_VISUALIZZAZIONI_PRENOTAZIONI`
FOREIGN KEY (`codicePrenotazione`) REFERENCES `PRENOTAZIONI`(`codicePrenotazione`); 

ALTER TABLE `PRENOTAZIONI` ADD CONSTRAINT `FKMEMORIZZAZIONE_FK`
     FOREIGN KEY (`mese`)
     REFERENCES `LISTINI`(`mese`);

ALTER TABLE `RECENSIONI` ADD CONSTRAINT `FKRIFERIMENTO_FK`
     FOREIGN KEY (`codiceStaff`)
     REFERENCES `MEMBRI`(`codiceStaff`);

ALTER TABLE `RECENSIONI` ADD CONSTRAINT `FKCOMPOSIZIONE_FK`
     FOREIGN KEY (`mese`)
     REFERENCES `STORICO_RECENSIONI`(`mese`);

ALTER TABLE `STORICO_RECENSIONI` ADD CONSTRAINT `FKOSSERVAZIONE_FK`
     FOREIGN KEY (`codiceStaff`)
     REFERENCES `AMMINISTRATORI`(`codiceStaff`);

ALTER TABLE `TIPOLOGIE`
ADD CONSTRAINT `FK_TIPOLOGIE_TAVOLI`
FOREIGN KEY (`numeroTavolo`) REFERENCES `TAVOLI`(`numeroTavolo`); 


ALTER TABLE `TURNI_DI_LAVORO` ADD CONSTRAINT `FKSALVATAGGIO_FK`
     FOREIGN KEY (`mese`)
     REFERENCES `AGENDE_DEI_TURNI`(`mese`);
                  
ALTER TABLE `MEMBRI`
ADD CONSTRAINT `FK_MEMBRI_TURNI_DI_LAVORO`
FOREIGN KEY (`IdTurno`) REFERENCES `TURNI_DI_LAVORO`(`IdTurno`);

ALTER TABLE `VISUALIZZAZIONI` ADD CONSTRAINT `FKVIS_MEM`
     FOREIGN KEY (`codiceStaff`)
     REFERENCES `MEMBRI`(`codiceStaff`);

ALTER TABLE `VISUALIZZAZIONI` ADD CONSTRAINT `FKVIS_PRE_FK`
     FOREIGN KEY (`codicePrenotazione`)
     REFERENCES `PRENOTAZIONI`(`codicePrenotazione`);


-- Index Section
-- _____________ 

CREATE UNIQUE INDEX `ID_AGENDA_DEI_TURNI_IND`
     ON `AGENDE_DEI_TURNI` (`mese`);

CREATE INDEX `FKCONSULTAZIONE_IND`
     ON `AGENDE_DEI_TURNI` (`codiceStaff`);

CREATE UNIQUE INDEX `ID_AMMINISTRATORE_IND`
     ON `AMMINISTRATORI` (`codiceStaff`);

CREATE UNIQUE INDEX `ID_EVENTO_IND`
     ON `EVENTI` (`codiceEvento`);

CREATE INDEX `FKCREAZIONE_IND`
     ON `EVENTI` (`codiceStaff`);

CREATE INDEX `FKISC_EVE_IND`
     ON `ISCRIZIONI` (`codiceEvento`);

CREATE UNIQUE INDEX `ID_LETTINO_IND`
     ON `LETTINI` (`codiceLettino`);

CREATE UNIQUE INDEX `ID_LISTINO_IND`
     ON `LISTINI` (`mese`);

CREATE INDEX `FKANALIZZAZIONE_IND`
     ON `LISTINI` (`codiceStaff`);

CREATE UNIQUE INDEX `ID_MEMBRO_IND`
     ON `MEMBRI` (`codiceStaff`);

-- OMBRELLONI
CREATE UNIQUE INDEX `ID_OMBRELLONE_IND`
     ON `OMBRELLONI` (`codiceOmbrellone`);

-- PEDALO
CREATE UNIQUE INDEX `ID_PEDALO__IND`
     ON `PEDALO'` (`codicePedalò`);

-- PRENOTAZIONI
CREATE UNIQUE INDEX `ID_PRENOTAZIONE_IND`
     ON `PRENOTAZIONI` (`codicePrenotazione`);

CREATE INDEX `FKMEMORIZZAZIONE_IND`
     ON `PRENOTAZIONI` (`mese`);

-- RECENSIONI
CREATE INDEX `FKRIFERIMENTO_IND`
     ON `RECENSIONI` (`codiceStaff`);

CREATE INDEX `FKCOMPOSIZIONE_IND`
     ON `RECENSIONI` (`mese`);

-- STORICO_RECENSIONI
CREATE UNIQUE INDEX `ID_STORICO_RECENSIONI_IND`
     ON `STORICO_RECENSIONI` (`mese`);

CREATE INDEX `FKOSSERVAZIONE_IND`
     ON `STORICO_RECENSIONI` (`codiceStaff`);

-- TAVOLI
CREATE UNIQUE INDEX `ID_TAVOLO_IND`
     ON `TAVOLI` (`numeroTavolo`);

-- TIPOLOGIE
CREATE INDEX `FKTIP_PRE_IND`
     ON `TIPOLOGIE` (`codicePrenotazione`);

-- TURNI_DI_LAVORO
CREATE INDEX `FKSALVATAGGIO_IND`
     ON `TURNI_DI_LAVORO` (`mese`);

-- VISUALIZZAZIONI
CREATE INDEX `FKVIS_PRE_IND`
     ON `VISUALIZZAZIONI` (`codicePrenotazione`);

