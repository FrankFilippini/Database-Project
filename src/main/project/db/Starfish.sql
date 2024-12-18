-- Database Section
-- ________________

DROP DATABASE IF EXISTS `Starfish`;
CREATE DATABASE `Starfish` DEFAULT CHARACTER SET 'utf8mb4' COLLATE 'utf8mb4_bin';
USE `Starfish`;

-- Tables Section
-- ________________

CREATE TABLE `AGENDE_DEI_TURNI` (
     `codiceStaff` INT UNSIGNED NOT NULL, 
     `idTurno` INT UNSIGNED NOT NULL,
     `dataTurno` DATE NOT NULL, 
     `codiceAmministratore` INT UNSIGNED NOT NULL,
     CONSTRAINT `ID_AGENDA_DEI_TURNI_PK` PRIMARY KEY (`codiceStaff` , `dataTurno`));

CREATE TABLE `AMMINISTRATORI` (
     `codiceAmministratore` INT UNSIGNED NOT NULL,
     `CF` VARCHAR(50) NOT NULL,
     `nome` VARCHAR(50) NOT NULL DEFAULT '',
     `cognome` VARCHAR(50) NOT NULL DEFAULT '',
     `email` VARCHAR(50) UNIQUE DEFAULT NULL,
     `password` VARCHAR(25) NOT NULL,
     CONSTRAINT `ID_AMMINISTRATORE_PK` PRIMARY KEY (`codiceAmministratore`));

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
     `dataInizio` DATE NOT NULL,
     `dataFine` DATE NOT NULL,
     `numeroPosti` INT UNSIGNED,
     `codiceStaff` INT UNSIGNED NOT NULL,
     -- `tipoEvento` ENUM('serata', 'torneo') NOT NULL,
     `tipoEvento` VARCHAR(50) NOT NULL,
     `nomeEvento` VARCHAR(50) NOT NULL,
     CONSTRAINT `ID_EVENTO_PK` PRIMARY KEY (`codiceEvento`));

CREATE TABLE `ISCRIZIONI` (
     `codiceEvento` INT UNSIGNED NOT NULL,
     `codiceCliente` INT UNSIGNED NOT NULL,
     CONSTRAINT `ID_ISCRIZIONI_PK` PRIMARY KEY (`codiceEvento`, `codiceCliente`));

CREATE TABLE `LETTINI` (
     `codiceLettino` INT UNSIGNED NOT NULL AUTO_INCREMENT,
     CONSTRAINT `ID_LETTINO_PK` PRIMARY KEY (`codiceLettino`));

CREATE TABLE `LISTINI` (
     `mese` INT UNSIGNED NOT NULL CHECK (`mese` BETWEEN 1 AND 12), 
     `codiceAmministratore` INT UNSIGNED NOT NULL,
     CONSTRAINT `ID_LISTINO_PK` PRIMARY KEY (`mese`));

CREATE TABLE `MEMBRI` (
    `CF` VARCHAR(50) NOT NULL,
    `codiceStaff` INT UNSIGNED NOT NULL AUTO_INCREMENT,
    `nome` VARCHAR(50) NOT NULL DEFAULT '',
    `cognome` VARCHAR(50) NOT NULL DEFAULT '',
    `email` VARCHAR(50) UNIQUE DEFAULT NULL,
    `password` VARCHAR(25) NOT NULL,
    CONSTRAINT `ID_MEMBRO_PK` PRIMARY KEY (`codiceStaff`)); 

CREATE TABLE `OMBRELLONI` (
     `codiceOmbrellone` INT UNSIGNED NOT NULL AUTO_INCREMENT,
     CONSTRAINT `ID_OMBRELLONE_PK` PRIMARY KEY (`codiceOmbrellone`));

CREATE TABLE `PEDALO` (
     `codicePedalò` INT UNSIGNED NOT NULL AUTO_INCREMENT,
     CONSTRAINT `ID_PEDALO_PK` PRIMARY KEY (`codicePedalò`));

CREATE TABLE `PRENOTAZIONI` (
     `dataInizio` DATE NOT NULL,
     `dataFine` DATE NOT NULL,
     `codicePrenotazione` INT UNSIGNED NOT NULL AUTO_INCREMENT,
     `codiceCliente` INT UNSIGNED NOT NULL,
     `mese` INT UNSIGNED NOT NULL CHECK (`mese` BETWEEN 1 AND 12),
     CONSTRAINT `ID_PRENOTAZIONE_PK` PRIMARY KEY (`codicePrenotazione`));

