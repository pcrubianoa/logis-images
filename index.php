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
	echo $ruta;
	unlink($ruta);
}

uploadImage('cityu',$_FILES);

print_r($_POST);

?>