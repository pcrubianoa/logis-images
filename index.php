<?php

	function uploadImage($destino,$archivo) {
		// Archivos permitidos y tamaño
		$permitidos = array("image/jpg", "image/jpeg", "image/gif", "image/png");
		$limite_kb = 1000000;
		
		if (in_array($archivo['type'], $permitidos) && $archivo['size'] <= $limite_kb * 1024){
			// Ruta de destino
			//$ruta = "../assets/images/" . $_FILES['imagen']['name'];
			$name = date('mdyhis') . "-" . strtolower(str_replace(" ","-",$archivo['name']));
			$ruta = $_SERVER['DOCUMENT_ROOT'].$destino ."/". $name;
			//echo $ruta;
			// Verificar si el archivo existe
			if (!file_exists($ruta)){
				//Se mueve el archivo a la carpeta de destino
				$resultado = @move_uploaded_file($archivo["tmp_name"], $ruta);
				if ($resultado){
					//echo "El archivo ha sido movido exitosamente";
				} else {
					//echo "Ocurrio un error al mover el archivo.";
				}
			} else {
				//echo $_FILES['imagen']['name'] . ", este archivo existe";
				$resultado = @move_uploaded_file($archivo["tmp_name"], $ruta);
			}
		} else {
			//echo "Archivo no permitido, es tipo de archivo prohibido o excede el tamano de $limite_kb Kilobytes";
		}
		return $name;
	}
	
	function deleteImage ($destino,$archivo) {
		$ruta = $_SERVER['DOCUMENT_ROOT'].$destino ."/". $archivo;
		//echo $ruta;
		unlink($ruta);
	}

foreach ($_FILES as $key => $value) {
	if ($value['name']!='') {
		$nombre_imagen = uploadImage('/logis-images/cityu',$value);
	}
}


//API URL


function file_post_contents($url, $data, $username = null, $password = null)
{
	$postdata = http_build_query($data);
	
	$opts = array('http' =>
		array(
			'method'  => 'POST',
			'header'  => 'Content-type: application/x-www-form-urlencoded',
			'content' => $postdata
		)
	);
	
	if($username && $password)
	{
		$opts['http']['header'] = ("Authorization: Basic " . base64_encode("$username:$password"));
	}
	
	$context = stream_context_create($opts);
	return file_get_contents($url, false, $context);
}

$url = 'http://35.231.168.139/logis-images/receiver.php';
$data = file_post_contents($url,$_FILES);

echo $data);
/*
$ch = curl_init();
//curl_setopt($ch, CURLOPT_URL, "https://logis.com.co/api/web/formulario_sorteo.php?empresa=dev");
curl_setopt($ch, CURLOPT_URL, "http://35.231.168.139/logis-images/receiver.php");
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($ch, CURLOPT_POST, 1);
curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($_POST));
curl_setopt($ch, CURLOPT_HTTPHEADER,
	array(
		"Accept: application/json"
	));

$result = curl_exec ($ch);
$res = json_decode($result);
return $res;
*/

?>