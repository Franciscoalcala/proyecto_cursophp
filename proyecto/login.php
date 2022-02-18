<?php
	$titulo = "Login";
	include("header_view.php");
	require("../conexiones/conexion_bd.php");
	//Validar si hay post
	if(isset($_POST["entrar"])){
		//Se le dio click al botón
		_select($con, $_POST["clave"], base64_encode($_POST["pass"]));
	}else{
		//Se acaba de entrar en la página
		echo "bienvenido";
	}
	
	function _select($con, $clave, $pass){
		//Selecciono un registro
		$query_select = "Select * From profesores Where clave_profesor = '$clave' and (password = '$pass' or pass_temp = '$pass')";
		$result = $con->query($query_select);
		if($result->num_rows > 0){
			//Usuario y password Validos
			$usuario = $result->fetch_row();
			session_start();
			$_SESSION['user'] = $usuario[1];
			if($usuario[3] == ''){
				$_SESSION['password'] = $usuario[4];
			}else{
				$_SESSION['password'] = $usuario[3];
			}
			
			//Enviamos a la pagina de inicio
			header("Location: welcome.php");
			die();
			
		}else{
			//Usuario y/o password incorrectos
			echo '<strong style="color:red;">Error en las credenciales</strong>';
		}
	}
?>
<body class="hold-transition login-page">
<div class="login-box">
  <div class="login-logo">
    <b>Login</b>
  </div>
  <!-- /.login-logo -->
  <div class="card">
    <div class="card-body login-card-body">
      <p class="login-box-msg">Ingresa tus credenciales</p>

      <form action="#" method="post">
        <div class="input-group mb-3">
          <input type="text" class="form-control" placeholder="Clave" name="clave" value="<?php echo isset($_POST["clave"]) ? $_POST["clave"] : '' ?>" required>
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-edit"></span>
            </div>
          </div>
        </div>
        <div class="input-group mb-3">
          <input type="password" class="form-control" placeholder="Password" name="pass" id="pass" value="<?php echo isset($_POST["pass"]) ? $_POST["clave"] : '' ?>" required>
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-lock" onclick="mostrar_pass()" id="icono_pass"></span>
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-8">
            <div class="icheck-primary">
              <input type="checkbox" id="remember">
              <label for="remember">
                Recordarme
              </label>
            </div>
          </div>
          <!-- /.col -->
          <div class="col-4">
			<input type="submit" name="entrar" class="btn btn-primary btn-block" value="Ingresar" />
          </div>
          <!-- /.col -->
        </div>
      </form>

      <p class="mb-1">
        <a href="forgot-password.html">Olvidé mi contraseña</a>
      </p>
    </div>
    <!-- /.login-card-body -->
  </div>
</div>
<!-- /.login-box -->
<script>
	function mostrar_pass(){
		var input_pass = document.getElementById("pass");
		var icono = document.getElementById("icono_pass");
		
		if(icono.classList.contains("fa-lock")){
			icono.classList.remove("fa-lock");
			icono.classList.add("fa-lock-open");
			input_pass.type="text";
		}else{
			icono.classList.remove("fa-lock-open");
			icono.classList.add("fa-lock");
			input_pass.type="password";
		}
	}
</script>
<?php
	include("footer_view.php");
?>