CREATE TABLE `RECENSIONI` (
     `codiceRecensione` INT UNSIGNED NOT NULL AUTO_INCREMENT,
     `codiceCliente` INT UNSIGNED NOT NULL,
     `valutazione` INT UNSIGNED,
     `codiceStaff` INT UNSIGNED NOT NULL,
     `mese` INT UNSIGNED NOT NULL CHECK (`mese` BETWEEN 1 AND 12),
     CONSTRAINT `ID_RECENSIONI_PK` PRIMARY KEY (`codiceRecensione`),
     CONSTRAINT `FKR_ID` UNIQUE (`codiceCliente`, `codiceStaff`));     /* Un cliente può fare una sola recensione ad uno stesso membro. */

CREATE TABLE `STORICO_RECENSIONI` (
     `mese` INT UNSIGNED NOT NULL CHECK (`mese` BETWEEN 1 AND 12),
     `codiceAmministratore` INT UNSIGNED NOT NULL,
     CONSTRAINT `ID_STORICO_RECENSIONI_PK` PRIMARY KEY (`mese`));

CREATE TABLE `TAVOLI` (
     `numeroTavolo` INT UNSIGNED NOT NULL AUTO_INCREMENT,
     `numeroPersone` INT UNSIGNED NOT NULL,
     CONSTRAINT `ID_TAVOLO_PK` PRIMARY KEY (`numeroTavolo`));

CREATE TABLE `TIPOLOGIE` (
    `codiceTipologia` INT UNSIGNED NOT NULL AUTO_INCREMENT,
    `codicePrenotazione` INT UNSIGNED NOT NULL,
    `codiceOmbrellone` INT UNSIGNED DEFAULT NULL,
    `codiceLettino` INT UNSIGNED DEFAULT NULL,
    `numeroTavolo` INT UNSIGNED DEFAULT NULL,
    `codicePedalò` INT UNSIGNED DEFAULT NULL,
    CONSTRAINT `ID_TIPOLOGIE_PK` PRIMARY KEY (`codiceTipologia`)
);

CREATE TABLE `TURNI_DI_LAVORO` (
     `idTurno` INT UNSIGNED NOT NULL AUTO_INCREMENT,
     `oraInizio` TIME NOT NULL,
     `oraFine` TIME NOT NULL,
     CONSTRAINT `ID_TURNI_DI_LAVORO_PK` PRIMARY KEY (`idTurno`));

-- CONSTRAINTs Section
-- ___________________ 

ALTER TABLE `AGENDE_DEI_TURNI` ADD CONSTRAINT `TURNI_DI_LAVORO_FK`
     FOREIGN KEY (`idTurno`)
     REFERENCES `TURNI_DI_LAVORO`(`idTurno`);

ALTER TABLE `AGENDE_DEI_TURNI` ADD CONSTRAINT `CONSULTAZIONE_FK`
     FOREIGN KEY (`codiceAmministratore`)
     REFERENCES `AMMINISTRATORI`(`codiceAmministratore`);

ALTER TABLE `AGENDE_DEI_TURNI` ADD CONSTRAINT `MEMBRI_FK`
     FOREIGN KEY (`codiceStaff`)
     REFERENCES `MEMBRI`(`codiceStaff`);

ALTER TABLE `ISCRIZIONI`
ADD CONSTRAINT `FK_ISCRIZIONI_CLIENTI`
FOREIGN KEY (`codiceCliente`) REFERENCES `CLIENTI`(`codiceCliente`);

ALTER TABLE `PRENOTAZIONI`
ADD CONSTRAINT `FK_PRENOTAZIONI_CLIENTI`
FOREIGN KEY (`codiceCliente`) REFERENCES `CLIENTI`(`codiceCliente`); 

ALTER TABLE `RECENSIONI`
ADD CONSTRAINT `FK_RECENSIONI_CLIENTI`
FOREIGN KEY (`codiceCliente`) REFERENCES `CLIENTI`(`codiceCliente`); 

ALTER TABLE `EVENTI` ADD CONSTRAINT `CREAZIONE_FK`
     FOREIGN KEY (`codiceStaff`)
     REFERENCES `MEMBRI`(`codiceStaff`);

