<?php
    include 'conexao_bd.php';

    $titulo = trim($_POST['titulo'] ?? '');
    $cantor = trim($_POST['cantor'] ?? '');
    $faixas = intval($_POST['faixas'] ?? 0);
    $gravadora = trim($_POST['gravadora'] ?? '');
    $quantidadeRemover = intval($_POST['quantidade'] ?? 0);

    if ($titulo && $cantor && $faixas > 0 && $gravadora && $quantidadeRemover > 0) {
        try {
            // Verifica se o disco existe
            $stmt = $conexao->prepare("
                SELECT id, quantidade FROM discos 
                WHERE titulo = :titulo AND cantor = :cantor AND faixas = :faixas AND gravadora = :gravadora
            ");
            
            $stmt->execute([
                ':titulo' => $titulo,
                ':cantor' => $cantor,
                ':faixas' => $faixas,
                ':gravadora' => $gravadora
            ]);

            $disco = $stmt->fetch(PDO::FETCH_ASSOC);

            if ($disco) {
                
                if ($disco['quantidade'] >= $quantidadeRemover) {
                    // Atualiza a quantidade no banco
                    $novaQuantidade = $disco['quantidade'] - $quantidadeRemover;

                    $update = $conexao->prepare("
                        UPDATE discos SET quantidade = :quantidade WHERE id = :id
                    ");

                    $sucesso = $update->execute([
                        ':quantidade' => $novaQuantidade,
                        ':id' => $disco['id']
                    ]);

                    if ($sucesso) {
                        header("Location: /Trab/template/formulario/formulario_remover_discos.html");
                        exit;

                    } else {
                        header("Location: /Trab/template/formulario/formulario_remover_discos.html?erro=update");
                        exit;
                    }

                } else {
                    header("Location: /Trab/template/formulario/formulario_remover_discos.html?erro=quantidade_insuficiente");
                    exit;
                }
            } 
            
            else {
                header("Location: /Trab/template/formulario/formulario_remover_discos.html?erro=nao_encontrado");
                exit;
            }

        } catch (PDOException $e) {
            echo "Erro: " . $e->getMessage();
        }
    } 

    else {
        header("Location: /Trab/template/formulario/formulario_remover_discos.html?erro=campos_invalidos");
        exit;
    }
    
?>
