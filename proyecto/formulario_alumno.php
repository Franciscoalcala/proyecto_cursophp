<?php
	$titulo = "Crear Alumno";
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
	
	/*********************Crear Alumno************************/
	//Validar si hay post
	if(isset($_POST["Crear"])){
		//Se crea el registro
		$resultado = _insert($con, $_POST["nombre_alumno"], $_POST["telefono_alumno"], $_POST["ciudad_alumno"]);
		echo $resultado;
	}
	
	function _insert($con, $nombre, $telefono, $ciudad){
		//Agrega un registro
		$query_insert = "INSERT INTO alumnos (nombre_alumno, telefono_alumno, ciudad_alumno) VALUES ('$nombre', '$telefono', '$ciudad');";
		$result = $con->query($query_insert);
		if($result){
			return "Se creo el nuevo registro <br/>";
		}else{
			return "No se pudo insertar el registro";
		}
	}
	/*********************************************************/
	/*********************Editar Alumno***********************/
	//Validamos si existe el id del alumno
	if(isset($_GET["id_usuario"])){
		$titulo = "Editar Alumno";
		$_GET["id_usuario"] = base64_decode($_GET["id_usuario"]);
		//Traemos la información del alumno en caso de que exista
		$info_alumno = _select($con,$_GET["id_usuario"]);
		if(!$info_alumno){
			//No existe el registro
			header("Location: welcome.php");
			die();
		}
		//Una ves obtenida la información se cargan los campos
		
		//Se valida si da submit al boton de editar
		//Validar si hay post
		if(isset($_POST["Editar"])){
			//Se Edita el registro
			$resultado = _update($con, $_POST["id_alumno"], $_POST["nombre_alumno"], $_POST["telefono_alumno"], $_POST["ciudad_alumno"]);
			header("Location: welcome.php");
			die();
		}
		
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
	
	function _update($con, $id_alumno, $nombre_alumno, $telefono_alumno, $ciudad_alumno){
		//Actualizar un registro
		$query_update = "Update alumnos Set nombre_alumno = '$nombre_alumno', telefono_alumno = '$telefono_alumno', ciudad_alumno = '$ciudad_alumno' Where id = '$id_alumno'";
		$result = $con->query($query_update);
		if($result){
			return "Se actualizó al alumno con éxito.";
		}else{
			return "No se pudo actualizar al alumno";
		}
	}
	/*********************************************************/
	
	
	include("header_view.php");
?>
<body class="hold-transition sidebar-mini">
	<?php include("menu_superior.php"); ?>
	<!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <!-- left column -->
		  <div class="col-md-3">
			<a href="welcome.php" class="btn btn-primary">Volver a Listado</a>
		  </div>
          <div class="col-md-6">
            <!-- jquery validation -->
            <div class="card card-primary">
              <div class="card-header">
                <h3 class="card-title">Formulario de Alumnos</h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
              <form id="quickForm2" method="POST" action="#">
                <div class="card-body">
                  <div class="form-group">
                    <label for="nombre_alumno">Nombre</label>
                    <input type="text" name="nombre_alumno" class="form-control" id="nombre_alumno" placeholder="Nombre del Alumno" value="<?php echo isset($info_alumno["nombre_alumno"]) ? $info_alumno["nombre_alumno"] : '' ?>">
                  </div>
                  <div class="form-group">
                    <label for="telefono_alumno">Teléfono</label>
                    <input type="text" name="telefono_alumno" class="form-control" id="telefono_alumno" placeholder="Teléfono del Alumno" value="<?php echo isset($info_alumno["telefono_alumno"]) ? $info_alumno["telefono_alumno"] : '' ?>">
                  </div>
				  <div class="form-group">
                    <label for="ciudad_alumno">Ciudad</label>
                    <input type="text" name="ciudad_alumno" class="form-control" id="ciudad_alumno" placeholder="Ciudad del Alumno" value="<?php echo isset($info_alumno["ciudad_alumno"]) ? $info_alumno["ciudad_alumno"] : '' ?>">
                  </div>
                </div>
                <!-- /.card-body -->
                <div class="card-footer">
					<!--Validamos si se muestra el botón de crear o el botón de editar -->
					<?php if(isset($_GET["id_usuario"])): ?>
					<!-- Se va a editar un usuario -->
					<input type="hidden" name="id_alumno" value="<?php echo isset($info_alumno["id"]) ? $info_alumno["id"] : '' ?>"/>
					<input type="submit" name="Editar" class="btn btn-primary btn-block" value="Editar" />
					<?php else: ?>
					<!-- Se va a crear un usuario -->
					<input type="submit" name="Crear" class="btn btn-primary btn-block" value="Crear" />
					<?php endif; ?>
                </div>
              </form>
            </div>
            <!-- /.card -->
            </div>
          <!--/.col (left) -->
          <!-- right column -->
          <div class="col-md-3">
		  </div>
          <!--/.col (right) -->
        </div>
        <!-- /.row -->
      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
<script>
	function salir(){
		var input = document.getElementById("logout");
		var form = document.getElementById("form_salir");
		input.value = "Salir";
		form.submit();
	}
</script>
<?php
	include("footer_view.php");
?>
