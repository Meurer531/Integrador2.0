CREATE TABLE USUARIO(
    id_usuario SERIAL PRIMARY KEY,
    loginUsuario VARCHAR(255),
    senha VARCHAR(255),
    email VARCHAR(255),
    telefone INT,
    tipo CHAR
);


DROP TABLE USUARIO
SELECT * FROM USUARIO