<?php
    $host = 'db.ugifgqjdrxagkgdxtxex.supabase.co';
    $porta = '5432';
    $dbname = 'postgres';
    $usuario = 'postgres';
    $senha = 'LibreriaHonyasan.'; // coloque a senha que o Supabase gerou

    try {
        $conexao = new PDO("pgsql:host=$host;port=$porta;dbname=$dbname", $usuario, $senha);
        $conexao->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        echo "Conexão bem-sucedida!";
    } catch (PDOException $e) {
        echo "Erro na conexão: " . $e->getMessage();
    }
?>
