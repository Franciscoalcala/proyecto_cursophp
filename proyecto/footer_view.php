<!-- jQuery -->
<script src="AdminLTE/plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="AdminLTE/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- jquery-validation -->
<script src="AdminLTE/plugins/jquery-validation/jquery.validate.min.js"></script>
<script src="AdminLTE/plugins/jquery-validation/additional-methods.min.js"></script>
<!-- AdminLTE App -->
<script src="AdminLTE/dist/js/adminlte.min.js"></script>
<!-- Page specific script -->
<script>
$(function () {
  $.validator.setDefaults({
    submitHandler: function () {
		$('#quickForm2').submit();
    }
  });
  $('#quickForm2').validate({
    rules: {
      nombre_alumno: {
        required: true,
      },
      telefono_alumno: {
        required: true,
        minlength: 10
      },
	  ciudad_alumno: {
        required: true,
      },
    },
    messages: {
      nombre_alumno: {
        required: "Favor de ingresar un nombre",
      },
      telefono_alumno: {
        required: "Favor de ingresar el teléfono",
        minlength: "El teléfono debe ser de al menos 10 digitos"
      },
      ciudad_alumno: {
        required: "Favor de ingresar la ciudad",
      }
    },
    errorElement: 'span',
    errorPlacement: function (error, element) {
      error.addClass('invalid-feedback');
      element.closest('.form-group').append(error);
    },
    highlight: function (element, errorClass, validClass) {
      $(element).addClass('is-invalid');
    },
    unhighlight: function (element, errorClass, validClass) {
      $(element).removeClass('is-invalid');
    }
  });
});
</script>



</body>
</html>