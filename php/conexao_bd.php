<?php
    $host = 'localhost';     // IP do servidor remoto onde está o MySQL
    $usuario = 'root';             // usuário MySQL remoto
    $senha = 'Sistema@sebo123.';   // senha correta para esse usuário no servidor remoto
    $banco = 'bd_soft_livr';       // nome do banco no servidor remoto

    $conexao = new mysqli($host, $usuario, $senha, $banco);

    if ($conexao->connect_error) {
        die("Erro na conexão: " . $conexao->connect_error);
    }
    echo "Conexão bem sucedida ao banco remoto!";
?>