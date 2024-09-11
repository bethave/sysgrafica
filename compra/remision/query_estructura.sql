
CREATE TABLE proveedor (
                id_pro INTEGER NOT NULL,
                id_per INTEGER NOT NULL,
                estado VARCHAR NOT NULL,
                CONSTRAINT proveedor_pk PRIMARY KEY (id_pro)
);


CREATE TABLE compra_orden (
                id_co INTEGER NOT NULL,
                co_fecha DATE NOT NULL,
                id_suc INTEGER NOT NULL,
                id_usu INTEGER NOT NULL,
                estado VARCHAR NOT NULL,
                id_pro INTEGER NOT NULL,
                CONSTRAINT compra_orden_pk PRIMARY KEY (id_co)
);



CREATE TABLE compra_orden_detalle (
                id_co INTEGER NOT NULL,
                id_item INTEGER NOT NULL,
                cantidad NUMERIC NOT NULL,
                precio NUMERIC NOT NULL,
                CONSTRAINT compra_orden_detalle_pk PRIMARY KEY (id_co, id_item)
);



CREATE TABLE compra_orden_pedido (
                id_co INTEGER NOT NULL,
                id_ped INTEGER NOT NULL,
                estado VARCHAR NOT NULL,
                CONSTRAINT compra_orden_pedido_pk PRIMARY KEY (id_co, id_ped)
);


ALTER TABLE proveedor ADD CONSTRAINT personas_proveedor_fk
FOREIGN KEY (id_per)
REFERENCES personas (id_per)
ON DELETE NO ACTION
ON UPDATE NO ACTION
NOT DEFERRABLE;

ALTER TABLE compra_orden ADD CONSTRAINT proveedor_compra_orden_fk
FOREIGN KEY (id_pro)
REFERENCES proveedor (id_pro)
ON DELETE NO ACTION
ON UPDATE NO ACTION
NOT DEFERRABLE;

ALTER TABLE compra_orden ADD CONSTRAINT usuarios_compra_orden_fk
FOREIGN KEY (id_usu)
REFERENCES usuarios (id_usu)
ON DELETE NO ACTION
ON UPDATE NO ACTION
NOT DEFERRABLE;

ALTER TABLE compra_orden ADD CONSTRAINT sucursales_compra_orden_fk
FOREIGN KEY (id_suc)
REFERENCES sucursales (id_suc)
ON DELETE NO ACTION
ON UPDATE NO ACTION
NOT DEFERRABLE;

ALTER TABLE compra_orden_detalle ADD CONSTRAINT compra_orden_compra_orden_detalle_fk
FOREIGN KEY (id_co)
REFERENCES compra_orden (id_co)
ON DELETE NO ACTION
ON UPDATE NO ACTION
NOT DEFERRABLE;

ALTER TABLE compra_orden_pedido ADD CONSTRAINT compra_orden_compra_orden_pedido_fk
FOREIGN KEY (id_co)
REFERENCES compra_orden (id_co)
ON DELETE NO ACTION
ON UPDATE NO ACTION
NOT DEFERRABLE;


ALTER TABLE compra_orden_detalle ADD CONSTRAINT items_compra_orden_detalle_fk
FOREIGN KEY (id_item)
REFERENCES items (id_item)
ON DELETE NO ACTION
ON UPDATE NO ACTION
NOT DEFERRABLE;


ALTER TABLE compra_orden_pedido ADD CONSTRAINT compra_pedido_compra_orden_pedido_fk
FOREIGN KEY (id_ped)
REFERENCES compra_pedido (id_ped)
ON DELETE NO ACTION
ON UPDATE NO ACTION
NOT DEFERRABLE;