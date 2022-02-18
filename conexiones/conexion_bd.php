<?php
	$con = new mysqli("localhost", "root", "", "cursophp");
	if($con->connect_errno){
		echo "Falló al conectar a la BD cursophp. Error: ". $con->connect_errno. "<br/>". $con->connect_error;
	}
	
	$con2 = new mysqli("127.0.0.1", "instructor", "123456", "cursophp");
	if($con2->connect_errno){
		echo "Falló al conectar a la BD cursophp. Error: ". $con2->connect_errno. "<br/>". $con2->connect_error;
	}
?>