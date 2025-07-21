<?php
    $host = '15.228.223.139';   // IP do servidor MySQL na AWS
    $usuario = 'app_user';       // Aqui você coloca o nome do usuário que criou
    $senha = 'Sistema@sebo123.';  // A senha que você definiu para esse usuário
    $banco = 'bd_srv_livra';     // Nome do banco de dados que quer usar

    $conexao = new mysqli($host, $usuario, $senha, $banco);

    if ($conexao->connect_error) {
        die("Erro na conexão: " . $conexao->connect_error);
    }
?>