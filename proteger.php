<?php
	session_start();
	if (!isset($_SESSION['nome'])){
		echo "<script>exibir_mensagem('Dados incorretos!', 'Algo deu errado')</script>";
		header("Location: login.php");
	}
?>