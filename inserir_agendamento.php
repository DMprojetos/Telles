<?php
require_once "../config/configtelles.php";

// Define o cabeçalho para JSON
header('Content-Type: application/json');

$data = json_decode(file_get_contents("php://input"), true);

if ($data) {
    try {
        $tipo_ate = $data['tipo_ate'];
        $pagamento = $data['pagamento'];
        $preco_ate = $data['preco_ate'];
        $data_ate = $data['data_ate'];
        $id_user = $data['id_user'];
        $profissional = $data['profissional'];
        $id_agendamento = $data['id_agendamento'];

        // Inicia a transação
        $pdo->beginTransaction();

        // Insere o atendimento na tabela atendimentos
        $consulta = $pdo->prepare("INSERT INTO atendimentos (tipo_ate, preco_ate, data_ate, id_user, pagamento, profissional, id_agendamento) VALUES (:tipo_ate, :preco_ate, :data_ate, :id_user, :pagamento, :profissional, :id_agendamento)");
        $consulta->bindParam(":tipo_ate", $tipo_ate);
        $consulta->bindParam(":preco_ate", $preco_ate);
        $consulta->bindParam(":data_ate", $data_ate);
        $consulta->bindParam(":id_user", $id_user);
        $consulta->bindParam(":pagamento", $pagamento);
        $consulta->bindParam(":profissional", $profissional);
        $consulta->bindParam(":id_agendamento", $id_agendamento);
        
        if ($consulta->execute()) {
            // Atualiza o status do agendamento para 'concluído'
            $consulta = $pdo->prepare("UPDATE agendamentosbaiano SET status = 'concluído' WHERE id_agendamento = :id_agendamento");
            $consulta->bindParam(":id_agendamento", $id_agendamento);
            $consulta->execute();

            $pdo->commit();
            echo json_encode(["success" => true, "message" => "Agendamento concluído com sucesso."]);
        } else {
            throw new Exception("Erro ao inserir o atendimento.");
        }
    } catch (Exception $e) {
        $pdo->rollBack();
        echo json_encode(["success" => false, "message" => $e->getMessage()]);
    }
} else {
    echo json_encode(["success" => false, "message" => "Dados inválidos."]);
}
?>
