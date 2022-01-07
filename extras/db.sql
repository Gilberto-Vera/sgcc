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
  "contato" VARCHAR(45) NOT NULL,
  "email" VARCHAR(100) NOT NULL,
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

CREATE OR REPLACE FUNCTION inserir_dados() RETURNS void AS
$$
BEGIN

  IF (SELECT COUNT(*) FROM funcao) = 0 THEN
    -- -----------------------------------------------------
    -- Insert "funcao"
    -- -----------------------------------------------------
    INSERT INTO funcao (id, descricao)
      VALUES (default, 'Administrador'),
        (default, 'Proprietário'),
        (default, 'Gerente'),
        (default, 'Auxiliar')
    ;

  END IF;

  IF (SELECT COUNT(*) FROM pessoa) = 0 THEN
    -- -----------------------------------------------------
    -- Insert "usuarios"
    -- -----------------------------------------------------
    INSERT INTO pessoa (id, nome, email, senha, ativo)
      VALUES (default, 'admin', 'admin@admin', 'admin', TRUE),
        (default, 'Isaac Mateus Lopes', 'isaacmateuslopes-80@anbima.com.br', 'R3f8nY4JrD', TRUE),
        (default, 'Márcio Antonio Duarte', 'marcioantonioduarte@fernandesfilpi.com.br', 'JUPH8sXc9K', TRUE),
        (default, 'Vitória Larissa Sandra Santos', 'vitorialarissasandrasantos_@sdrifs.com.br', 'EaZ3dJHWGl', TRUE),
        (default, 'Gustavo Breno Pereira', 'ggustavobrenopereira@its.jnj.com', 'juZCHR7hJx', TRUE),
        (default, 'Carla Gabrielly Evelyn Cavalcanti', 'cavalcanti-86@bhcervejas.com.br', 'FrG8lLeUal', TRUE),
        (default, 'Maitê Lavínia Adriana da Mata', 'maitelaviniaadrianadamata-80@desari.com.br', '5DnuguJ1uo', TRUE),
        (default, 'Rebeca Flávia Lúcia Farias', 'rrebecaflavialuciafarias@ssala.com.br', 'Ud7f4Zp6ef', TRUE),
        (default, 'Marcos Ruan Santos', 'marcosruansantos_@fosj.unesp.br', 'LiYK6I9puP', TRUE),
        (default, 'Valentina Luana Melo', 'valentinaluanamelo_@campanati.com.br', '2Yh9hcA2QL', TRUE),
        (default, 'Emilly Josefa Bárbara Moreira', 'emillyjosefabarbaramoreira@ymail.com', 'GndjTI71A1', TRUE)
    ;

    INSERT INTO usuario (id, pessoa_id, funcao_id)
      VALUES (default, 1, 1),
        (default, 2, 2),
        (default, 3, 3),
        (default, 4, 3),
        (default, 5, 4),
        (default, 6, 4),
        (default, 7, 4),
        (default, 8, 4),
        (default, 9, 4),
        (default, 10, 4),
        (default, 11, 4)
    ;

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
      VALUES (default, 12, 'Garrett Winters Nª50 Accountant Seila', 12345676357),
        (default, 13, 'Ashton Cox Nª513 Author Seila', 68137485666),
        (default, 14, 'Cedric Kelly Nª134 Developer Seila', 22357135274),
        (default, 15, 'Airi Satou Nª5 Senior Seila', 55476271933),
        (default, 16, 'Brielle Williamson Nª183 Williamson Seila', 16781135761),
        (default, 17, 'Herrod Chandler Nª953 Chandler Seila', 15279665759),
        (default, 18, 'Rhona Davidson Nª937 Davidson Seila', 51235795165),
        (default, 19, 'Colleen Hurst Nª509 Hurst Seila', 57495314239),
        (default, 20, 'Sonya Frost Nª42 Frost Seila', 41357921523),
        (default, 21, 'Jena Gaines Nª153 Gaines Seila', 30125789461),
        (default, 22, 'Quinn Flynn Nº183 Flynn Seila', 27495314524),
        (default, 23, 'Charde Marshall Nº1358 Marshall Seila', 25679186336),
        (default, 24, 'Haley Kennedy Nº786 Kennedy Seila', 76219438443),
        (default, 25, 'Tatyana Fitzpatrick Nº275 Fitzpatrick Seila', 19296354891),
        (default, 26, 'Michael Silva Nº785 Silva Seila', 56348749166),
        (default, 27, 'Paul Byrd Nº63 Byrd Seila', 64521479863),
        (default, 28, 'Gloria Little Nº563 Little Seila', 55957419635),
        (default, 29, 'Bradley Greer Nº93 Greer Seila', 45315749511),
        (default, 30, 'Dai Rios Nº359 Rios Seila', 35897653154),
        (default, 31, 'Tiger Nixon Nº635 Edinburgh Seila', 63579421561)
    ;
    INSERT INTO telefone_pessoa (id, pessoa_id, telefone, principal, descricao)
      VALUES (default, 1, 999743570, TRUE, 'celular'),
        (default, 2, 986442875, TRUE, 'celular'),
        (default, 3, 988623812, TRUE, 'celular'),
        (default, 4, 995464099, TRUE, 'celular'),
        (default, 5, 985308681, TRUE, 'celular'),
        (default, 6, 993501588, TRUE, 'celular'),
        (default, 7, 992899566, TRUE, 'celular'),
        (default, 8, 999758384, TRUE, 'celular'),
        (default, 9, 981999191, TRUE, 'celular'),
        (default, 10, 982579815, TRUE, 'celular'),
        (default, 11, 988888855, TRUE, 'celular'),
        (default, 12, 994501968, TRUE, 'celular'),
        (default, 13, 937485666, TRUE, 'celular'),
        (default, 14, 957135274, TRUE, 'celular'),
        (default, 15, 976271933, TRUE, 'celular'),
        (default, 16, 981135761, TRUE, 'celular'),
        (default, 17, 979665759, TRUE, 'celular'),
        (default, 18, 935795165, TRUE, 'celular'),
        (default, 19, 995314239, TRUE, 'celular'),
        (default, 20, 957921523, TRUE, 'celular'),
        (default, 21, 925789461, TRUE, 'celular'),
        (default, 22, 995314524, TRUE, 'celular'),
        (default, 23, 979186336, TRUE, 'celular'),
        (default, 24, 919438443, TRUE, 'celular'),
        (default, 25, 996354891, TRUE, 'celular'),
        (default, 26, 948749166, TRUE, 'celular'),
        (default, 27, 921479863, TRUE, 'celular'),
        (default, 28, 957419635, TRUE, 'celular'),
        (default, 29, 915749511, TRUE, 'celular'),
        (default, 30, 997653154, TRUE, 'celular'),
        (default, 31, 979421561, TRUE, 'celular')
    ;

  END IF;

  IF (SELECT COUNT(*) FROM evento) = 0 THEN
    -- -----------------------------------------------------
    -- Insert "evento"
    -- -----------------------------------------------------
    INSERT INTO evento (id, nome, data, num_convidados, observacao)
      VALUES (default, 'Inicial', '1979-03-28 23:57:02', 1, '')
    ;
  END IF;

  IF (SELECT COUNT(*) FROM situacao) = 0 THEN
    -- -----------------------------------------------------
    -- Insert "situacao"
    -- -----------------------------------------------------
    INSERT INTO situacao (id, evento_id, nome)
      VALUES (default, 1, 'Iniciado'),
        (default, 1, 'Confirmado'),
        (default, 1, 'Finalizado'),
        (default, 1, 'Bloqueado'),
        (default, 1, 'Cancelado')
    ;
  END IF;

  IF (SELECT COUNT(*) FROM servico) = 0 THEN
    -- -----------------------------------------------------
    -- Insert "serviço"
    -- -----------------------------------------------------
    INSERT INTO servico (id, servico)
      VALUES (default, 'Cerimonial'),
        (default, 'Buffet'),
        (default, 'Decoração'),
        (default, 'Doces e Salgados'),
        (default, 'Dj'),
        (default, 'Recepção'),
        (default, 'Cerimonia')
    ;
  END IF;

  IF (SELECT COUNT(*) FROM fornecedor) = 0 THEN
    -- -----------------------------------------------------
    -- Insert "fornecedor"
    -- -----------------------------------------------------
    INSERT INTO fornecedor (id, cnpj, razao_social, nome_fantasia, endereco, contato, email, ativo)
      VALUES (default, 11026065000122, 'Emanuelly e Hugo Marketing ME', 'EH Marketing', 'Rua Cristóvão Benitez 188 Jardim Nélia', 'Emanuelly e Hugo', 'rh@emanuellyehugomarketingme.com.br', TRUE),
        (default, 52108308000159, 'Manuel e Manoel Pizzaria Delivery Ltda', 'MM Pizzaria Delivery', 'Rua Soldado Sebastião Garcia 469 Parque Novo Mundo', 'Manuel e Manoel', 'manutencao@manuelemanoelpizzariadeliveryltda.com.br', TRUE),
        (default, 18717781000103, 'Victor e Ana Restaurante ME', 'VA Restaurante', 'Rua João Prezotto 387 Jardim Alto Alegre', 'Victor e Ana', 'fiscal@victoreanarestauranteme.com.br', TRUE),
        (default, 13519057000143, 'Melissa e Natália Telas ME', 'MN Telas', 'Rua José Boscoli 144 Chácara Flórida', 'Melissa e Natália', 'fiscal@melissaenataliatelasme.com.br', TRUE),
        (default, 81442670000160, 'Fátima e Daiane Financeira Ltda', 'FD Financeira', 'Rua Dona Maria Ometto Franceschi 130 Jardim Diamante', 'Fátima e Daiane', 'sac@fatimaedaianefinanceiraltda.com.br', TRUE),
        (default, 14263478000119, 'Stella e Benício Doces & Salgados Ltda', 'SB Doces e Salgados', 'Avenida Getúlio Dorneles Vargas 3450 979 Jardim Primavera', 'Stella e Benício', 'presidencia@stellaebeniciodocessalgadosltda.com.br', TRUE),
        (default, 19262991000109, 'Aurora e Evelyn Doces & Salgados Ltda', 'AE Doces e Salgados', 'Rua Curitiba 911 Jardim Nova Cândida', 'Aurora e Evelyn', 'posvenda@auroraeevelyndocessalgadosltda.com.br', TRUE),
        (default, 59702255000149, 'Carolina e Giovanna Consultoria Financeira ME', 'CG Consultaria Financeira', 'Avenida Nordestina 753 Vila Americana', 'Carolina e Giovanna', 'vendas@carolinaegiovannaconsultoriafinanceirame.com.br', TRUE),
        (default, 10537274000178, 'Laura e Bryan Adega Ltda', 'LB Adega', 'Rua Adriano Maciel de Queiróz 367 Jardim Tatiana', 'Laura e Bryan', 'cobranca@lauraebryanadegaltda.com.br', TRUE),
        (default, 20660706000197, 'Ian e Mariane Pizzaria Delivery ME', 'IM Pizzaria Delivery', 'Via de Acesso 2 600 Condomínio Residencial Village São Carlos ll', 'Ian e Mariane', 'posvenda@ianemarianepizzariadeliveryme.com.br', TRUE),
        (default, 41109302000180, 'Ruan e Lúcia Pizzaria Delivery ME', 'RL Pizzaria Delivery', 'Rua Parintins 709 Vila Floresta', 'Ruan e Lúcia', 'almoxarifado@ruaneluciapizzariadeliveryme.com.br', TRUE)
    ;
  END IF;

  IF (SELECT COUNT(*) FROM servico_fornecedor) = 0 THEN
    -- -----------------------------------------------------
    -- Insert "serviço"
    -- -----------------------------------------------------
    INSERT INTO servico_fornecedor (id, fornecedor_id, servico_id, principal)
      VALUES (default, 1, 1, TRUE),
        (default, 2, 2, TRUE),
        (default, 3, 3, TRUE),
        (default, 4, 4, TRUE),
        (default, 5, 5, TRUE),
        (default, 6, 6, TRUE),
        (default, 7, 7, TRUE),
        (default, 8, 1, TRUE),
        (default, 9, 2, TRUE),
        (default, 10, 3, TRUE),
        (default, 11, 4, TRUE),
        (default, 1, 6, FALSE),
        (default, 3, 7, FALSE),
        (default, 7, 1, FALSE)
    ;
  END IF;

  IF (SELECT COUNT(*) FROM telefone_fornecedor) = 0 THEN
    -- -----------------------------------------------------
    -- Inserir "telefone_fornecedor"
    -- -----------------------------------------------------
    INSERT INTO telefone_fornecedor (id, fornecedor_id, descricao, telefone, principal)
      VALUES (default, 1, 'Celular', 982895122, TRUE),
        (default, 2, 'Celular', 997696742, TRUE),
        (default, 3, 'Celular', 987683091, TRUE),
        (default, 4, 'Celular', 984737732, TRUE),
        (default, 5, 'Celular', 997871604, TRUE),
        (default, 6, 'Celular', 995524086, TRUE),
        (default, 7, 'Celular', 988397445, TRUE),
        (default, 8, 'Celular', 991495728, TRUE),
        (default, 9, 'Celular', 996637728, TRUE),
        (default, 10, 'Celular', 996320668, TRUE),
        (default, 11, 'Celular', 997532366, TRUE)
    ;
  END IF;  

END
$$ LANGUAGE plpgsql;

SELECT inserir_dados();

DROP FUNCTION inserir_dados;