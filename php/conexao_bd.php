<?php
    $host = '15.228.223.139';      // ou 'localhost' se o PHP está na mesma máquina
    $usuario = 'root';             // ou um usuário específico, se você criou
    $senha = 'Sistema@sebo123.';
    $banco = 'bd_srv_livra';

    $conexao = new mysqli($host, $usuario, $senha, $banco);

    if ($conexao->connect_error) {
        die("Erro na conexão: " . $conexao->connect_error);
    }

    echo "Conexão bem-sucedida!";
?>
