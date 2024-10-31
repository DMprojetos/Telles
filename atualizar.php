<?php
require_once "../config/configtelles.php";

// Obtém os dados JSON enviados
$data = json_decode(file_get_contents("php://input"), true);

// Verifica se o ID do agendamento foi enviado
if (isset($data['id'])) {
    $fieldsToUpdate = [];
    $params = [':id' => $data['id']];

    // Checa e adiciona dinamicamente os campos enviados à query
    if (!empty($data['nome'])) {
        $fieldsToUpdate[] = "nome = :nome";
        $params[':nome'] = $data['nome'];
    }
    if (!empty($data['telefone'])) {
        $fieldsToUpdate[] = "telefone = :telefone";
        $params[':telefone'] = $data['telefone'];
    }
    if (!empty($data['dia'])) {
        $fieldsToUpdate[] = "dia = :dia";
        $params[':dia'] = $data['dia'];
    }
    if (!empty($data['horario'])) {
        $fieldsToUpdate[] = "horario = :horario";
        $params[':horario'] = $data['horario'];
    }
    if (!empty($data['status'])) {
        $fieldsToUpdate[] = "status = :status";
        $params[':status'] = $data['status'];
    }
    if (!empty($data['observacao'])) {
        $fieldsToUpdate[] = "observacao = :observacao";
        $params[':observacao'] = $data['observacao'];
    }
    if (!empty($data['profissional'])) {
        $fieldsToUpdate[] = "profissional = :profissional";
        $params[':profissional'] = $data['profissional'];
    }

    // Monta e executa a consulta dinâmica
    if (!empty($fieldsToUpdate)) {
        $sql = "UPDATE agendamentosbaiano SET " . implode(", ", $fieldsToUpdate) . " WHERE id_agendamento = :id";
        $consulta = $pdo->prepare($sql);

        if ($consulta->execute($params)) {
            echo json_encode(['success' => true]);
        } else {
            echo json_encode(['success' => false, 'message' => 'Erro ao atualizar o agendamento.']);
        }
    } else {
        echo json_encode(['success' => false, 'message' => 'Nenhum campo para atualizar.']);
    }
} else {
    echo json_encode(['success' => false, 'message' => 'ID do agendamento não fornecido.']);
}
?>
