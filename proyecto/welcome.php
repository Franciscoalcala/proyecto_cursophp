<?php
	$titulo = "Bienvenida";
	include("header_view.php");
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
	//obtener los registros de los alumnos
	$alumnos = _select($con);
	
	
	function _select($con){
		//Seleccionar Registro
		$query_select = "Select * From alumnos";
		$result = $con->query($query_select);
		if($result->num_rows > 0){

		}
		
		return $result;
	}
?>
<body class="hold-transition sidebar-mini">
	<?php include("menu_superior.php"); ?>
	<div class="row">
          <div class="col-12">
            <div class="card">
              <div class="card-header">
                <h3 class="card-title">Tabla de Alumnos</h3>

                <div class="card-tools">
					<div class="input-group input-group-sm" style="width: 150px;">
						<a href="formulario_alumno.php" class="btn btn-primary">Crear</a>
					</div>
                </div>
              </div>
              <!-- /.card-header -->
              <div class="card-body table-responsive p-0">
                <table class="table table-hover text-nowrap">
                  <thead>
                    <tr>
                      <th>ID</th>
                      <th>Nombre</th>
                      <th>Teléfono</th>
                      <th>Ciudad</th>
					  <th>Opciones</th>
                    </tr>
                  </thead>
                  <tbody>
					<!-- Se realiza el ciclo para mostrar a los alumnos -->
					<?php foreach($alumnos as $alumno): ?>
                    <tr>
                      <td><?php echo $alumno['id']; ?></td>
                      <td><?php echo $alumno['nombre_alumno']; ?></td>
					  <td><?php echo $alumno['telefono_alumno']; ?></td>
                      <td><?php echo $alumno['ciudad_alumno']; ?></td>
					  <td>
						<input type="submit" name="editar" class="btn btn-info" value="Editar" onclick="editarAlumno('<?php echo base64_encode($alumno['id']); ?>')" />
						<input type="submit" name="borrar" class="btn btn-danger" value="Borrar" onclick="borrarAlumno('<?php echo base64_encode($alumno['id']); ?>')"/>
					  </td>
                    </tr>
					<?php endforeach; ?>
                  </tbody>
                </table>
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
          </div>
        </div>
		<form method="GET" id="form_editaAlumno" action="formulario_alumno.php">
			<input type="hidden" name="id_usuario" id="id_usuario" value="" />
		</form>
		<form method="GET" id="form_borrarAlumno" action="borrar_alumno.php">
			<input type="hidden" name="id_usuario_b" id="id_usuario_b" value="" />
		</form>
<script>
	function salir(){
		var input = document.getElementById("logout");
		var form = document.getElementById("form_salir");
		input.value = "Salir";
		form.submit();
	}
	
	function editarAlumno(id){
		var input = document.getElementById("id_usuario");
		var form = document.getElementById("form_editaAlumno");
		input.value = id;
		form.submit();
	}
	
	function borrarAlumno(id){
		var input = document.getElementById("id_usuario_b");
		var form = document.getElementById("form_borrarAlumno");
		input.value = id;
		form.submit();
	}
</script>
<?php
	include("footer_view.php");
?>
