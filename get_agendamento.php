<?php
require_once "../config/configtelles.php";

$id = $_GET['id'] ?? null;

if ($id) {
    $consulta = $pdo->prepare("SELECT nome, dia, telefone, horario, status, profissional FROM agendamentosbaiano
    $consulta->bindParam(':id', $id, PDO::PARAM_INT);

    if ($consulta->execute()) {
        $resultado = $consulta->fetch(PDO::FETCH_ASSOC);
        if ($resultado) {
            echo json_encode(['success' => true, 'data' => $resultado]);
        } else {
            echo json_encode(['success' => false, 'message' => 'Agendamento não encontrado.']);
        }
    } else {
        echo json_encode(['success' => false, 'message' => 'Erro ao buscar o agendamento.']);
    }
} else {
    echo json_encode(['success' => false, 'message' => 'ID do agendamento não fornecido.']);
}
?>
