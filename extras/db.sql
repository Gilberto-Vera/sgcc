-- -----------------------------------------------------
-- Table "pessoa"
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS "pessoa" (
  "id" SERIAL NOT NULL,
  "nome" VARCHAR(100) NOT NULL,
  "email" VARCHAR(45) NOT NULL,
  "senha" VARCHAR(80) NOT NULL,
  "ativo" BOOLEAN NOT NULL,
  PRIMARY KEY ("id"))
;

CREATE UNIQUE INDEX IF NOT EXISTS "email_UNIQUE1" ON "pessoa" ("email" ASC);

-- -----------------------------------------------------
-- Table "administrador"
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS "administrador" (
  "id" SERIAL NOT NULL,
  "pessoa_id" INT NOT NULL,
  PRIMARY KEY ("id"),
  CONSTRAINT "fk_administrador_pessoa"
    FOREIGN KEY ("pessoa_id")
      REFERENCES "pessoa" ("id"))
;


-- -----------------------------------------------------
-- Table "cliente"
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS "cliente" (
  "id" SERIAL NOT NULL,
  "pessoa_id" INT NOT NULL,
  "endereco" VARCHAR(100) NOT NULL,
  "cpf" VARCHAR(45) NULL,
  PRIMARY KEY ("id"),
  CONSTRAINT "fk_cliente_pessoa"
    FOREIGN KEY ("pessoa_id")
      REFERENCES "pessoa" ("id"))
;


-- -----------------------------------------------------
-- Table "evento"
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS "evento" (
  "id" SERIAL NOT NULL,
  "nome" VARCHAR(45) NOT NULL,
  "data" TIMESTAMP NOT NULL,
  "num_convidados" INT NOT NULL,
  PRIMARY KEY ("id"))
;


-- -----------------------------------------------------
-- Table "cliente_evento"
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS "cliente_evento" (
  "id" SERIAL NOT NULL,
  "cliente_id" INT NOT NULL,
  "evento_id" INT NOT NULL,
  PRIMARY KEY ("id"),
  CONSTRAINT "fk_cliente_evento_cliente"
    FOREIGN KEY ("cliente_id")
      REFERENCES "cliente" ("id"),
  CONSTRAINT "fk_cliente_evento_evento"
    FOREIGN KEY ("evento_id")
      REFERENCES "evento" ("id"))
;


-- -----------------------------------------------------
-- Table "convidado"
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS "convidado" (
  "id" SERIAL NOT NULL,
  "nome" VARCHAR(45) NOT NULL,
  "num_acompanhantes" INT NOT NULL,
  "email" VARCHAR(45) NOT NULL,
  PRIMARY KEY ("id"))
;

CREATE UNIQUE INDEX IF NOT EXISTS "email_UNIQUE2" ON "convidado" ("email" ASC);

-- -----------------------------------------------------
-- Table "convidado_evento"
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS "convidado_evento" (
  "id" SERIAL NOT NULL,
  "evento_id" INT NOT NULL,
  "convidado_id" INT NOT NULL,
  "situacao" BOOLEAN NOT NULL,
  PRIMARY KEY ("id"),
  CONSTRAINT "fk_convidado_evento_evento"
    FOREIGN KEY ("evento_id")
      REFERENCES "evento" ("id"),
  CONSTRAINT "fk_convidado_evento_convidado"
    FOREIGN KEY ("convidado_id")
      REFERENCES "convidado" ("id"))
;


-- -----------------------------------------------------
-- Table "fornecedor"
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS "fornecedor" (
  "id" SERIAL NOT NULL,
  "cnpj" VARCHAR(18) NULL,
  "razao_social" VARCHAR(100) NULL,
  "nome_fantasia" VARCHAR(45) NOT NULL,
  "endereco" VARCHAR(100) NOT NULL,
  "Contato" VARCHAR(45) NOT NULL,
  "email" VARCHAR(45) NOT NULL,
  PRIMARY KEY ("id"))
;

CREATE UNIQUE INDEX IF NOT EXISTS "cnpj_UNIQUE" ON "fornecedor" ("cnpj" ASC);
CREATE UNIQUE INDEX IF NOT EXISTS "email_UNIQUE3" ON "fornecedor" ("email" ASC);


-- -----------------------------------------------------
-- Table "log"
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS "log" (
  "id" SERIAL NOT NULL,
  "usuario" VARCHAR(45) NOT NULL,
  "data" TIMESTAMP NOT NULL,
  "acao" TEXT NOT NULL,
  PRIMARY KEY ("id"))
;


