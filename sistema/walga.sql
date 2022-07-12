CREATE SCHEMA goempres_walga;

CREATE TABLE contratos_pagos ( 
	id                   INT  NOT NULL    PRIMARY KEY,
	fecha_pago           DATE      ,
	monto                DECIMAL(6)      ,
	pago_id              INT      ,
	contrato_id          INT      ,
	CONSTRAINT unq_contratos_pagos_contrato_id UNIQUE ( contrato_id ) ,
	CONSTRAINT unq_contratos_pagos_pago_id UNIQUE ( pago_id ) 
 );

CREATE TABLE usuarios_permisos ( 
	usuario_id           INT      ,
	permiso_id           INT      ,
	valor                CHAR(1)      ,
	CONSTRAINT unq_usuarios_permisos_permiso_id UNIQUE ( permiso_id ) ,
	CONSTRAINT unq_usuarios_permisos_usuario_id UNIQUE ( usuario_id ) 
 );

CREATE TABLE vehiculos_documentos ( 
	id                   INT  NOT NULL    PRIMARY KEY,
	vehiculo_id          INT      ,
	documento            VARCHAR(150)      ,
	fec_emision          DATE      ,
	fec_vencimiento      DATE      ,
	estado               CHAR(1)      ,
	emisor               INT      ,
	archivo              VARCHAR(45)      ,
	CONSTRAINT unq_vehiculos_documentos_vehiculo_id UNIQUE ( vehiculo_id ) ,
	CONSTRAINT unq_vehiculos_documentos_emisor UNIQUE ( emisor ) 
 );

CREATE TABLE ventas_amarre ( 
	venta_id             INT  NOT NULL    PRIMARY KEY,
	docafecto_id         INT      ,
	fecha                DATE      ,
	motivo_id            INT      ,
	CONSTRAINT unq_ventas_amarre_motivo_id UNIQUE ( motivo_id ) ,
	CONSTRAINT unq_ventas_amarre_docafecto_id UNIQUE ( docafecto_id ) 
 ) engine=InnoDB;

CREATE TABLE ventas_servicios ( 
	id                   INT  NOT NULL    PRIMARY KEY,
	venta_id             INT      ,
	descripcion          VARCHAR(245)      ,
	unidad_id            INT      ,
	precio_venta         DECIMAL(6,2)      ,
	CONSTRAINT unq_ventas_servicios_venta_id UNIQUE ( venta_id ) ,
	CONSTRAINT unq_ventas_servicios_unidad_id UNIQUE ( unidad_id ) 
 ) engine=InnoDB;

CREATE TABLE clientes_pagos ( 
	id                   INT  NOT NULL    PRIMARY KEY,
	fecha_pago           DATE      ,
	monto                DECIMAL(6)      ,
	cliente_id           INT      ,
	usuario_id           INT      ,
	CONSTRAINT unq_clientes_pagos_cliente_id UNIQUE ( cliente_id ) ,
	CONSTRAINT unq_clientes_pagos_usuario_id UNIQUE ( usuario_id ) ,
	CONSTRAINT fk_clientes_pagos_contratos_pagos FOREIGN KEY ( id ) REFERENCES contratos_pagos( pago_id ) ON DELETE NO ACTION ON UPDATE NO ACTION
 ) engine=InnoDB;

CREATE TABLE permisos_sistema ( 
	id                   INT  NOT NULL    PRIMARY KEY,
	descripcion          VARCHAR(100)      ,
	CONSTRAINT fk_permisos_sistema_usuarios_permisos_0 FOREIGN KEY ( id ) REFERENCES usuarios_permisos( permiso_id ) ON DELETE NO ACTION ON UPDATE NO ACTION
 );

