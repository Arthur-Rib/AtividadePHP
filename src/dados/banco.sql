CREATE TABLE usuarios(
    id INTEGER PRIMARY KEY AUTOINCREMENT,
    username VARCHAR(255) NOT NULL UNIQUE,
    email VARCHAR(255) NOT NULL UNIQUE,
    nome_completo VARCHAR(255) NOT NULL,
    senha VARCHAR(255) NOT NULL,
)