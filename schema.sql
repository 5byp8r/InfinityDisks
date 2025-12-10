-- criacao do banco (se necessário)
-- da pra colar isso no phpadmin
CREATE DATABASE IF NOT EXISTS db_web_loja CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
USE db_web_loja;

-- tabela produtos
CREATE TABLE IF NOT EXISTS cds (
    id INT AUTO_INCREMENT PRIMARY KEY,
    descricao VARCHAR(255) NOT NULL,
    categoria VARCHAR(100) NOT NULL,
    tipo ENUM('vinil','cd') NOT NULL DEFAULT 'vinil',
    musicas VARCHAR(2000) NOT NULL,
    estoque INT NOT NULL DEFAULT 0,
    preco DECIMAL(10,2) NOT NULL DEFAULT 0.00,
    data_cadastro DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- tabela usuarios
CREATE TABLE IF NOT EXISTS usuarios (
    id INT AUTO_INCREMENT PRIMARY KEY,
    tipo ENUM('user','admin') NOT NULL DEFAULT 'user',
    nome VARCHAR(150) NOT NULL,
    email VARCHAR(150) NOT NULL UNIQUE,
    senha VARCHAR(255) NOT NULL,
    data_criacao DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- CREATE TABLE IF NOT EXISTS vendas (
--     id INT AUTO_INCREMENT PRIMARY KEY,
--     tipo ENUM('user','admin') NOT NULL DEFAULT 'user',
--     nome VARCHAR(150) NOT NULL,
--     email VARCHAR(150) NOT NULL UNIQUE,
--     senha VARCHAR(255) NOT NULL,
--     data_criacao DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP
-- ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- CREATE TABLE IF NOT EXISTS itemVendas (
--     id INT AUTO_INCREMENT PRIMARY KEY,
--     tipo ENUM('user','admin') NOT NULL DEFAULT 'user',
--     nome VARCHAR(150) NOT NULL,
--     email VARCHAR(150) NOT NULL UNIQUE,
--     senha VARCHAR(255) NOT NULL,
--     data_criacao DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP
-- ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- (Opcional) inserção de exemplo
INSERT INTO cds (descricao, categoria, tipo, musicas, estoque, preco)
VALUES
('Vinil - Álbum Exemplo', 'Rock', 'vinil', 'Música 1 - Música 2 - Música 3', 5, 89.90),
('CD - Single Teste', 'Pop', 'cd', 'Música 1 - Música 2 - Música 3 - Música 4 - Música 5', 10, 29.90);
