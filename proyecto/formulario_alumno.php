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
	<!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <!-- left column -->
		  <div class="col-md-3">
		  </div>
          <div class="col-md-6">
            <!-- jquery validation -->
            <div class="card card-primary">
              <div class="card-header">
                <h3 class="card-title">Formulario de Alumnos</h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
              <form id="quickForm">
                <div class="card-body">
                  <div class="form-group">
                    <label for="nombre_alumno">Nombre</label>
                    <input type="text" name="nombre_alumno" class="form-control" id="nombre_alumno" placeholder="Nombre del Alumno">
                  </div>
                  <div class="form-group">
                    <label for="telefono_alumno">Teléfono</label>
                    <input type="text" name="telefono_alumno" class="form-control" id="telefono_alumno" placeholder="Teléfono del Alumno">
                  </div>
				  <div class="form-group">
                    <label for="ciudad_alumno">Ciudad</label>
                    <input type="text" name="ciudad_alumno" class="form-control" id="ciudad_alumno" placeholder="Ciudad del Alumno">
                  </div>
                </div>
                <!-- /.card-body -->
                <div class="card-footer">
                  <button type="submit" class="btn btn-primary">Crear</button>
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
