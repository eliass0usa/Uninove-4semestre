<?php

// Inicie o buffer de saída
ob_start();

$servername = "localhost";
$username   = "id22230495_root";
$password   = "Rootuninove@7";
$database   = "id22230495__aula_quinta_noite_20231";

$con = mysqli_connect($servername, $username, $password, $database);

$acao = $_POST["acao"];

if ($acao == "insert") {
    $nome  = $_POST["nome"];
    $email = $_POST["email"];
    $senha = sha1($_POST["senha"]);

    $sql = "INSERT INTO usuario(nome, email, senha) VALUES('$nome', '$email', '$senha')";
    mysqli_query($con, $sql);

    if (mysqli_affected_rows($con) > 0) {
        echo "Inserido com sucesso!";
    } else {
        echo "Não foi possível inserir os dados!";
    }

} elseif ($acao == "insertHistorico") {
    $placa    = $_POST["placa"];
    $data     = $_POST["data"];
    $valor    = $_POST["valor"];
    $validade = $_POST["validade"];
    $mecanico = $_POST["mecanico"];
    $pecas    = $_POST["pecas"];

    $sql = "INSERT INTO historico(id_carro_placa, data_servico, valor_cobrado, validade_garantia, mecanico_responsavel, pecas_compradas) 
            VALUES('$placa', '$data', '$valor', '$validade', '$mecanico', '$pecas')";
    mysqli_query($con, $sql);

    if (mysqli_affected_rows($con) > 0) {
        echo "Inserido com sucesso!";
    } else {
        echo "Não foi possível inserir os dados!";
    }

} elseif ($acao == "insertCarro") {
    $placa           = $_POST["placa"];
    $id_proprietario = $_POST["id"];
    $marca           = $_POST["marca"];
    $modelo          = $_POST["modelo"];
    $tipo            = $_POST["tipo"];

    $sql = "SELECT * FROM veiculos WHERE placa='$placa'";
    $resultado = mysqli_query($con, $sql);

    $linhas = [];
    while ($row = mysqli_fetch_assoc($resultado)) {
        $linhas[] = $row;
    }

    if (sizeof($linhas) > 0) {
        $sql = "UPDATE veiculos SET fabricante='$marca', modelo='$modelo', tipo='$tipo' WHERE placa='$placa'";
        mysqli_query($con, $sql);

        if (mysqli_affected_rows($con) > 0) {
            echo "Dados atualizados com sucesso!";
        } else {
            echo "Não foi possível atualizar os dados!";
        }

    } else {
        $sql = "INSERT INTO veiculos(placa, id_proprietario, fabricante, modelo, tipo) 
                VALUES('$placa', '$id_proprietario', '$marca', '$modelo', '$tipo')";
        mysqli_query($con, $sql);

        if (mysqli_affected_rows($con) > 0) {
            echo "Inserido com sucesso!";
        } else {
            echo "Não foi possível inserir os dados!";
        }
    }

} elseif ($acao == "select") {
    $sql = "SELECT * FROM usuario";
    $resultado = mysqli_query($con, $sql);

    $linhas = [];
    while ($row = mysqli_fetch_assoc($resultado)) {
        $linhas[] = $row;
    }
    echo json_encode($linhas);

} elseif ($acao == "selectCar") {
    $id = $_POST["id"];
    $sql = "SELECT * FROM veiculos WHERE placa='$id'";
    $resultado = mysqli_query($con, $sql);

    $linhas = [];
    while ($row = mysqli_fetch_assoc($resultado)) {
        $linhas[] = $row;
    }
    echo json_encode($linhas);

} elseif ($acao == "veiculo") {
    $id = $_POST["id"];

    $sql = "SELECT * FROM veiculos WHERE id_proprietario='$id'";
    $resultado = mysqli_query($con, $sql);

    $linhas = [];
    while ($row = mysqli_fetch_assoc($resultado)) {
        $linhas[] = $row;
    }
    echo json_encode($linhas);

} elseif ($acao == "historico") {
    $id = $_POST["id"];

    $sql = "SELECT h.id AS historico_id, h.id_carro_placa, h.data_servico, h.valor_cobrado, h.validade_garantia, h.mecanico_responsavel, h.pecas_compradas, 
                   u.id AS usuario_id, u.nome
            FROM historico h
            JOIN veiculos v ON h.id_carro_placa = v.placa
            JOIN usuario u ON v.id_proprietario = u.id
            WHERE h.id_carro_placa = '$id'";
    $resultado = mysqli_query($con, $sql);

    $linhas = [];
    while ($row = mysqli_fetch_assoc($resultado)) {
        $linhas[] = $row;
    }
    echo json_encode($linhas);

} elseif ($acao == "delete") {
    $id = $_POST["id"];

    $sql = "DELETE FROM usuario WHERE id='$id'";
    mysqli_query($con, $sql);

    if (mysqli_affected_rows($con) > 0) {
        echo "Deletado com sucesso!";
    } else {
        echo "Não foi possível deletar os dados!";
    }

} elseif ($acao == "deleteVeiculo") {
    $id = $_POST["id"];

    $sql = "DELETE FROM veiculos WHERE placa='$id'";
    mysqli_query($con, $sql);

    if (mysqli_affected_rows($con) > 0) {
        echo "Deletado com sucesso!";
    } else {
        echo "Não foi possível deletar os dados!";
    }

} elseif ($acao == "deleteHistorico") {
    $id = $_POST["id"];

    $sql = "DELETE FROM historico WHERE id='$id'";
    mysqli_query($con, $sql);

    if (mysqli_affected_rows($con) > 0) {
        echo "Deletado com sucesso!";
    } else {
        echo "Não foi possível deletar os dados!";
    }

} elseif ($acao == "update") {
    $id    = $_POST["id"];
    $nome  = $_POST["nome"];
    $email = $_POST["email"];
    $senha = sha1($_POST["senha"]);

    $sql = "UPDATE usuario SET nome='$nome', email='$email', senha='$senha' WHERE id='$id'";
    mysqli_query($con, $sql);

    if (mysqli_affected_rows($con) > 0) {
        echo "Dados atualizados com sucesso!";
    } else {
        echo "Não foi possível atualizar os dados!";
    }

} elseif ($acao == "updateHistorico") {
    $id       = $_POST["id"];
    $placa    = $_POST["placa"];
    $mecanico = $_POST["mecanico"];
    $validade = $_POST["validade"];
    $valor    = $_POST["valor"];
    $data     = $_POST["data"];
    $pecas    = $_POST["pecas"];

    $sql = "UPDATE historico SET id_carro_placa='$placa', data_servico='$data', valor_cobrado='$valor', validade_garantia='$validade', mecanico_responsavel='$mecanico', pecas_compradas='$pecas' WHERE id='$id'";
    mysqli_query($con, $sql);

    if (mysqli_affected_rows($con) > 0) {
        echo "Dados atualizados com sucesso!";
    } else {
        echo "Não foi possível atualizar os dados!";
    }

} elseif ($acao == "login") {
    $email = $_POST["email"];
    $senha = sha1($_POST["senha"]);

    $sql = "SELECT * FROM usuario WHERE email='$email' AND senha='$senha'";
    $resultado = mysqli_query($con, $sql);

    if ($row = mysqli_fetch_assoc($resultado)) {
        session_start();
        $_SESSION['nome'] = $row["nome"];

        header("Location: principal.php");
        exit(); // Garanta que o script pare após o redirecionamento
    } else {
        session_start();
        $_SESSION['erro'] = "Usuário ou senha inválida!";
        header("Location: login.php");
        exit(); // Garanta que o script pare após o redirecionamento
    }

} elseif ($acao == "cadastro") {
    $nome  = $_POST["nome"];
    $email = $_POST["email"];
    $senha = sha1($_POST["senha"]);

    $sql = "SELECT * FROM usuario WHERE email='$email'";
    $resultado = mysqli_query($con, $sql);

    $linhas = [];
    while ($row = mysqli_fetch_assoc($resultado)) {
        $linhas[] = $row;
    }

    if (sizeof($linhas) > 0) {
        session_start();
        $_SESSION['erro'] = "O e-mail já está sendo usado!";
        header("Location: cadastro.php");
        exit(); // Garanta que o script pare após o redirecionamento
    } else {
        session_start();
        $_SESSION['nome'] = $nome;

        $sql = "INSERT INTO usuario(nome, email, senha) VALUES('$nome', '$email', '$senha')";
        mysqli_query($con, $sql);

        if (mysqli_affected_rows($con) > 0) {
            echo "Inserido com sucesso!";
        } else {
            echo "Não foi possível inserir os dados!";
        }

        header("Location: ../");
        exit(); // Garanta que o script pare após o redirecionamento
    }
}

// Termine o buffer de saída e envie a saída
ob_end_flush();

?>
