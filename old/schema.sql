-- criacao do banco (se necessário)
-- da pra colar isso no phpadmin
CREATE DATABASE IF NOT EXISTS db_web_loja CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
USE db_web_loja;

-- tabela produtos
CREATE TABLE IF NOT EXISTS produtos (
    id INT AUTO_INCREMENT PRIMARY KEY,
    descricao VARCHAR(255) NOT NULL,
    categoria VARCHAR(100) NOT NULL,
    tipo ENUM('vinil','cd') NOT NULL DEFAULT 'vinil',
    quantidade INT NOT NULL DEFAULT 0,
    preco DECIMAL(10,2) NOT NULL DEFAULT 0.00,
    data_cadastro DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- tabela usuarios
CREATE TABLE IF NOT EXISTS usuarios (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nome VARCHAR(150) NOT NULL,
    email VARCHAR(150) NOT NULL UNIQUE,
    senha VARCHAR(255) NOT NULL,
    data_criacao DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- (Opcional) inserção de exemplo
INSERT INTO produtos (descricao, categoria, tipo, quantidade, preco)
VALUES
('Vinil - Álbum Exemplo', 'Rock', 'vinil', 5, 89.90),
('CD - Single Teste', 'Pop', 'cd', 10, 29.90);
