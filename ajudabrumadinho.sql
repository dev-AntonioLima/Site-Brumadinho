
DROP DATABASE IF EXISTS brumadinhoajuda;

CREATE DATABASE brumadinhoajuda CHARACTER SET utf8 COLLATE utf8_general_ci;

USE brumadinhoajuda;

CREATE TABLE contatos (
    id INT(11) UNSIGNED AUTO_INCREMENT PRIMARY KEY NOT NULL,
    data TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
    nome VARCHAR(255) NOT NULL,
    email VARCHAR(255) NOT NULL,
	assunto VARCHAR(255) NOT NULL,
    mensagem TEXT NOT NULL,
    status ENUM('recebido', 'lido', 'respondido', 'apagado') DEFAULT 'recebido'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;


CREATE TABLE noticias (
  id int(11) UNSIGNED AUTO_INCREMENT PRIMARY KEY NOT NULL,
  data TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
  categorias varchar(255),
  titulo varchar(255) NOT NULL,
  thumbnail varchar(255) NOT NULL,
  chamada varchar(255) NOT NULL,
  autor_nome varchar(255) NOT NULL,
  autor_email varchar(255) NOT NULL,
  autor_site varchar(255) NOT NULL,
  html longtext NOT NULL,
  visitas bigint(20) NOT NULL,
  status enum('ativo','apagado') NOT NULL DEFAULT 'ativo'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