ALTER TABLE `ISCRIZIONI` ADD CONSTRAINT `ISC_EVE_FK`
     FOREIGN KEY (`codiceEvento`)
     REFERENCES `EVENTI`(`codiceEvento`);

ALTER TABLE `TIPOLOGIE`
ADD CONSTRAINT `FK_TIPOLOGIE_LETTINO`
FOREIGN KEY (`codiceLettino`) REFERENCES `LETTINI`(`codiceLettino`);

ALTER TABLE `LISTINI` ADD CONSTRAINT `ANALIZZAZIONE_FK`
     FOREIGN KEY (`codiceAmministratore`)
     REFERENCES `AMMINISTRATORI`(`codiceAmministratore`);

ALTER TABLE `TIPOLOGIE`
ADD CONSTRAINT `FK_TIPOLOGIE_OMBRELLONI`
FOREIGN KEY (`codiceOmbrellone`) REFERENCES `OMBRELLONI`(`codiceOmbrellone`);

ALTER TABLE `TIPOLOGIE`
ADD CONSTRAINT `FK_TIPOLOGIE_PEDALO`
FOREIGN KEY (`codicePedalò`) REFERENCES `PEDALO`(`codicePedalò`); 

ALTER TABLE `TIPOLOGIE`
ADD CONSTRAINT `FK_TIPOLOGIE_PRENOTAZIONI`
FOREIGN KEY (`codicePrenotazione`) REFERENCES `PRENOTAZIONI`(`codicePrenotazione`);

ALTER TABLE `PRENOTAZIONI` ADD CONSTRAINT `MEMORIZZAZIONE_FK`
     FOREIGN KEY (`mese`)
     REFERENCES `LISTINI`(`mese`);

ALTER TABLE `RECENSIONI` ADD CONSTRAINT `RIFERIMENTO_FK`
     FOREIGN KEY (`codiceStaff`)
     REFERENCES `MEMBRI`(`codiceStaff`);

ALTER TABLE `RECENSIONI` ADD CONSTRAINT `COMPOSIZIONE_FK`
     FOREIGN KEY (`mese`)
     REFERENCES `STORICO_RECENSIONI`(`mese`);

ALTER TABLE `STORICO_RECENSIONI` ADD CONSTRAINT `OSSERVAZIONE_FK`
     FOREIGN KEY (`codiceAmministratore`)
     REFERENCES `AMMINISTRATORI`(`codiceAmministratore`);

ALTER TABLE `TIPOLOGIE`
ADD CONSTRAINT `FK_TIPOLOGIE_TAVOLI`
FOREIGN KEY (`numeroTavolo`) REFERENCES `TAVOLI`(`numeroTavolo`); 

-- Index Section
-- _____________ 

CREATE UNIQUE INDEX `ID_AGENDA_DEI_TURNI_IND`
     ON `AGENDE_DEI_TURNI` (`codiceStaff` , `dataTurno`);

CREATE INDEX `FKCONSULTAZIONE_IND`
     ON `AGENDE_DEI_TURNI` (`codiceAmministratore`);

CREATE INDEX `FKMEMBRI_IND`
     ON `AGENDE_DEI_TURNI` (`codiceStaff`);

CREATE UNIQUE INDEX `ID_AMMINISTRATORE_IND`
     ON `AMMINISTRATORI` (`codiceAmministratore`);

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
     ON `LISTINI` (`codiceAmministratore`);

CREATE UNIQUE INDEX `ID_MEMBRO_IND`
     ON `MEMBRI` (`codiceStaff`);

-- OMBRELLONI
CREATE UNIQUE INDEX `ID_OMBRELLONE_IND`
     ON `OMBRELLONI` (`codiceOmbrellone`);

-- PEDALO
CREATE UNIQUE INDEX `ID_PEDALO_IND`
     ON `PEDALO` (`codicePedalò`);

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
     ON `STORICO_RECENSIONI` (`codiceAmministratore`);

-- TAVOLI
CREATE UNIQUE INDEX `ID_TAVOLO_IND`
     ON `TAVOLI` (`numeroTavolo`);

-- TIPOLOGIE
CREATE UNIQUE INDEX `ID_TIPO_IND`
     ON `TIPOLOGIE` (`codiceTipologia`);
