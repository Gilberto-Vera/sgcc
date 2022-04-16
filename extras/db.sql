-- -----------------------------------------------------
-- Table "pessoa"
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS "pessoa" (
  "id" SERIAL NOT NULL,
  "nome" VARCHAR(100) NOT NULL,
  "email" VARCHAR(65) NOT NULL,
  "senha" VARCHAR(80) NOT NULL,
  "ativo" BOOLEAN NOT NULL,
  PRIMARY KEY ("id"))
;

CREATE UNIQUE INDEX IF NOT EXISTS "email_UNIQUE1" ON "pessoa" ("email" ASC);

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
  "observacao" TEXT NULL,
  "ativo" BOOLEAN NOT NULL,
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
  "email" VARCHAR(65) NOT NULL,
  PRIMARY KEY ("id"))
;

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
      REFERENCES "convidado" ("id")
      ON DELETE CASCADE)
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
  "contato" VARCHAR(45) NOT NULL,
  "email" VARCHAR(65) NOT NULL,
  "ativo" BOOLEAN NOT NULL,
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
  "hora" INT NOT NULL,
  "minuto" INT NOT NULL,
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
      REFERENCES "modelo_roteiro" ("id")
      ON DELETE CASCADE)
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
  "hora" INT NOT NULL,
  "minuto" INT NOT NULL,
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
  "descricao" VARCHAR(100) NOT NULL,
  "ordem" INT NOT NULL,
  "observacao" TEXT NULL,
  PRIMARY KEY ("id"),
  CONSTRAINT "fk_sequencia_roteiro"
    FOREIGN KEY ("roteiro_id")
      REFERENCES "roteiro" ("id")
      ON DELETE CASCADE)
;


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
      REFERENCES "convidado" ("id")
      ON DELETE CASCADE)
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
-- Table "funcao"
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS "funcao" (
  "id" SERIAL NOT NULL,
  "descricao" VARCHAR(45) NULL,
  PRIMARY KEY ("id"))
;


-- -----------------------------------------------------
-- Table "usuario"
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS "usuario" (
  "id" SERIAL NOT NULL,
  "pessoa_id" INT NOT NULL,
  "funcao_id" INT NOT NULL,
  PRIMARY KEY ("id"),
  CONSTRAINT "fk_usuario_pessoa"
    FOREIGN KEY ("pessoa_id")
      REFERENCES "pessoa" ("id"),
  CONSTRAINT "fk_usuario_funcao"
    FOREIGN KEY ("funcao_id")
      REFERENCES "funcao" ("id"))
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