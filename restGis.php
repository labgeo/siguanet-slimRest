<?php

require 'Slim/Slim.php';

\Slim\Slim::registerAutoloader();
$app = new \Slim\Slim();

/*
 * DOCUMENTATION
 */
// TEMPLATES
$app->config(array(
   'templates.path' => './templates'
));
$app->get('/doc', function () use ($app) {
    $data = array(
       'heading' => 'Doumentaci&oacute;n RestGis',
       'intro' => 'Este servicio Rest Ful utiliza el Framework <strong><a href="http://www.slimframework.com/">Slim</a></strong>. Para su instalaci&oacute;n consulte el portal web. Este Framework se caracteriza por su f&aacute;cil configuraci&oacute;n e implementaci&oacute;n. 
       Si usted est&aacute viendo esta documentaci&oacute;n es que el servicio est&aacute funcionando.
       Toda la l&oacute;gica reside en un s&oacute;lo fichero (restGis.php).
       <P>Para ver ejemplos de aplicaci&oacute;n ver <a href="../test/index.html">este enlace</a>.</P>',
       'source' => 'Para facilitar el acceso a base de datos hemos utilizado la pasarela PDO de PHP como una librer&iacute;a abstracta 
       de acceso a base de datos. Todas las funciones que requieren acceso a la base de datos hacen una llamada a 
       la funci&oacuten <strong>conn()</strong>, que a su vez llama a otro fichero (config.php) que contiene los par&aacute;metros de 
       conexi&oacute;n.
       <p><pre>
       $dbhost = \'[your hostname or IP]\';
       $dbuser = \'[your db username]\';
       $dbpass = \'[your password]\';
       $dbname = \'siguanet\';
       </pre></p>   
        ',
       'example' => 'Para crear un nuevo m&eacute;todo es  necesario a&ntilde;adir la siguiente firma: 
       <p><pre>
       $app->[request](\'[route]/[name]/:[parameter]\', \'[function name]\');
       </pre></p>
       De esta forma el nuevo m&eacute;todo tendr&aacute; esta URI
		<P><PRE>http://[hostname]/restGis.php/ruta1/ruta2/name:parametro</PRE></P>
       Por ejemplo:
       <p><pre>
       $app->get(\'/personal/getDetallePer/:id\', \'getDetallePer\');
       http://localhost/siguapi/restGis.php/personal/getDetallePer/12345678A       
       </pre></p>
       La funci&oacute;n deber&aacute; tener, opcionalmente, como par&aacute;metro el mismo que el m&eacute;todo, 
       y como respuesta es recomendable JSON. Ejemplo
       <pre>
		function hello($name) {
			$rs = array(\'name\' => $name,\'status\' => \'OK\');
			echo stripslashes(json_encode($rs));
		}       
       </pre>
       ',

      'methods' => '
      <p><table id="miTabla">
		<th colspan="5">API</th>
		<tr>
			<td><strong>REQUEST</strong></td>
			<td><strong>ROUTE</strong></td>
			<td><strong>PARAMETERS</strong></td>
			<td><strong>DESCRIPTION / OUTPUT</strong></td>
			<td><strong>EXAMPLE</strong></td>
		</tr>
		<tr>
			<td>GET</td>
			<td>/API</td>
			<td>none</td>
			<td>Get API info</td>
			<td>http://localhost/siguapi/restGis.php/API/version</td>
		</tr>
	</table></p>
	
      <p><table id="miTabla">
		<th colspan="5">ZONAS</th>
		<tr>
			<td><strong>REQUEST</strong></td>
			<td><strong>ROUTE</strong></td>
			<td><strong>PARAMETERS</strong></td>
			<td><strong>DESCRIPTION / OUTPUT</strong></td>
			<td><strong>EXAMPLE</strong></td>
		</tr>
		<tr>
			<td>GET</td>
			<td>/zonas/list</td>
			<td>none</td>
			<td>Get zonas list</td>
			<td>http://localhost/siguapi/restGis.php/zonas/list</td>
		</tr>
		<tr>
			<td>POST</td>
			<td>/zonas/add</td>
			<td>none</td>
			<td>Add a zone</td>
			<td>curl -i -X POST -d "cod_zona=03&txt_zona=CAMPUS+DE+JOSE" http://localhost/siguapi/restGis.php/zonas/add</td>
		</tr>
		<tr>
			<td>DELETE</td>
			<td>/zonas/delete</td>
			<td>id: identificador de la zona</td>
			<td>Delete a zone</td>
			<td>curl -i -X DELETE http://(URL API)/zonas/delete/03</td>
		</tr>
		<tr>
			<td>POST</td>
			<td>/zonas/update</td>
			<td>none</td>
			<td>Update a zone name</td>
			<td>curl -i -X POST -d "cod_zona=03&txt_zona=CAMPUS+DE+PEPE" http://(url api)/zonas/update</td>
		</tr>						
	</table></p>

      <p><table id="miTabla">
		<th colspan="5">EDIFICIOS</th>
		<tr>
			<td><strong>REQUEST</strong></td>
			<td><strong>ROUTE</strong></td>
			<td><strong>PARAMETERS</strong></td>
			<td><strong>DESCRIPTION / OUTPUT</strong></td>
			<td><strong>EXAMPLE</strong></td>
		</tr>
		<tr>
			<td>GET</td>
			<td>/edificios/list</td>
			<td>none</td>
			<td>Get building list</td>
			<td>http://localhost/siguapi/restGis.php/edificios/list</td>
		</tr>
		<tr>
			<td>GET</td>
			<td>/edificios/ocupantes/list</td>
			<td>edificio: c&oacute;digo del edificio de 4 caracteres (ej. "0101")</td>
			<td>Get people list in a building </td>
			<td>http://localhost/siguapi/restGis.php/edificios/ocupantes/list/0101</td>
		</tr>
	</table></p>
	
	  <p><table id="miTabla">
		<th colspan="5">USOS</th>
		<tr>
			<td><strong>REQUEST</strong></td>
			<td><strong>ROUTE</strong></td>
			<td><strong>PARAMETERS</strong></td>
			<td><strong>DESCRIPTION / OUTPUT</strong></td>
			<td><strong>EXAMPLE</strong></td>
		</tr>
		<tr>
			<td>GET</td>
			<td>/actividades/list</td>
			<td>none</td>
			<td>Get land use list</td>
			<td>http://localhost/siguapi/restGis.php/actividades/list</td>
		</tr>
	</table></p>
	  <p><table id="miTabla">
		<th colspan="5">ESTANCIAS</th>
		<tr>
			<td><strong>REQUEST</strong></td>
			<td><strong>ROUTE</strong></td>
			<td><strong>PARAMETERS</strong></td>
			<td><strong>DESCRIPTION / OUTPUT</strong></td>
			<td><strong>EXAMPLE</strong></td>
		</tr>
		<tr>
			<td>GET</td>
			<td>/estancias/estancia/list</td>
			<td>codigo: codigo de estancia</td>
			<td>Get room detail</td>
			<td>http://localhost/siguapi/restGis.php/estancias/estancia/list/0001P1019</td>
		</tr>
		<tr>
			<td>GET</td>
			<td>/estancias/estancia/geometria</td>
			<td>codigo: codigo de estancia</td>
			<td>Get GeoJSON geometry</td>
			<td>http://localhost/siguapi/restGis.php/estancias/estancia/geometria/0001P1019</td>
		</tr>
		<tr>
			<td>GET</td>
			<td>/estancias/estancia/geojsonfull</td>
			<td>codigo: codigo de estancia</td>
			<td>Get full GeoJSON (geometry + attributes)</td>
			<td>http://localhost/siguapi/restGis.php/estancias/estancia/geojsonfull/0001P1019</td>
		</tr>		
		<tr>
			<td>GET</td>
			<td>/estancias/estancia/ocupantes</td>
			<td>codigo: codigo de estancia</td>
			<td>Get list of names that occuped this room</td>
			<td>http://localhost/siguapi/restGis.php/estancias/estancia/ocupantes/0002PB006</td>
		</tr>			
	</table></p>		
      <p><table id="miTabla">
		<th colspan="5">PERSONAL</th>
		<tr>
			<td><strong>REQUEST</strong></td>
			<td><strong>ROUTE</strong></td>
			<td><strong>PARAMETERS</strong></td>
			<td><strong>DESCRIPTION / OUTPUT</strong></td>
			<td><strong>EXAMPLE</strong></td>
		</tr>
		<tr>
			<td>GET</td>
			<td>/personal/persona/list</td>
			<td>id: NIF</td>
			<td>Get person details</td>
			<td>http://localhost/siguapi/restGis.php/personal/persona/list/12345678A</td>
		</tr>		
	</table></p>
		
     <p><table id="miTabla">
		<th colspan="5">DEPARTAMENTOS</th>
		<tr>
			<td><strong>REQUEST</strong></td>
			<td><strong>ROUTE</strong></td>
			<td><strong>PARAMETERS</strong></td>
			<td><strong>DESCRIPTION / OUTPUT</strong></td>
			<td><strong>EXAMPLE</strong></td>
		</tr>
		<tr>
			<td>GET</td>
			<td>/departamentos/list</td>
			<td>none</td>
			<td>Get departaments list</td>
			<td>http://localhost/siguapi/restGis.php/departamentos/list</td>
		</tr>
	</table></p>				
      ',
      'private' => '
           <p><table id="miTabla">
		<th colspan="5">ESTANCIAS</th>
		<tr>
			<td><strong>REQUEST</strong></td>
			<td><strong>ROUTE</strong></td>
			<td><strong>PARAMETERS</strong></td>
			<td><strong>DESCRIPTION / OUTPUT</strong></td>
			<td><strong>EXAMPLE</strong></td>
		</tr>
		<tr>
			<td>GET</td>
			<td>/private/estancias/estancia</td>
			<td>apikey: password<br>
			codigo: codigo de estancia
			</td>
			<td>Get room detail</td>
			<td>http://localhost/siguapi/restGis.php/private/estancias/estancia/abcde/0037P1015</td>
		</tr>
	</table></p>'
   );
    $app->render('doc.php',$data);
});

// OPTION REQUEST
$app->options('/personal/getDetallePer/:id', function ($id) {
    //Return response headers
});

// Public methods
$app->get('/API/version', 'getAPIversion');
$app->get('/zonas/list', 'getZonas');
$app->post('/zonas/add', 'addZona');
$app->delete('/zonas/delete/:id', 'deleteZona');
$app->post('/zonas/update', 'updateZona');
$app->get('/edificios/list', 'getEdificios');
$app->get('/edificios/ocupantes/list/:edificio', 'getOcupantesEdificio');
$app->get('/actividades/list', 'getActividades');
$app->get('/estancias/estancia/list/:codigo', 'getDetalleEst');
$app->get('/estancias/estancia/ocupantes/:codigo', 'getOcupantes');
$app->get('/estancias/estancia/geometria/:codigo', 'getEstGeom');
//$app->get('/estancias/estancia/infofull/:codigo', 'getEstInfoFull');
$app->get('/estancias/estancia/geojsonfull/:codigo', 'geojsonfull');
$app->get('/personal/persona/list/:id', 'getDetallePer');
$app->get('/departamentos/list', 'getDptos');


// slim call
$app->get('/private/estancias/estancia/:apikey/:codigo', 'verifyKey', 'APIgetDetalleEst', function () {});
// Example: http://localhost/siguapi/restGis.php/estancias/getDetalleEst/abcde/0037P1015


$app->run();

//function to connect to PostgreSQL using PDO
function conn() {
	include('config.php');
    $PDOconn = sprintf("pgsql:host=%s;port=5432;dbname=%s;user=%s;password=%s",$dbhost,$dbname,$dbuser,$dbpass);	
    $db_conn = new PDO($PDOconn);
    //$db_conn = new PDO('pgsql:host=localhost;port=5432;dbname=sigua;user=postgres;password=j3m');
    return $db_conn;
}



// Middleware
/* 
 * Middleware
 * API id is required
 * This middleware function validate an API id
 * For run create a table call apikeys
 * CREATE TABLE apikeys
 * (
 *   apikey character varying(100) NOT NULL,
 *   CONSTRAINT apikeys_pkey PRIMARY KEY (apikey )
 * )
 * Insert a long keys. Example
 * INSERT INTO apikeys VALUES (md5('12345'));
 * Get this value: "827ccb0eea8a706c4c34a16891f84e7b"
*/ 
function verifyKey(\Slim\Route $route) {
	try {
		$apikey = $route->getParam('apikey');
		$db_conn = conn(); 
		$sql = "select * from apikeys where apikey = :apikey LIMIT 1";
		$s =$db_conn->prepare($sql);
		$s->bindParam("apikey", $apikey);
		$s->execute();
		$keyVerification = $s->fetch(PDO::FETCH_OBJ);
		if($keyVerification == true) {
		} else {
			$result = array("status" => "error", "message" => "You need a valid API key.");
			echo json_encode($result);
			$app->stop();
		}
	} catch(PDOException $e) {
		$app->status(500);
		$result = array("status" => "error", "message" => 'Exception: ' . $e->getMessage());
		echo json_encode($result);
		$app->stop();
	}
}

function APIgetDetalleEst(\Slim\Route $route)  {
	try {
		$codigo = $route->getParam('codigo'); 	
		$db_conn = conn();
		$sql = 'SELECT * FROM webservices.info_estancia where codigoestancia=  :codigo'; 
		$record = $db_conn->prepare($sql);
		$row = $record->execute(array('codigo' => $codigo));
		$rs = $record->fetchAll(PDO::FETCH_ASSOC);
		echo json_encode($rs);
	} catch(\PDOException $e) {
		echo 'Exception: ' . $e->getMessage();
	}
} 







// PUBLIC METHODS



function getAPIversion() {
	$rs = array('version' => '1.0', 
			'author' => 'Jos&eacute; Manuel Mira',
			'response' => 'JSON',
			'URI' => 'http://localhost/siguapi/restGis.php',
			'status' => 'OK'			
		);
	header('Content-type: application/json');
	echo stripslashes(json_encode($rs));
}

function getActividades() {
	/*
	//Make documentation
	$doc = array(
		'version' => '1.0', 
		'author' => 'José Manuel Mira',
		'response' => 'JSON',
		'route' => '/actividades',
		'parameters' => 'none',	
		'method' => 'GET',	
		'URI' => 'http://localhost/siguapi/index.php',
		'test' => 'http://localhost/siguapi/index.php/actividades/getActividades'
		'info' => 'List all activities of Sigua database'
		'status' => 'OK'			
	);	
	$fp = fopen('docs.json', 'w');
	fwrite($fp, json_encode($doc));
	fclose($fp);*/
	
    $db_conn = conn();
    $sql = 'SELECT codactividad as codigo, txt_actividad as nombre FROM actividades order by codigo';
    $record = $db_conn->prepare($sql);
    $row = $record->execute();
    $rs = $record->fetchAll(PDO::FETCH_ASSOC);
    echo json_encode($rs);
}
function getZonas() {
    $db_conn = conn();
    $sql = 'SELECT cod_zona as codigo,txt_zona as nombre from zonas order by codigo';
    $record = $db_conn->prepare($sql);
    $row = $record->execute();
    $rs = $record->fetchAll(PDO::FETCH_ASSOC);
    header('Content-type: application/json');
    echo json_encode($rs);
}

function addZona() {
    $db_conn = conn();
    $return_a = array();    
    $request = \Slim\Slim::getInstance()->request();

    $cod_zona = $request->post('cod_zona');
    $txt_zona = $request->post('txt_zona');

    $sql_st = 'INSERT INTO zonas (cod_zona, txt_zona) VALUES(:cod_zona,:txt_zona)';
    $sql = $db_conn->prepare($sql_st);
    if ($sql->execute(array($cod_zona, $txt_zona))) {
        //$return_a = array('add' => 'inserted OK');
        $return_a = array('id' => $db_conn->lastInsertId());
    } else {
        $return_a = array('add' => 'failed');
    }
    echo json_encode($return_a);
}

function deleteZona($id) {
    $db_conn = conn();
    $sql_st = 'DELETE FROM zonas WHERE cod_zona= :id';
    try {
		$sql = $db_conn->prepare($sql_st);    
		if ($sql->execute(array($id))) {
			$msg = array('delete' => 'success');
			echo json_encode($msg);
		}
    } catch(PDOException $e) {
        echo '{"error":{"text":'. $e->getMessage() .'}}';
    }
}

function updateZona() {
    $db_conn = conn();
    $reqt = \Slim\Slim::getInstance()->request();
    $cod_zona = $reqt->post('cod_zona');
    $txt_zona = $reqt->post('txt_zona');


    $sql_st = 'Update zonas set txt_zona=:txt_zona WHERE cod_zona=:cod_zona';
    $update_array = array('cod_zona' => $cod_zona, 'txt_zona' => $txt_zona);

    $sql = $db_conn->prepare($sql_st);
    if ($sql->execute($update_array)) {
        echo json_encode($update_array);
    } else
    {		
		echo json_encode( array('error' => 'algo ha ocurrido mal') );
	}
}

function getEdificios() {
    $db_conn = conn();
    $sql = 'SELECT cod_zona||cod_edificio as codigo,txt_edificio as nombre from edificios order by codigo';
    $record = $db_conn->prepare($sql);
    $row = $record->execute();
    $rs = $record->fetchAll(PDO::FETCH_ASSOC);
    echo json_encode($rs);
}
function getDetalleEst($codigo) {
    $db_conn = conn();
    $sql = 'SELECT * FROM webservices.info_estancia WHERE codigoestancia = :codigo';
    $record = $db_conn->prepare($sql);
    $row = $record->execute(array('codigo' => $codigo));
    $rs = $record->fetchAll(PDO::FETCH_ASSOC);
    echo json_encode($rs);
}
function getOcupantes($codigo) {
	try {
		$db_conn = conn();
		$sql = 'SELECT count(*) FROM todaspersonas WHERE codigo = :codigo';
		$record = $db_conn->prepare($sql);
		$row = $record->execute(array('codigo' => $codigo));
		$rs = $record->fetch(PDO::FETCH_NUM);
		//echo json_encode( array('resultado' => $rs[0]) );
		if ($rs[0] > 0) {
			$sql = 'select p.nif,p.nombre || \' \' || p.apellido1 ||\' \'|| p.apellido2 as nombre from personal p, todaspersonas tp where p.nif=tp.nif and tp.codigo= :codigo';
			$record = $db_conn->prepare($sql);
			$row = $record->execute(array('codigo' => $codigo));
			$rs = $record->fetchAll(PDO::FETCH_ASSOC);
			header('Content-type: application/json');
			echo json_encode($rs);		
		}
		else {
			echo json_encode( array('warning' => 'This room is not occuped') );
		}
	} catch(PDOException $e) {
		$app->status(500);
		$result = array("status" => "error", "message" => 'Exception: ' . $e->getMessage());
		echo json_encode($result);
		$app->stop();
	}
}

function getOcupantesEdificio($edificio) {
	try {
		$db_conn = conn();
		//$sql = "SELECT count(*) FROM todaspersonas WHERE codigo LIKE '".$edificio."%'";
		$sql = 'SELECT count(*) FROM todaspersonas WHERE codigo LIKE :edificio';
		$record = $db_conn->prepare($sql);
		$row = $record->execute(array('edificio' => $edificio.'%'));
		$rs = $record->fetch(PDO::FETCH_NUM);
		//echo json_encode( array('resultado' => $rs[0]) );
		if ($rs[0] > 0) {
			//$sql = "select p.nif,p.nombre || ' ' || p.apellido1 ||' '|| p.apellido2 as nombre from personal p, todaspersonas tp where p.nif=tp.nif and tp.codigo LIKE '".$edificio."%'";
			$sql = 'select p.nif,p.nombre || \' \' || p.apellido1 ||\' 	\'|| p.apellido2 as nombre from personal p, todaspersonas tp where p.nif=tp.nif and tp.codigo LIKE :edificio';
			$record = $db_conn->prepare($sql);
			$row = $record->execute(array('edificio' => $edificio.'%'));
			$rs = $record->fetchAll(PDO::FETCH_ASSOC);
			header('Content-type: application/json');
			echo json_encode($rs);		
		}
		else {
			echo json_encode( array('warning' => 'This building is not occuped') );
		}
	} catch(PDOException $e) {
		$app->status(500);
		$result = array("status" => "error", "message" => 'Exception: ' . $e->getMessage());
		echo json_encode($result);
		$app->stop();
	}
}

function getDptos() {
    $db_conn = conn();
    $sql = 'SELECT * FROM departamentos';
    $record = $db_conn->prepare($sql);
    $row = $record->execute();
    $rs = $record->fetchAll(PDO::FETCH_ASSOC);
    echo json_encode($rs);
}

function getDetallePer($id) {
    $db_conn = conn();
	$sql = 'select * from webservices.info_persona where nifempleado = :id LIMIT 1';
    $record = $db_conn->prepare($sql);
    $row = $record->execute(array('id' => $id));
    $rs = $record->fetchAll(PDO::FETCH_ASSOC);
    echo json_encode($rs);
}

function getEstGeom($codigo) {
	try {
		$db_conn = conn();
		$sql = 'SELECT st_AsGeoJSON(st_transform(geometria,4326)) AS geometry FROM todasestancias WHERE codigo= :codigo LIMIT 1';
		$record = $db_conn->prepare($sql);
		$row = $record->execute(array('codigo' => $codigo));
		$rs = $record->fetchAll(PDO::FETCH_ASSOC);
		echo json_encode($rs);
	} catch(PDOException $e) {
		$app->status(500);
		$result = array("status" => "error", "message" => 'Exception: ' . $e->getMessage());
		echo json_encode($result);
		$app->stop();
	}
}

function getEstInfoFull($codigo) {
	try {
		$db_conn = conn();
		$sql = 'SELECT * FROM webservices.info_estancia WHERE codigoestancia = :codigo LIMIT 1';
		$record = $db_conn->prepare($sql);
		$row = $record->execute(array('codigo' => $codigo));
		$rs1 = $record->fetchAll(PDO::FETCH_ASSOC);

		$sql2 = 'SELECT st_AsGeoJSON(st_transform(geometria,4326)) As geometry FROM todasestancias WHERE codigo = :codigo LIMIT 1';
		$record2 = $db_conn->prepare($sql2);
		$row2 = $record2->execute(array('codigo' => $codigo));
		$rs2 = $record2->fetchAll(PDO::FETCH_ASSOC);
		$result = array("Type" => "Feature" ,"properties" => $rs1,"geometry" =>  $rs2[0]['geometry']);
		echo json_encode($result);		
	} catch(PDOException $e) {
		$app->status(500);
		$result = array("status" => "error", "message" => 'Exception: ' . $e->getMessage());
		echo json_encode($result);
		$app->stop();
	}
}

function geojsonfull($codigo) {
	try {
		// Source: https://github.com/bmcbride/PHP-Database-GeoJSON/blob/master/postgis_geojson.php
		$db_conn = conn();//SELECT *, public.ST_AsGeoJSON(public.ST_Transform((the_geom),4326)) as geojson FROM mytable
		$sql = "select * from webservices.info_estancia where codigoestancia = '".$codigo."' LIMIT 1";
		# Try query or error
		$rs = $db_conn->query($sql);
		if (!$rs) {
			echo 'An SQL error occured.\n';
			exit;
		}

		# Build GeoJSON feature collection array
		$geojson = array(
		   'type'      => 'FeatureCollection',
		   'features'  => array()
		);

		# Loop through rows to build feature arrays
		while ($row = $rs->fetch(PDO::FETCH_ASSOC)) {
			$properties = $row;
			# Remove geojson and geometry fields from properties
			unset($properties['geojson']);
			//unset($properties['geometria']);
			$feature = array(
				 'type' => 'Feature',
				 'geometry' => json_decode($row['geojson'], true),
				 'properties' => $properties
			);
			# Add feature arrays to feature collection array
			array_push($geojson['features'], $feature);
		}

		header('Content-type: application/json');
		echo json_encode($geojson, JSON_NUMERIC_CHECK);
		$db_conn = NULL;	
		
	} catch(PDOException $e) {
		$app->status(500);
		$result = array("status" => "error", "message" => 'Exception: ' . $e->getMessage());
		echo json_encode($result);
		$app->stop();
	}
}




?>
