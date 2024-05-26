SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";

DROP DATABASE IF EXISTS `bank_db`;
CREATE DATABASE bank_db;

USE bank_db;

CREATE TABLE `Brrowers` (
  `id` INT(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
  `taxID` VARCHAR(12) NOT NULL,
  `entityType` TEXT NOT NULL,
  `addressName` TEXT NOT NULL,
  `amount` INT NOT NULL,
  `conditions` TEXT NOT NULL,
  `legalNotes` TEXT,
  `contractsList` TEXT,
);

INSERT INTO `Brrowers` (`taxID`, `entityType`, `addressName`, `amount`, `conditions`, `legalNotes`, `contractsList`) VALUES
('12345678922', 'Физ. лицо', 'г. Омск ул. 2-я Поселковая 12', '100000', 'Условия...', 'Юр. примечания...', 'Документы...'),
('80987654321', 'Юр. лицо', 'г. Санкт-Петербург ул. Звездная 14', '1200000', 'Условия...', 'Юр. примечания...', 'Документы...'),
('10293848576', 'Юр. лицо', 'г. Омск ул. Ленина 17', '2000000', 'Условия...', 'Юр. примечания...', 'Документы...'),
('91028475611', 'Физ. лицо', 'г. Москва ул. Ленсовета 22', '50000', 'Условия...', 'Юр. примечания...', 'Документы...'),
('12345098765', 'Юр. лицо', 'г. Санкт-Петербург ул. Взлетная 5', '6000000', 'Условия...', 'Юр. примечания...', 'Документы...');

COMMIT;
