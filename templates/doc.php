<html>
<head>
   <title>Documentaci&oacute;n del servicio Rest Ful (restGis)</title>
   <style>
	#miTabla
	{
	font-family:"Trebuchet MS", Arial, Helvetica, sans-serif;
	width:100%;
	border-collapse:collapse;
	}
	#miTabla td, #miTabla th 
	{
	font-size:0.8em;
	border:1px solid #98bf21;
	padding:3px 7px 2px 7px;
	}
	#miTabla th 
	{
	font-size:1em;
	text-align:left;
	padding-top:5px;
	padding-bottom:4px;
	background-color:#A7C942;
	color:#fff;
	}
	#miTabla tr.alt td 
	{
	color:#000;
	background-color:#EAF2D3;
	}
</style>
</head>
<body>
   <h1><?php echo $heading; ?></h1>
   <h2>Introducci&oacute;n</h2>
   <p><?php echo $intro; ?></p>
   <h2>Acceso a datos</h2>
   <p><?php echo $source; ?></p>
   <h2>Crear nuevos m&eacute;todos</h2>
   <p><?php echo $example; ?></p>
   <h2>M&eacute;todos p&uacute;blicos</h2>   
   <p><?php echo $methods; ?></p>
   <h2>M&eacute;todos privados (middleware)</h2>
   <p>Estos m&eacute;todos son autentificados por una funci&oacute;n denominada verifyKey() que recibe 
   como argumento la password que en 
   este ejemplo es un registro de la tabla apikeys. S&iacute; la password es aceptada contin&uacute;a con la siguiente funci&oacute;n. Esta es su firma:</p> 
   <p><pre>$app->get('[route]/API/[apikey]/[parameter],[middleware function], [funtion to evaluate before autenticated] () {});</pre></p>  
    <p>Example
    <pre>$app->get('/private/estancias/estancia/:apikey/:codigo', 'verifyKey', 'APIgetDetalleEst', function () {});</pre></p>   
   <p><?php echo $private; ?></p>
   
</body>
</html>