CREATE TABLE ventas ( 
	id                   INT  NOT NULL    PRIMARY KEY,
	fecha                DATE      ,
	comprobante_id       INT      ,
	serie                VARCHAR(4)      ,
	numero               INT      ,
	contrato_id          INT      ,
	empresa_id           INT      ,
	usuario_id           INT      ,
	igv                  DECIMAL(5,2)      ,
	total                DECIMAL(8,2)      ,
	estado               CHAR(1)   DEFAULT (1)   ,
	enviado_sunat        CHAR(1)   DEFAULT (0)   ,
	entidad_id           INT      ,
	CONSTRAINT unq_ventas_contrato_id UNIQUE ( contrato_id ) ,
	CONSTRAINT unq_ventas_empresa_id UNIQUE ( empresa_id ) ,
	CONSTRAINT unq_ventas_usuario_id UNIQUE ( usuario_id ) ,
	CONSTRAINT unq_ventas_entidad_id UNIQUE ( entidad_id ) ,
	CONSTRAINT unq_ventas_comprobante_id UNIQUE ( comprobante_id ) ,
	CONSTRAINT fk_ventas_ventas_servicios FOREIGN KEY ( id ) REFERENCES ventas_servicios( venta_id ) ON DELETE NO ACTION ON UPDATE NO ACTION,
	CONSTRAINT fk_ventas_ventas_amarre FOREIGN KEY ( id ) REFERENCES ventas_amarre( venta_id ) ON DELETE NO ACTION ON UPDATE NO ACTION,
	CONSTRAINT fk_ventas_ventas_amarre_0 FOREIGN KEY ( id ) REFERENCES ventas_amarre( docafecto_id ) ON DELETE NO ACTION ON UPDATE NO ACTION
 );

CREATE TABLE comprobantes_empresas ( 
	id                   INT  NOT NULL    PRIMARY KEY,
	comprobante_id       INT      ,
	serie                VARCHAR(4)      ,
	numero               INT      ,
	empresa_id           INT      ,
	CONSTRAINT unq_comprobantes_empresas_comprobante_id UNIQUE ( comprobante_id ) ,
	CONSTRAINT unq_comprobantes_empresas_empresa_id UNIQUE ( empresa_id ) ,
	CONSTRAINT fk_comprobantes_empresas_ventas FOREIGN KEY ( id ) REFERENCES ventas( comprobante_id ) ON DELETE NO ACTION ON UPDATE NO ACTION
 );

CREATE TABLE contratos ( 
	id                   INT  NOT NULL    PRIMARY KEY,
	fecha                DATE      ,
	cliente_id           INT      ,
	usuario_id           INT      ,
	chofer_id            INT      ,
	vehiculo_id          INT      ,
	comprobante_id       INT      ,
	empresa_id           INT      ,
	estado_comprobante   CHAR(1)      ,
	tiposervicio_id      INT      ,
	origen               VARCHAR(100)      ,
	destino              VARCHAR(100)      ,
	servicio             VARCHAR(245)      ,
	estado_contrato      CHAR(1)      ,
	horas_servicio       INT      ,
	monto                DECIMAL(6,2)      ,
	monto_pagado         DECIMAL(6,2)      ,
	hora_inicio          VARCHAR(5)      ,
	hora_termino         VARCHAR(5)      ,
	CONSTRAINT unq_contratos_cliente_id UNIQUE ( cliente_id ) ,
	CONSTRAINT unq_contratos_chofer_id UNIQUE ( chofer_id ) ,
	CONSTRAINT unq_contratos_empresa_id UNIQUE ( empresa_id ) ,
	CONSTRAINT unq_contratos_comprobante_id UNIQUE ( comprobante_id ) ,
	CONSTRAINT unq_contratos_tiposervicio_id UNIQUE ( tiposervicio_id ) ,
	CONSTRAINT unq_contratos_usuario_id UNIQUE ( usuario_id ) ,
	CONSTRAINT unq_contratos_vehiculo_id UNIQUE ( vehiculo_id ) ,
	CONSTRAINT fk_contratos_contratos_pagos FOREIGN KEY ( id ) REFERENCES contratos_pagos( contrato_id ) ON DELETE NO ACTION ON UPDATE NO ACTION,
	CONSTRAINT fk_contratos_ventas_0 FOREIGN KEY ( id ) REFERENCES ventas( contrato_id ) ON DELETE NO ACTION ON UPDATE NO ACTION
 );

