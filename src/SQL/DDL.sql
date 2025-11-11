CREATE DATABASE trackItAdm;

USE trackItAdm;

CREATE TABLE administradores (
	id INT AUTO_INCREMENT PRIMARY KEY,
    nome VARCHAR(255) NOT NULL,
    email VARCHAR(255) NOT NULL UNIQUE,
    senha VARCHAR(255) NOT NULL
);

CREATE TABLE proprietario (
    idUsuario INT AUTO_INCREMENT PRIMARY KEY,
    nomeCompleto VARCHAR(255),
    email VARCHAR(255) NOT NULL UNIQUE,
    senha VARCHAR(255) NOT NULL
);

CREATE TABLE arduino(
    codArduino VARCHAR(30) PRIMARY KEY NOT NULL UNIQUE
);

CREATE TABLE veiculos(
    idVeiculo INT AUTO_INCREMENT PRIMARY KEY,
    placa VARCHAR(7) NOT NULL,
    modelo VARCHAR(255) NOT NULL,
    idProprietario INT,
    codArduino VARCHAR(30),
    FOREIGN KEY (idProprietario) REFERENCES proprietario(idUsuario),
    FOREIGN KEY (codArduino) REFERENCES arduino(codArduino)
);