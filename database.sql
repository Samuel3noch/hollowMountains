CREATE DATABASE IF NOT EXISTS hollowdata;

USE hollowdata;

CREATE TABLE attracties (
    id INT AUTO_INCREMENT PRIMARY KEY,
    naam VARCHAR(255) NOT NULL,
    type VARCHAR(255),
    capaciteit INT,
    bouwjaar YEAR,
    laatste_onderhoud DATE
);

CREATE TABLE onderhoudsschema (
    id INT AUTO_INCREMENT PRIMARY KEY,
    attractie_id INT,
    onderhoud_datum DATE NOT NULL,
    onderhoud_type VARCHAR(255),
    uitgevoerd BOOLEAN DEFAULT FALSE,
    FOREIGN KEY (attractie_id) REFERENCES attracties(id)
);