CREATE TABLE parametros_valores ( 
	id                   INT  NOT NULL    PRIMARY KEY,
	parametro_id         INT      ,
	descripcion          VARCHAR(100)      ,
	valor1               VARCHAR(50)      ,
	valor2               VARCHAR(50)      ,
	CONSTRAINT unq_parametros_valores_parametro_id UNIQUE ( parametro_id ) ,
	CONSTRAINT fk_parametros_valores_ventas_servicios FOREIGN KEY ( id ) REFERENCES ventas_servicios( unidad_id ) ON DELETE NO ACTION ON UPDATE NO ACTION,
	CONSTRAINT fk_parametros_valores_ventas_amarre FOREIGN KEY ( id ) REFERENCES ventas_amarre( motivo_id ) ON DELETE NO ACTION ON UPDATE NO ACTION,
	CONSTRAINT fk_parametros_valores_contratos_1 FOREIGN KEY ( id ) REFERENCES contratos( comprobante_id ) ON DELETE NO ACTION ON UPDATE NO ACTION,
	CONSTRAINT fk_parametros_valores_contratos_2 FOREIGN KEY ( id ) REFERENCES contratos( tiposervicio_id ) ON DELETE NO ACTION ON UPDATE NO ACTION,
	CONSTRAINT fk_parametros_valores_comprobantes_empresas_0 FOREIGN KEY ( id ) REFERENCES comprobantes_empresas( comprobante_id ) ON DELETE NO ACTION ON UPDATE NO ACTION,
	CONSTRAINT fk_parametros_valores_ventas_0 FOREIGN KEY ( id ) REFERENCES ventas( comprobante_id ) ON DELETE NO ACTION ON UPDATE NO ACTION
 );

CREATE TABLE usuarios ( 
	id                   INT  NOT NULL    PRIMARY KEY,
	username             VARCHAR(100)      ,
	password             VARCHAR(20)      ,
	fec_login            DATE      ,
	fec_creacion         DATE      ,
	estado               CHAR(1)      ,
	empresa_id           INT      ,
	CONSTRAINT unq_usuarios_empresa_id UNIQUE ( empresa_id ) ,
	CONSTRAINT fk_usuarios_clientes_pagos FOREIGN KEY ( id ) REFERENCES clientes_pagos( usuario_id ) ON DELETE NO ACTION ON UPDATE NO ACTION,
	CONSTRAINT fk_usuarios_contratos_0 FOREIGN KEY ( id ) REFERENCES contratos( usuario_id ) ON DELETE NO ACTION ON UPDATE NO ACTION,
	CONSTRAINT fk_usuarios_ventas_0 FOREIGN KEY ( id ) REFERENCES ventas( usuario_id ) ON DELETE NO ACTION ON UPDATE NO ACTION,
	CONSTRAINT fk_usuarios_usuarios_permisos_0 FOREIGN KEY ( id ) REFERENCES usuarios_permisos( usuario_id ) ON DELETE NO ACTION ON UPDATE NO ACTION
 );

CREATE TABLE vehiculos ( 
	id                   INT  NOT NULL    PRIMARY KEY,
	placa                VARCHAR(6)      ,
	seriebin             VARCHAR(100)      ,
	marca                VARCHAR(45)      ,
	modelo               VARCHAR(45)      ,
	anio                 VARCHAR(4)      ,
	capacidad_ton        INT      ,
	estado               INT      ,
	chofer_id            INT      ,
	empresa_id           INT      ,
	CONSTRAINT unq_vehiculos_empresa_id UNIQUE ( empresa_id ) ,
	CONSTRAINT unq_vehiculos_chofer_id UNIQUE ( chofer_id ) ,
	CONSTRAINT fk_vehiculos_vehiculos_documentos_0 FOREIGN KEY ( id ) REFERENCES vehiculos_documentos( vehiculo_id ) ON DELETE NO ACTION ON UPDATE NO ACTION,
	CONSTRAINT fk_vehiculos_contratos_0 FOREIGN KEY ( id ) REFERENCES contratos( vehiculo_id ) ON DELETE NO ACTION ON UPDATE NO ACTION
 );

CREATE TABLE chofer ( 
	id                   INT  NOT NULL    PRIMARY KEY,
	brevete              VARCHAR(9)      ,
	datos                VARCHAR(150)      ,
	categoria            CHAR(2)      ,
	fec_vencimiento      DATE      ,
	estado               INT      ,
	empresa_id           INT      ,
	CONSTRAINT unq_chofer_empresa_id UNIQUE ( empresa_id ) ,
	CONSTRAINT fk_chofer_contratos_0 FOREIGN KEY ( id ) REFERENCES contratos( chofer_id ) ON DELETE NO ACTION ON UPDATE NO ACTION,
	CONSTRAINT fk_chofer_vehiculos_0 FOREIGN KEY ( id ) REFERENCES vehiculos( chofer_id ) ON DELETE NO ACTION ON UPDATE NO ACTION
 );

