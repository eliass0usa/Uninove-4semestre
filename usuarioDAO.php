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

}else if ($acao == "insertHistorico"){

	$placa  = $_POST["placa"];
	$data = $_POST["data"];
	$valor = $_POST["valor"];
	$validade = $_POST["validade"];
	$mecanico = $_POST["mecanico"];
	$pecas = $_POST["pecas"];


	$sql = "insert into historico(id_carro_placa,data_servico,valor_cobrado,validade_garantia,mecanico_responsavel,pecas_compradas) values('$placa','$data','$valor','$validade','$mecanico','$pecas')";
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


	$sql = "select * from veiculos where placa=$placa";
	$resultado = mysqli_query($con,$sql);

	$linhas = [];
	while($row = mysqli_fetch_assoc($resultado)){
		$linhas[] = $row;
	}

	if ( sizeof($linhas) > 0 ) {

		$sql = "update veiculos set placa='$placa', fabricante='$marca', modelo='$modelo', tipo='$tipo' where placa=$placa";
		mysqli_query($con,$sql);

		if (mysqli_affected_rows($con)>0){
			echo "Dados atualizados com sucesso!";
			
		}else{
			echo "Não foi possível atualizar os dados!";
		}

	} else {

		$sql = "insert into veiculos(placa,id_proprietario,fabricante,modelo,tipo) values('$placa','$id_proprietario','$marca', '$modelo', '$tipo')";
		mysqli_query($con,$sql);
	
		if (mysqli_affected_rows($con)>0){
			echo "Inserido com sucesso!";
		}else{
			echo "Não foi possível inserir os dados!";
		}
	}

}else if ($acao == "select"){
	
	$sql = "select * from usuario";
	$resultado = mysqli_query($con,$sql);

	$linhas = [];
	while($row = mysqli_fetch_assoc($resultado)){
		$linhas[] = $row;
	}
	echo json_encode($linhas);

}else if ($acao == "selectCar"){
	$id = $_POST["id"];
	$sql = "select * from veiculos where placa=$id";
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

	// $sql = "select * from historico where id_carro_placa='$id'";
	$sql = "SELECT h.id AS historico_id, h.id_carro_placa, h.data_servico, h.valor_cobrado, h.validade_garantia, h.mecanico_responsavel, h.pecas_compradas, u.id AS usuario_id, u.nome
	FROM historico h
	JOIN veiculos v ON h.id_carro_placa = v.placa
	JOIN usuario u ON v.id_proprietario = u.id
	WHERE h.id_carro_placa = '$id'";

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

}else if ($acao == "deleteVeiculo"){
	
	$id  = $_POST["id"];

	$sql = "delete from veiculos where placa='$id'";
	mysqli_query($con,$sql);

	if (mysqli_affected_rows($con)>0){
		echo "Deletado com sucesso!";
	}else{
		echo "Não foi possível deletar os dados!";
	}

}else if ($acao == "deleteHistorico"){
	
	$id  = $_POST["id"];

	$sql = "delete from historico where id='$id'";
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
}else if ($acao == "updateHistorico"){

	$id    = $_POST["id"];
	$placa    = $_POST["placa"];
	$mecanico  = $_POST["mecanico"];
	$validade = $_POST["validade"];
	$valor = $_POST["valor"];
	$data = $_POST["data"];
	$pecas = $_POST["pecas"];

	$sql = "update historico set id_carro_placa='$placa', data_servico='$data', valor_cobrado='$valor', validade_garantia='$validade', mecanico_responsavel='$mecanico', pecas_compradas='$pecas' where id=$id";
	// "update veiculos set placa='$placa', fabricante='$marca', modelo='$modelo', tipo='$tipo' where placa=$placa";
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
		header("Location: login.php");
	}
}else if ($acao == "cadastro"){

	$nome = $_POST["nome"];
	$email = $_POST["email"];
	$senha = sha1($_POST["senha"]);

	

	$sql = "select * from usuario where email='{$email}'";
	$resultado = mysqli_query($con,$sql);

	$linhas = [];
	while($row = mysqli_fetch_assoc($resultado)){
		$linhas[] = $row;
	}
	
	if ( sizeof($linhas) > 0 ) {
		session_start();
		
		$_SESSION['erro'] = "O e-mail já esta sendo usado!";
		//  echo $_SESSION['erro']; 
		header("Location: cadastro.php");
	}else {
		echo $email; 

		
		session_start();
		$_SESSION['nome'] = $nome;

		$sql = "insert into usuario(nome,email,senha) values('$nome','$email','$senha')";
		mysqli_query($con,$sql);
		
		if (mysqli_affected_rows($con)>0){
			echo "Inserido com sucesso!";
		}else{
			echo "Não foi possível inserir os dados!";
		}
		
		header("Location: principal.php");
	}

}


?>
