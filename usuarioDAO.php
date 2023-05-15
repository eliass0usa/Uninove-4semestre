<?php

$servername = "localhost";
$username   = "root";
$password   = "";
$database   = "_aula_quinta_noite_20231";

$con = mysqli_connect($servername,$username,$password,$database);

$acao = $_POST["acao"];

if ($acao == "insert"){
	$nome  = $_POST["nome"];
	$email = $_POST["email"];
	$senha = sha1($_POST["senha"]);

	$sql = "insert into usuario(nome,email,senha) values('$nome','$email','$senha')";
	mysqli_query($con,$sql);

	if (mysqli_affected_rows($con)>0){
		echo "Inserido com sucesso!";
	}else{
		echo "Não foi possível inserir os dados!";
	}

}else if ($acao == "insertCarro"){
	$placa  = $_POST["placa"];
	$id_proprietario = $_POST["id"];
	$marca = $_POST["marca"];
	$modelo = $_POST["modelo"];
	$tipo = $_POST["tipo"];
	
	$sql = "insert into veiculos(placa,id_proprietario,fabricante,modelo,tipo) values('$placa','$id_proprietario','$marca', '$modelo', '$tipo')";
	mysqli_query($con,$sql);

	if (mysqli_affected_rows($con)>0){
		echo "Inserido com sucesso!";
	}else{
		echo "Não foi possível inserir os dados!";
	}

}else if ($acao == "select"){
	$sql = "select * from usuario";
	$resultado = mysqli_query($con,$sql);

	$linhas = [];
	while($row = mysqli_fetch_assoc($resultado)){
		$linhas[] = $row;
	}
	echo json_encode($linhas);

}else if ($acao == "veiculo"){

	$id  = $_POST["id"];

	$sql = "select * from veiculos where id_proprietario='$id'";
	$resultado = mysqli_query($con,$sql);

	$linhas = [];
	while($row = mysqli_fetch_assoc($resultado)){
		$linhas[] = $row;
	}
	echo json_encode($linhas);


}else if ($acao == "historico"){

	$id  = $_POST["id"];

	$sql = "select * from historico where id_veiculo='$id'";
	$resultado = mysqli_query($con,$sql);

	$linhas = [];
	while($row = mysqli_fetch_assoc($resultado)){
		$linhas[] = $row;
	}
	echo json_encode($linhas);


}else if ($acao == "delete"){
	
	$id  = $_POST["id"];

	$sql = "delete from usuario where id='$id'";
	mysqli_query($con,$sql);

	if (mysqli_affected_rows($con)>0){
		echo "Deletado com sucesso!";
	}else{
		echo "Não foi possível deletar os dados!";
	}

}else if ($acao == "update"){
	$id    = $_POST["id"];
	$nome  = $_POST["nome"];
	$email = $_POST["email"];
	$senha = sha1($_POST["senha"]);

	$sql = "update usuario set nome='$nome', email='$email', senha='$senha' where id=$id";
	mysqli_query($con,$sql);

	if (mysqli_affected_rows($con)>0){
		echo "Dados atualizados com sucesso!";
	}else{
		echo "Não foi possível atualizar os dados!";
	}
}else if ($acao == "login"){
	$email = $_POST["email"];
	$senha = sha1($_POST["senha"]);

	$sql = "select * from usuario where email='{$email}' and senha='{$senha}'";
	$resultado = mysqli_query($con,$sql);

	if($row = mysqli_fetch_assoc($resultado)){
		session_start();
		$_SESSION['nome'] = $row["nome"];

		header("Location: principal.php");
	}else{
		session_start();
		$_SESSION['erro'] = "Usuário ou senha inválida!";
		header("Location: index.php");
	}
}


?>
