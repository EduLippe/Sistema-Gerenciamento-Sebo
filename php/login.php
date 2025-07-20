<?php
    session_start();

    include 'conexao_bd.php';

    $email = trim($_POST['emailUsuario'] ?? '');
    $senha = trim($_POST['senhaUsuario'] ?? '');

    try {
        // Prepara a consulta no PostgreSQL
        $stmt = $conexao->prepare("SELECT id, email, senha FROM usuarios WHERE email = :email");
        $stmt->bindParam(':email', $email, PDO::PARAM_STR); // como eu fiz o DB no superbase precisa usar algumas coisas diferentes
        $stmt->execute();

        if ($stmt->rowCount() > 0) {
            $usuario = $stmt->fetch(PDO::FETCH_ASSOC);

            // Compara diretamente a senha
            if ($senha === $usuario['senha']) {
                $_SESSION['usuario_id'] = $usuario['id'];
                $_SESSION['usuario_email'] = $usuario['email'];
                header("Location: /Trab/template/inicio/inicio.html");
                exit;
            } 
            
            else {
                // Senha incorreta
                header("Location: /Trab/index.html");
                exit;
            }

        } else {
            // Email não encontrado
            header("Location: /Trab/index.html");
            exit;
        }

    } catch (PDOException $e) {
        echo "Erro: " . $e->getMessage();
    }

?>