-- -----------------------------------------------------
-- Table "modelo_roteiro"
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS "modelo_roteiro" (
  "id" SERIAL NOT NULL,
  "nome" VARCHAR(45) NOT NULL,
  "horario" VARCHAR(15) NULL,
  PRIMARY KEY ("id"))
;


-- -----------------------------------------------------
-- Table "modelo_sequencia"
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS "modelo_sequencia" (
  "id" SERIAL NOT NULL,
  "modelo_roteiro_id" INT NOT NULL,
  "descricao" VARCHAR(45) NOT NULL,
  "ordem" INT NOT NULL,
  "observacao" TEXT NULL,
  PRIMARY KEY ("id"),
  CONSTRAINT "fk_modelo_sequencia_modelo_roteiro"
    FOREIGN KEY ("modelo_roteiro_id")
      REFERENCES "modelo_roteiro" ("id"))
;

CREATE UNIQUE INDEX IF NOT EXISTS "ordem_UNIQUE1" ON "modelo_sequencia" ("ordem" ASC);

-- -----------------------------------------------------
-- Table "servico"
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS "servico" (
  "id" SERIAL NOT NULL,
  "servico" VARCHAR(40) NOT NULL,
  PRIMARY KEY ("id"))
;


-- -----------------------------------------------------
-- Table "parceiro"
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS "parceiro" (
  "id" SERIAL NOT NULL,
  "evento_id" INT NOT NULL,
  "fornecedor_id" INT NOT NULL,
  "servico_id" INT NOT NULL,
  "num_colaboradores" INT NOT NULL,
  "situacao" BOOLEAN NOT NULL,
  PRIMARY KEY ("id"),
  CONSTRAINT "fk_parceiro_evento"
    FOREIGN KEY ("evento_id")
      REFERENCES "evento" ("id"),
  CONSTRAINT "fk_parceiro_fornecedor"
    FOREIGN KEY ("fornecedor_id")
      REFERENCES "fornecedor" ("id"),
  CONSTRAINT "fk_parceiro_servico"
    FOREIGN KEY ("servico_id")
      REFERENCES "servico" ("id"))
;


-- -----------------------------------------------------
-- Table "roteiro"
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS "roteiro" (
  "id" SERIAL NOT NULL,
  "evento_id" INT NOT NULL,
  "nome" VARCHAR(45) NOT NULL,
  "horario" VARCHAR(15) NULL,
  "situacao" BOOLEAN NOT NULL,
  PRIMARY KEY ("id"),
  CONSTRAINT "fk_roteiro_evento"
    FOREIGN KEY ("evento_id")
      REFERENCES "evento" ("id"))
;


-- -----------------------------------------------------
-- Table "sequencia"
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS "sequencia" (
  "id" SERIAL NOT NULL,
  "roteiro_id" INT NOT NULL,
  "descricao" VARCHAR(45) NOT NULL,
  "ordem" INT NOT NULL,
  "observacao" TEXT NULL,
  PRIMARY KEY ("id"),
  CONSTRAINT "fk_sequencia_roteiro"
    FOREIGN KEY ("roteiro_id")
      REFERENCES "roteiro" ("id"))
;

CREATE UNIQUE INDEX IF NOT EXISTS "ordem_UNIQUE2" ON "sequencia" ("ordem" ASC);


-- -----------------------------------------------------
-- Table "servico_fornecedor"
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS "servico_fornecedor" (
  "id" SERIAL NOT NULL,
  "fornecedor_id" INT NOT NULL,
  "servico_id" INT NOT NULL,
  "principal" BOOLEAN NOT NULL,
  PRIMARY KEY ("id"),
  CONSTRAINT "fk_servico_fornecedor_servico"
    FOREIGN KEY ("servico_id")
      REFERENCES "servico" ("id"),
  CONSTRAINT "fk_servico_fornecedor_fornecedor"
    FOREIGN KEY ("fornecedor_id")
      REFERENCES "fornecedor" ("id"))
;


-- -----------------------------------------------------
-- Table "situacao"
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS "situacao" (
  "id" SERIAL NOT NULL,
  "evento_id" INT NOT NULL,
  "nome" VARCHAR(45) NOT NULL,
  "observacao" TEXT NULL,
  PRIMARY KEY ("id"),
  CONSTRAINT "fk_situacao_evento"
    FOREIGN KEY ("evento_id")
      REFERENCES "evento" ("id"))
;


