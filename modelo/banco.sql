CREATE SCHEMA IF NOT EXISTS aulaPHPmysql;

USE aulaPHPmysql;

CREATE TABLE
    IF NOT EXISTS aulaPHPmysql.Cliente (
        idCliente INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
        nome VARCHAR(128),
        email VARCHAR(45),
        senha VARCHAR(45),
        nascimento DATE,
        salario FLOAT
    );