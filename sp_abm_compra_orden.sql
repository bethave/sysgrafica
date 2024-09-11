
CREATE OR REPLACE FUNCTION sp_abm_compra_orden(
cid_co integer, 
cco_fecha date, 
cid_suc integer, 
cid_usu integer, 
cid_pro integer,
ccon_pedido boolean, 
cid_ped integer,
cid_item integer,
ccantidad numeric,
operacion integer)
RETURNS void AS
$$
DECLARE dp RECORD; --PARA GUARDAR TODOS LOS DETALLES DE ESE PEDIDO
DECLARE op RECORD; --PARA GUARDAR TODOS LOS PEDIDOS QUE ESTAN EN ESA ORDEN
BEGIN
	IF operacion = 1 THEN --INSERTAR EN NUESTRA DE ORDEN DE COMPRA
		INSERT INTO compra_orden(id_co, 
			co_fecha, 
			id_suc, 
			id_usu, 
			estado, 
			id_pro, 
			con_pedido)
		VALUES((SELECT COALESCE(MAX(id_co),0) + 1 FROM compra_orden), 
			cco_fecha, 
			cid_suc, 
			cid_usu, 
			'PENDIENTE', 
			cid_pro, 
			ccon_pedido);
		RAISE NOTICE '%','DATOS GUARDADOS';
	END IF;
	IF operacion = 2 THEN --REGISTRAR EL PEDIDO CON LA ORDEN DE COMPRA
		PERFORM * FROM compra_orden WHERE id_co = cid_co AND con_pedido = 'true'::boolean;
		IF NOT FOUND THEN --PARA VERIFICAR QUE EXISTA Y QUE ESTE MARCADO COMO QUE SE UTILIZARA CON ORDEN DE COMPRA
			RAISE EXCEPTION 'ESTA ORDEN NO SE PUEDE USAR CON PEDIDOS';
		END IF;
		PERFORM * FROM compra_pedido WHERE id_ped = cid_ped AND estado = 'CONFIRMADO';
		IF NOT FOUND THEN
			RAISE EXCEPTION 'ESTE PEDIDO NO SE PUEDE UTILIZAR';
		END IF;
		FOR dp IN SELECT * FROM compra_pedido_detalle WHERE id_ped = cid_ped
		LOOP
			PERFORM * FROM compra_orden_detalle WHERE id_co = cid_co AND id_item = dp.id_item;
			IF FOUND THEN --SI YA EXISTE EL PRODUCTO EN NUESTRO DETALLE DE ORDEN DE COMPRA
				UPDATE compra_orden_detalle SET cantidad = cantidad + dp.cantidad
				WHERE id_co = cid_co AND id_item = dp.id_item;
			ELSE --SI AUN NO EXISTE EL PRODUCTO EN NUESTRO DETALLE DE ORDEN DE COMPRA
				INSERT INTO compra_orden_detalle (id_co, 
					id_item, 
					cantidad, 
					precio) 
				VALUES (cid_co, 
					dp.id_item, 
					dp.cantidad, 
					(SELECT precio_compra FROM items WHERE id_item = dp.id_item));
			END IF;
		END LOOP;
		INSERT INTO compra_orden_pedido (id_co, id_ped, estado) VALUES (cid_co, cid_ped, 'ACTIVO');
		UPDATE compra_pedido SET estado = 'ORDENADO' WHERE id_ped = cid_ped;
		RAISE NOTICE 'PEDIDO AÑADIDO CON EXITO';
	END IF;
	IF operacion = 3 THEN --CONFIRMAR ORDEN DE COMPRA
		PERFORM * FROM compra_orden WHERE id_co = cid_co AND estado = 'PENDIENTE';
		IF NOT FOUND THEN
			RAISE EXCEPTION 'LA ORDEN DE COMPRA NO SE ENCUENTRA PENDIENTE';
		END IF;
		PERFORM * FROM compra_orden_detalle WHERE id_co = cid_co;
		IF NOT FOUND THEN
			RAISE EXCEPTION 'LA ORDEN DE COMPRA NO POSEE DETALLES';
		END IF;
		UPDATE compra_orden SET estado = 'CONFIRMADO' WHERE id_co = cid_co;
		RAISE NOTICE 'CONFIRMADO CON EXITO';
	END IF;
	IF operacion = 4 THEN --ANULAR LA ORDEN DE COMPRA
		PERFORM * FROM compra_orden WHERE id_co = cid_co AND estado = 'PENDIENTE';
		IF NOT FOUND THEN
			RAISE EXCEPTION 'NO SE PUEDE ANULAR';
		END IF;
		PERFORM * FROM compra_orden WHERE id_co = cid_co AND con_pedido = 'true'::boolean;
		IF NOT FOUND THEN
			UPDATE compra_orden SET estado = 'ANULADO' WHERE id_co = cid_co;
		ELSE
			FOR op IN SELECT * FROM compra_orden_pedido WHERE id_co = cid_co
			LOOP
				UPDATE compra_pedido SET estado = 'CONFIRMADO' WHERE id_ped = op.id_ped;
			END LOOP;
		END IF;
		RAISE NOTICE 'ANULADO CON EXITO';
	END IF;
	IF operacion = 5 THEN --AGREGAR DETALLE DE ORDEN DE COMPRA
		PERFORM * FROM compra_orden WHERE id_co = cid_co AND estado = 'PENDIENTE';
		IF NOT FOUND THEN
			RAISE EXCEPTION 'NO SE PUEDE AGREGAR DETALLES A ESTA ORDEN DE COMPRA';
		END IF;
		PERFORM * FROM compra_orden_detalle WHERE id_co = cid_co AND id_item = cid_item;
		IF FOUND THEN
			RAISE EXCEPTION 'ESTE PRODUCTO YA EXISTE';
		END IF;
		INSERT INTO compra_orden_detalle (id_co, id_item, cantidad, precio) 
		VALUES (cid_co, cid_item, ccantidad, (SELECT precio_compra FROM items WHERE id_item = cid_item));
		RAISE NOTICE 'AGREGADO CON EXITO';
	END IF;
	IF operacion = 6 THEN --MODIFICAR CANTIDAD DE DETALLE DE ORDEN DE COMPRA
		PERFORM * FROM compra_orden WHERE id_co = cid_co AND estado = 'PENDIENTE';
		IF NOT FOUND THEN
			RAISE EXCEPTION 'NO SE PUEDE MODIFICAR DETALLES A ESTA ORDEN DE COMPRA';
		END IF;
		UPDATE compra_orden_detalle SET cantidad = ccantidad
		WHERE id_co = cid_co AND id_item = cid_item;
		RAISE NOTICE 'MODIFICADO CON EXITO';
	END IF;
	IF operacion = 7 THEN --QUITAR DETALLE DE ORDEN DE COMPRA
		PERFORM * FROM compra_orden WHERE id_co = cid_co AND estado = 'PENDIENTE';
		IF NOT FOUND THEN
			RAISE EXCEPTION 'NO SE PUEDE QUITAR DETALLES A ESTA ORDEN DE COMPRA';
		END IF;
		DELETE FROM compra_orden_detalle
		WHERE id_co = cid_co AND id_item = cid_item;
		RAISE NOTICE 'QUITADO CON EXITO';
	END IF;
END;
$$
LANGUAGE plpgsql;