-- -----------------------------------------------------
-- Table "telefone_convidado"
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS "telefone_convidado" (
  "id" SERIAL NOT NULL,
  "convidado_id" INT NOT NULL,
  "telefone" VARCHAR(14) NOT NULL,
  "principal" BOOLEAN NOT NULL,
  PRIMARY KEY ("id"),
  CONSTRAINT "fk_telefone_convidado_convidado"
    FOREIGN KEY ("convidado_id")
      REFERENCES "convidado" ("id"))
;


-- -----------------------------------------------------
-- Table "telefone_fornecedor"
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS "telefone_fornecedor" (
  "id" SERIAL NOT NULL,
  "fornecedor_id" INT NOT NULL,
  "descricao" VARCHAR(45) NULL,
  "telefone" VARCHAR(14) NOT NULL,
  "principal" BOOLEAN NOT NULL,
  PRIMARY KEY ("id"),
  CONSTRAINT "fk_telefone_fornecedor_fornecedor"
    FOREIGN KEY ("fornecedor_id")
      REFERENCES "fornecedor" ("id"))
;


-- -----------------------------------------------------
-- Table "telefone_pessoa"
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS "telefone_pessoa" (
  "id" SERIAL NOT NULL,
  "pessoa_id" INT NOT NULL,
  "telefone" VARCHAR(14) NOT NULL,
  "principal" BOOLEAN NOT NULL,
  "descricao" VARCHAR(45) NULL,
  PRIMARY KEY ("id"),
  CONSTRAINT "fk_telefone_pessoa_pessoa"
    FOREIGN KEY ("pessoa_id")
      REFERENCES "pessoa" ("id"))
;


-- -----------------------------------------------------
-- Table "usuario"
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS "usuario" (
  "id" SERIAL NOT NULL,
  "pessoa_id" INT NOT NULL,
  "funcao" VARCHAR(45) NULL,
  PRIMARY KEY ("id"),
  CONSTRAINT "fk_usuario_pessoa"
    FOREIGN KEY ("pessoa_id")
      REFERENCES "pessoa" ("id"))
;


-- -----------------------------------------------------
-- Table "usuario_evento"
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS "usuario_evento" (
  "id" SERIAL NOT NULL,
  "usuario_id" INT NOT NULL,
  "evento_id" INT NOT NULL,
  PRIMARY KEY ("id"),
  CONSTRAINT "fk_usuario_evento_usuario"
    FOREIGN KEY ("usuario_id")
      REFERENCES "usuario" ("id"),
  CONSTRAINT "fk_usuario_evento_evento"
    FOREIGN KEY ("evento_id")
      REFERENCES "evento" ("id"))
;

