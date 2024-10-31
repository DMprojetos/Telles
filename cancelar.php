<?php
require_once "../config/configtelles.php";

if (isset($_GET['id_agendamento'])) {
    $id_agendamento = $_GET['id_agendamento'];

    try {
        // Atualiza a consulta para a tabela correta
        $consulta = $pdo->prepare("DELETE FROM agendamentosbaiano WHERE id_agendamento = :id_agendamento");
        $consulta->bindParam(":id_agendamento", $id_agendamento, PDO::PARAM_INT);
        $consulta->execute();

        header("Location: agendados.php?cancelamento=ok");
        exit();
    } catch (Exception $e) {
        header("Location: agendados.php?erro=" . urlencode($e->getMessage()));
        exit();
    }
} else {
    header("Location: agendados.php?erro=agendamento_invalido");
    exit();
}
?>
