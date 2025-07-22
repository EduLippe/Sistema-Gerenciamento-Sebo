<?php
    $host = 'ec2-15-228-223-139.sa-east-1.compute.amazonaws.com'; // endpoint público do EC2
    $usuario = 'root';
    $senha = 'Sistema@sebo123.';
    $banco = 'bd_srv_livra';

    $conexao = new mysqli($host, $usuario, $senha, $banco);

    if ($conexao->connect_error) {
        die("Erro na conexão: " . $conexao->connect_error);
    }
?>
