CREATE TABLE USUARIO(
    id_usuario SERIAL PRIMARY KEY,
    loginUsuario VARCHAR(255),
    senha VARCHAR(255),
    email VARCHAR(255),
    telefone INT,
    tipo CHAR
);

CREATE TABLE PRODUTOS(
    id_produto SERIAL PRIMARY KEY,
    url_imgProd VARCHAR(255),
    nome VARCHAR(255),
    preco NUMERIC(4,2),
    descricao VARCHAR,
	tipo CHAR
);

DROP TABLE USUARIO
SELECT * FROM PRODUTOS

INSERT INTO PRODUTOS(nome,preco,descricao,tipo) VALUES ('vassoura',24.67,'Foda','C')