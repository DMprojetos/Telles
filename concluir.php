<?php
require_once "../config/configtelles.php";

// Verifica se o id do agendamento foi passado
if (isset($_GET['id_agendamento'])) {
    $id_agendamento = $_GET['id_agendamento'];

    try {
        // Inicia a transação
        $pdo->beginTransaction();

        // 1. Atualiza o status do agendamento para 'concluído'
        $consulta = $pdo->prepare("UPDATE agendamentosbaiano SET status = 'concluído' WHERE id_agendamento = :id_agendamento");
        $consulta->bindParam(":id_agendamento", $id_agendamento, PDO::PARAM_INT);
        $consulta->execute();

        // 2. Obtém os detalhes do agendamento (tipo, preço, id do cliente)
        $consulta_agendamento = $pdo->prepare("SELECT id_tipo AS tipo, preco_ate AS preco, id_cliente FROM agendamentosbaiano WHERE id_agendamento = :id_agendamento");
        $consulta_agendamento->bindParam(":id_agendamento", $id_agendamento, PDO::PARAM_INT);
        $consulta_agendamento->execute();
        $detalhes_agendamento = $consulta_agendamento->fetch(PDO::FETCH_ASSOC);

        if ($detalhes_agendamento) {
            // Verifica se os campos obrigatórios foram retornados
            $tipo_ate = $detalhes_agendamento['tipo'] ?? null;  
            $preco_ate = $detalhes_agendamento['preco'] ?? null;
            $data_ate = date("Y-m-d H:i:s"); // Data e hora atual
            $id_user = $detalhes_agendamento['id_cliente'] ?? null;
            $pagamento = "Não especificado"; // Ajuste conforme a lógica de pagamento

            if (is_null($tipo_ate) || is_null($preco_ate) || is_null($id_user)) {
                throw new Exception("Dados incompletos para inserção no atendimento.");
            }

            // 4. Insere o atendimento na tabela atendimentos
            $inserir_atendimento = $pdo->prepare("
                INSERT INTO atendimentos (tipo_ate, preco_ate, data_ate, id_user, pagamento) 
                VALUES (:tipo_ate, :preco_ate, :data_ate, :id_user, :pagamento)
            ");
            $inserir_atendimento->bindParam(":tipo_ate", $tipo_ate, PDO::PARAM_STR);
            $inserir_atendimento->bindParam(":preco_ate", $preco_ate, PDO::PARAM_STR);
            $inserir_atendimento->bindParam(":data_ate", $data_ate, PDO::PARAM_STR);
            $inserir_atendimento->bindParam(":id_user", $id_user, PDO::PARAM_INT);
            $inserir_atendimento->bindParam(":pagamento", $pagamento, PDO::PARAM_STR);

            // Execute a inserção
            $inserir_atendimento->execute();

            // Verifica se a inserção foi bem-sucedida
            if ($inserir_atendimento->rowCount() === 0) {
                throw new Exception("Falha na inserção do atendimento.");
            }
        } else {
            throw new Exception("Agendamento não encontrado.");
        }

        // Confirma a transação
        $pdo->commit();

        header("Location: agendados.php?conclusao=ok");
        exit();
    } catch (Exception $e) {
        // Reverte a transação se algo der errado
        $pdo->rollBack();
        header("Location: agendados.php?erro=" . urlencode($e->getMessage()));
        exit();
    } catch (PDOException $e) {
        echo "Erro no banco de dados: " . $e->getMessage();
        exit();
    }
} else {
    header("Location: agendados.php?erro=agendamento_invalido");
    exit();
}
?>
