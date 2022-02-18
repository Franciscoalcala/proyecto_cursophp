<!-- Navbar -->
  <nav class="navbar navbar-expand navbar-white navbar-light">
    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">
		<li class="nav-item">
			<div class="user-panel mt-3 pb-3 mb-3 d-flex">
				<div class="info">
				  <a href="#" class="d-block"><?php echo $_SESSION['user']; ?></a>
				</div>
			</div>
		</li>
		<li class="nav-item">
			<div>
				<input type="button" name="salir" class="btn btn-primary btn-block" value="Logout" onclick="salir()" />
				<form action="#" method="Post" id="form_salir">
					<input type="hidden" name="logout" value="" id="logout" />
				</form>
			</div>
		</li>
    </ul>
  </nav>
  <!-- /.navbar -->