<?php
    session_start();

    $host = 'db.ugifgqjdrxagkgdxtxex.supabase.co';
    $porta = '5432';
    $dbname = 'postgres';
    $usuario = 'postgres';
    $senha_bd = 'LibreriaHonyasan.';

    try {
        $conexao = new PDO("pgsql:host=$host;port=$porta;dbname=$dbname", $usuario, $senha_bd);
        $conexao->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    } catch (PDOException $e) {
        die("Erro na conexão: " . $e->getMessage());
    }

    $email = trim($_POST['emailUsuario'] ?? '');
    $senha = trim($_POST['senhaUsuario'] ?? '');

    if ($email && $senha) {
        $stmt = $conexao->prepare("SELECT id, email, senha FROM usuarios WHERE email = :email");
        $stmt->execute([':email' => $email]);
        $usuario = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($usuario) {
            if ($senha === $usuario['senha'] /* ou password_verify($senha, $usuario['senha']) */) {
                $_SESSION['usuario_id'] = $usuario['id'];
                $_SESSION['usuario_email'] = $usuario['email'];
                header("Location: /Trab/template/inicio/inicio.html");
                exit;
            } else {
                header("Location: /Trab/index.html?erro=senha");
                exit;
            }
        } else {
            header("Location: /Trab/index.html?erro=email");
            exit;
        }
    } else {
        header("Location: /Trab/index.html?erro=campos");
        exit;
    }
?>
