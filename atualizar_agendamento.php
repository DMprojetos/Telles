<?php
require_once "../config/configtelles.php";

$data = json_decode(file_get_contents("php://input"), true);

if (isset($data['nome'], $data['telefone'], $data['dia'], $data['horario'], $data['status'], $data['profissional'])) {
    $consulta = $pdo->prepare("UPDATE agendamentosbaiano SET nome = :nome, telefone = :telefone, dia = :dia, horario = :horario, status = :status, profissional = :profissional");
    $consulta->bindParam(':nome', $data['nome']);
    $consulta->bindParam(':telefone', $data['telefone']);
    $consulta->bindParam(':dia', $data['dia']);
    $consulta->bindParam(':horario', $data['horario']);
    $consulta->bindParam(':status', $data['status']);
    $consulta->bindParam(':profissional', $data['profissional']);

    if ($consulta->execute()) {
        echo json_encode(['success' => true]);
    } else {
        echo json_encode(['success' => false, 'message' => 'Erro ao atualizar o agendamento.']);
    }
} else {
    echo json_encode(['success' => false, 'message' => 'Dados incompletos.']);
}
