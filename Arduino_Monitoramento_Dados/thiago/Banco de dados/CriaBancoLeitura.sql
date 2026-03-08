CREATE TABLE macthiago (
  idmacthiago VARCHAR(17)  NOT NULL  ,
  nome VARCHAR(25)  NOT NULL  ,
  contador INTEGER UNSIGNED  NULL DEFAULT 0 ,
  ativo BOOL  NOT NULL DEFAULT 0   ,
PRIMARY KEY(idmacthiago));



CREATE TABLE leiturathiago (
  idleiturathiago INTEGER UNSIGNED  NOT NULL   AUTO_INCREMENT,
  macthiago_idmacthiago VARCHAR(17)  NOT NULL  ,
  dataleitura DATE  NULL  ,
  horaleitura TIME  NULL  ,
  umidade REAL  NULL  ,
  temperatura REAL  NULL    ,
PRIMARY KEY(idleiturathiago)  ,
INDEX leiturathiago_FKIndex1(macthiago_idmacthiago),
  FOREIGN KEY(macthiago_idmacthiago)
    REFERENCES macthiago(idmacthiago)
      ON DELETE NO ACTION
      ON UPDATE NO ACTION);