CREATE TABLE clientes ( 
	id                   INT  NOT NULL    PRIMARY KEY,
	datos                VARCHAR(150)      ,
	celular              VARCHAR(9)      ,
	email                VARCHAR(200)      ,
	entidad_id           INT      ,
	empresa_id           INT UNSIGNED     ,
	CONSTRAINT unq_clientes_entidad_id UNIQUE ( entidad_id ) ,
	CONSTRAINT unq_clientes_empresa_id UNIQUE ( empresa_id ) ,
	CONSTRAINT fk_clientes_clientes_pagos FOREIGN KEY ( id ) REFERENCES clientes_pagos( cliente_id ) ON DELETE NO ACTION ON UPDATE NO ACTION,
	CONSTRAINT fk_clientes_contratos_0 FOREIGN KEY ( id ) REFERENCES contratos( cliente_id ) ON DELETE NO ACTION ON UPDATE NO ACTION
 );

CREATE TABLE empresas ( 
	id                   INT  NOT NULL    PRIMARY KEY,
	razonsocial          VARCHAR(245)      ,
	ruc                  VARCHAR(11)      ,
	dirfiscal            VARCHAR(245)      ,
	ubigeo               VARCHAR(6)      ,
	departamento         VARCHAR(45)      ,
	provincia            VARCHAR(45)      ,
	distrito             VARCHAR(45)      ,
	codsunat             VARCHAR(4)      ,
	usersunat            VARCHAR(15)      ,
	passsunat            VARCHAR(20)      ,
	CONSTRAINT fk_empresas_chofer_0 FOREIGN KEY ( id ) REFERENCES chofer( empresa_id ) ON DELETE NO ACTION ON UPDATE NO ACTION,
	CONSTRAINT fk_empresas_ventas_0 FOREIGN KEY ( id ) REFERENCES ventas( empresa_id ) ON DELETE NO ACTION ON UPDATE NO ACTION,
	CONSTRAINT fk_empresas_contratos_0 FOREIGN KEY ( id ) REFERENCES contratos( empresa_id ) ON DELETE NO ACTION ON UPDATE NO ACTION,
	CONSTRAINT fk_empresas_clientes_0 FOREIGN KEY ( id ) REFERENCES clientes( empresa_id ) ON DELETE NO ACTION ON UPDATE NO ACTION,
	CONSTRAINT fk_empresas_comprobantes_empresas_0 FOREIGN KEY ( id ) REFERENCES comprobantes_empresas( empresa_id ) ON DELETE NO ACTION ON UPDATE NO ACTION,
	CONSTRAINT fk_empresas_usuarios_0 FOREIGN KEY ( id ) REFERENCES usuarios( empresa_id ) ON DELETE NO ACTION ON UPDATE NO ACTION,
	CONSTRAINT fk_empresas_vehiculos_0 FOREIGN KEY ( id ) REFERENCES vehiculos( empresa_id ) ON DELETE NO ACTION ON UPDATE NO ACTION
 );

CREATE TABLE entidades ( 
	id                   INT  NOT NULL    PRIMARY KEY,
	razonsocial          VARCHAR(245)      ,
	direccion            VARCHAR(245)      ,
	documento            VARCHAR(12)      ,
	CONSTRAINT fk_entidades_ventas_0 FOREIGN KEY ( id ) REFERENCES ventas( entidad_id ) ON DELETE NO ACTION ON UPDATE NO ACTION,
	CONSTRAINT fk_entidades_vehiculos_documentos_0 FOREIGN KEY ( id ) REFERENCES vehiculos_documentos( emisor ) ON DELETE NO ACTION ON UPDATE NO ACTION,
	CONSTRAINT fk_entidades_clientes_0 FOREIGN KEY ( id ) REFERENCES clientes( entidad_id ) ON DELETE NO ACTION ON UPDATE NO ACTION
 );

CREATE TABLE parametros ( 
	id                   INT  NOT NULL    PRIMARY KEY,
	descripcion          VARCHAR(200)      ,
	tipo                 INT      ,
	CONSTRAINT fk_parametros_parametros_valores_0 FOREIGN KEY ( id ) REFERENCES parametros_valores( parametro_id ) ON DELETE NO ACTION ON UPDATE NO ACTION
 );

ALTER TABLE ventas_amarre MODIFY venta_id INT  NOT NULL   COMMENT 'es el id de la nota de credito o debito';

ALTER TABLE ventas_amarre MODIFY docafecto_id INT     COMMENT 'es la boleta o factura';

ALTER TABLE contratos MODIFY estado_contrato CHAR(1)     COMMENT '0 en proceso\n1 finalizado';

ALTER TABLE parametros COMMENT 'tipo documento\ntipo pago (contado credito)';

