<?php
	require("../conexiones/conexion_bd.php");
	//Se inicia la variable session
	session_start();
	if(!isset($_SESSION['user'])){
		//Enviamos a login
		header("Location: login.php");
		die();
	}
	//Validamos si se quiere salir
	if(isset($_POST["logout"])){
		//Se le dio click al botón logout
		//Borro la session
		session_destroy();
		//Enviamos a login
		header("Location: login.php");
		die();
	}
	//Validamos si existe el id del alumno
	if(isset($_GET["id_usuario_b"])){
		$info_alumno = _select($con,$_GET["id_usuario_b"]);
		if(!$info_alumno){
			//No existe el registro
			header("Location: welcome.php");
			die();
		}
		//El registro si existe, entonces se procede a borrarlo
		_delete($con, $_GET["id_usuario_b"]);
		header("Location: welcome.php");
		die();
	}
	
	function _select($con, $id){
		//Seleccionar Registro
		$query_select = "Select * From alumnos WHERE id = '$id'";
		$result = $con->query($query_select);
		if($result->num_rows == 1){
			//Se cargan los valores
			$info = $result->fetch_assoc();
			return $info;
		}else{
			return false;
		}
	}
	
	function _delete($con, $id){
		//Borra un registro
		$query_delete = "Delete from alumnos Where id = '$id'";
		$result = $con->query($query_delete);
		if($result){
			echo "Realizó el Delete <br/>";
		}else{
			echo "No se pudo borrar";
		}
	}

?>