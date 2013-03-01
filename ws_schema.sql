/*
SQL for RESTful API
*/
-- table creation
CREATE TABLE apikeys
(
  apikey character varying(100) NOT NULL,
  CONSTRAINT apikeys_pkey PRIMARY KEY (apikey )
);
-- INSERT keys
INSERT INTO apikeys (apikey) VALUES ('abcde');
INSERT INTO apikeys (apikey) VALUES ('12345');
INSERT INTO apikeys (apikey) VALUES ( md5('abcde') );

-- scheme creation
CREATE SCHEMA webservices;

-- view for get all info about a room
CREATE OR REPLACE VIEW webservices.info_estancia AS 
 SELECT te.edificio, te.planta, te.codigoestancia, te.denominacionestancia, te.superficie_m2, te.codigodptoestancia, te.nombredptoestancia, te.codigoactividadestancia, te.descripcionactividadestancia, ( SELECT count(oc.nif) AS count
           FROM ( SELECT DISTINCT todaspersonas.nif, todaspersonas.codigo
                   FROM todaspersonas
                  ORDER BY todaspersonas.nif, todaspersonas.codigo) oc
          WHERE oc.codigo::text = te.codigoestancia::text) AS ocupantes, st_asgeojson(st_transform(te.geometria, 4326)) AS geojson
   FROM ( SELECT e.txt_edificio AS edificio, sig.geometria, 
                CASE
                    WHEN "substring"(sig.codigo::text, 5, 2) = 'PS'::text THEN 'Sótano'::text
                    WHEN "substring"(sig.codigo::text, 5, 2) = 'PB'::text THEN 'Planta Baja'::text
                    WHEN "substring"(sig.codigo::text, 5, 2) = 'P1'::text THEN 'Planta Primera'::text
                    WHEN "substring"(sig.codigo::text, 5, 2) = 'P2'::text THEN 'Planta Segunda'::text
                    WHEN "substring"(sig.codigo::text, 5, 2) = 'P3'::text THEN 'Planta Tercera'::text
                    ELSE NULL::text
                END AS planta, 
                CASE
                    WHEN "substring"(sig.codigo::text, 5, 2) = 'PS'::text THEN 'Soterrani'::text
                    WHEN "substring"(sig.codigo::text, 5, 2) = 'PB'::text THEN 'Planta Baixa'::text
                    WHEN "substring"(sig.codigo::text, 5, 2) = 'P1'::text THEN 'Planta Primera'::text
                    WHEN "substring"(sig.codigo::text, 5, 2) = 'P2'::text THEN 'Planta Segona'::text
                    WHEN "substring"(sig.codigo::text, 5, 2) = 'P3'::text THEN 'Planta Tercera'::text
                    ELSE NULL::text
                END AS planta_val, sig.codigo AS codigoestancia, sig.denominaci AS denominacionestancia, sig.observacio AS denominacionestancia_val, round(st_area(sig.geometria)::numeric, 2) AS superficie_m2, sig.coddpto AS codigodptoestancia, ds.txt_dpto_sigua AS nombredptoestancia, sig.actividad AS codigoactividadestancia, a.txt_actividad AS descripcionactividadestancia, a.txt_actividad_val AS descripcionactividadestancia_val
           FROM todasestancias sig
      JOIN edificios e ON "substring"(sig.codigo::text, 1, 4) = (e.cod_zona::text || e.cod_edificio::text)
   JOIN departamentossigua ds ON sig.coddpto::text = ds.cod_dpto_sigua::text
   JOIN actividades a ON sig.actividad = a.codactividad) te;  

-- view for get all info about a person
CREATE OR REPLACE VIEW webservices.info_persona AS 
 SELECT tp.nif AS nifempleado, (((p.nombre::text || ' '::text) || p.apellido1::text) || ' '::text) || p.apellido2::text AS nombreempleado, tp.cod_depto AS codigodptoempleado, ds.txt_dpto_sigua AS nombredptoempleado, tp.cod_puesto AS codigopuestoempleado, pu.txt_puesto AS nombrepuestoempleado, pu.pdi_pas AS tipoempleado, te.edificio, te.planta, te.codigoestancia, te.denominacionestancia, te.superficie_m2, te.codigodptoestancia, te.nombredptoestancia, te.codigoactividadestancia, te.descripcionactividadestancia, ( SELECT count(oc.nif) AS count
           FROM ( SELECT DISTINCT todaspersonas.nif, todaspersonas.codigo
                   FROM todaspersonas
                  ORDER BY todaspersonas.nif, todaspersonas.codigo) oc
          WHERE oc.codigo::text = te.codigoestancia::text) AS ocupantes
   FROM todaspersonas tp
   JOIN personal p ON tp.nif::text = p.nif::text
   JOIN webservices.info_estancia te ON tp.codigo::text = te.codigoestancia::text
   JOIN departamentossigua ds ON tp.cod_depto::text = ds.cod_dpto_sigua::text
   JOIN puestos pu ON tp.cod_puesto::text = pu.cod_puesto::text
  ORDER BY p.apellido1, p.apellido2, p.nombre;