CREATE OR REPLACE FUNCTION inserir_dados() RETURNS void AS
$$
BEGIN
  IF (SELECT COUNT(*) FROM pessoa) = 0 THEN
    -- -----------------------------------------------------
    -- Insert "administrador"
    -- -----------------------------------------------------
    INSERT INTO pessoa (id, nome, email, senha, ativo)
      VALUES (default, 'admin', 'admin@admin', 'admin', TRUE);

    INSERT INTO administrador (id, pessoa_id)
      VALUES (default, 1);

    -- -----------------------------------------------------
    -- Insert "cliente"
    -- -----------------------------------------------------
    INSERT INTO pessoa (id, nome, email, senha, ativo)
      VALUES (default, 'Garrett Winters', 'Accountant@seila.com', 63, TRUE),
        (default, 'Ashton Cox', 'Author@seila.com', 66, TRUE),
        (default, 'Cedric Kelly', 'Developer@seila.com', 22, TRUE),
        (default, 'Airi Satou', 'Senior@seila.com', 33, TRUE),
        (default, 'Brielle Williamson', 'Williamson@seila.com', 61, TRUE),
        (default, 'Herrod Chandler', 'Chandler@seila.com', 59, TRUE),
        (default, 'Rhona Davidson', 'Davidson@seila.com', 55, TRUE),
        (default, 'Colleen Hurst', 'Hurst@seila.com', 39, TRUE),
        (default, 'Sonya Frost', 'Frost@seila.com', 23, TRUE),
        (default, 'Jena Gaines', 'Gaines@seila.com', 30, TRUE),
        (default, 'Quinn Flynn', 'Flynn@seila.com', 24, TRUE),
        (default, 'Charde Marshall', 'Marshall@seila.com', 36, TRUE),
        (default, 'Haley Kennedy', 'Kennedy@seila.com', 43, TRUE),
        (default, 'Tatyana Fitzpatrick', 'Fitzpatrick@seila.com', 19, TRUE),
        (default, 'Michael Silva', 'Silva@seila.com', 66, TRUE),
        (default, 'Paul Byrd', 'Byrd@seila.com', 64, TRUE),
        (default, 'Gloria Little', 'Little@seila.com', 59, TRUE),
        (default, 'Bradley Greer', 'Greer@seila.com', 41, TRUE),
        (default, 'Dai Rios', 'Rios@seila.com', 35, TRUE),
        (default, 'Tiger Nixon', 'Edinburgh@seila.com', 61, TRUE)
    ;
    INSERT INTO cliente (id, pessoa_id, endereco, cpf)
      VALUES (default, 2, 'Garrett Winters Nª50 Accountant Seila', 12345676357),
        (default, 3, 'Ashton Cox Nª513 Author Seila', 68137485666),
        (default, 4, 'Cedric Kelly Nª134 Developer Seila', 22357135274),
        (default, 5, 'Airi Satou Nª5 Senior Seila', 55476271933),
        (default, 6, 'Brielle Williamson Nª183 Williamson Seila', 16781135761),
        (default, 7, 'Herrod Chandler Nª953 Chandler Seila', 15279665759),
        (default, 8, 'Rhona Davidson Nª937 Davidson Seila', 51235795165),
        (default, 9, 'Colleen Hurst Nª509 Hurst Seila', 57495314239),
        (default, 10, 'Sonya Frost Nª42 Frost Seila', 41357921523),
        (default, 11, 'Jena Gaines Nª153 Gaines Seila', 30125789461),
        (default, 12, 'Quinn Flynn Nº183 Flynn Seila', 27495314524),
        (default, 13, 'Charde Marshall Nº1358 Marshall Seila', 25679186336),
        (default, 14, 'Haley Kennedy Nº786 Kennedy Seila', 76219438443),
        (default, 15, 'Tatyana Fitzpatrick Nº275 Fitzpatrick Seila', 19296354891),
        (default, 16, 'Michael Silva Nº785 Silva Seila', 56348749166),
        (default, 17, 'Paul Byrd Nº63 Byrd Seila', 64521479863),
        (default, 18, 'Gloria Little Nº563 Little Seila', 55957419635),
        (default, 19, 'Bradley Greer Nº93 Greer Seila', 45315749511),
        (default, 20, 'Dai Rios Nº359 Rios Seila', 35897653154),
        (default, 21, 'Tiger Nixon Nº635 Edinburgh Seila', 63579421561)
    ;
    INSERT INTO telefone_pessoa (id, pessoa_id, telefone, principal, descricao)
      VALUES (default, 2, 995676357, TRUE, 'celular'),
        (default, 3, 937485666, TRUE, 'celular'),
        (default, 4, 957135274, TRUE, 'celular'),
        (default, 5, 976271933, TRUE, 'celular'),
        (default, 6, 981135761, TRUE, 'celular'),
        (default, 7, 979665759, TRUE, 'celular'),
        (default, 8, 935795165, TRUE, 'celular'),
        (default, 9, 995314239, TRUE, 'celular'),
        (default, 10, 957921523, TRUE, 'celular'),
        (default, 11, 925789461, TRUE, 'celular'),
        (default, 12, 995314524, TRUE, 'celular'),
        (default, 13, 979186336, TRUE, 'celular'),
        (default, 14, 919438443, TRUE, 'celular'),
        (default, 15, 996354891, TRUE, 'celular'),
        (default, 16, 948749166, TRUE, 'celular'),
        (default, 17, 921479863, TRUE, 'celular'),
        (default, 18, 957419635, TRUE, 'celular'),
        (default, 19, 915749511, TRUE, 'celular'),
        (default, 20, 997653154, TRUE, 'celular'),
        (default, 21, 979421561, TRUE, 'celular')
    ;

  END IF;

  IF (SELECT COUNT(*) FROM evento) = 0 THEN
    -- -----------------------------------------------------
    -- Insert "evento"
    -- -----------------------------------------------------
    INSERT INTO evento (id, nome, data, num_convidados)
      VALUES (default, 'Inicial', '1979-03-28 23:57:02', 1)
    ;
  END IF;

  IF (SELECT COUNT(*) FROM situacao) = 0 THEN
    -- -----------------------------------------------------
    -- Insert "situacao"
    -- -----------------------------------------------------
    INSERT INTO situacao (id, evento_id, nome, Observacao)
      VALUES (default, 1, 'Iniciado', ''),
        (default, 1, 'Confirmado', ''),
        (default, 1, 'Finalizado', ''),
        (default, 1, 'Bloqueado', ''),
        (default, 1, 'Cancelado', '')
    ;
  END IF;
END
$$ LANGUAGE plpgsql;

SELECT inserir_dados();

DROP FUNCTION inserir_dados;
