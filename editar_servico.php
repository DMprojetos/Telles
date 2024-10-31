<?php
require_once "../config/configtelles.php";
require_once "secure/acesso.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (
        isset($_POST['id_tipo']) && isset($_POST['nome_tipo']) && 
        isset($_POST['preco_tipo']) && isset($_POST['descricao']) && 
        isset($_POST['profissional']) && isset($_POST['profissional']) &&
        isset($_POST['pagamento']) && isset($_POST['id_agendamento'])
    ) {
        $ids = $_POST['id_tipo'];
        $nomes = $_POST['nome_tipo'];
        $precos = $_POST['preco_tipo'];
        $descricoes = $_POST['descricao'];
        $profissionais = $_POST['profissional'];
        $id_user = $_POST['id_user'];
        $pagamento = $_POST['pagamento'];
        $id_agendamento = $_POST['id_agendamento'];
        $data_ate = date("Y-m-d H:i:s"); // Define a data atual como a data do atendimento

        try {
            $pdo->beginTransaction();

            foreach ($ids as $index => $id) {
    $nome = $nomes[$index];
    $preco = $precos[$index];
    $descricao = $descricoes[$index];
    $profissional = ucwords(mb_strtolower(trim($profissionais[$index]), 'UTF-8')); // Converte para primeira letra maiúscula

    // Confirma o valor de $profissional após transformação
    error_log("Profissional formatado: $profissional"); // Registro para depuração

    // Atualiza a tabela tipos
    $sqlUpdate = "UPDATE tipos SET nome_tipo = ?, preco_tipo = ?, descricao = ?, profissional = ? WHERE id_tipo = ?";
    $stmtUpdate = $pdo->prepare($sqlUpdate);
    $stmtUpdate->execute([$nome, $preco, $descricao, $profissional, $id]);

    // Insere na tabela atendimentos
    $sqlInsert = "INSERT INTO atendimentos (id_tipo, nome_tipo, preco_tipo, descricao, profissional) VALUES (?, ?, ?, ?, ?)";
    $stmtInsert = $pdo->prepare($sqlInsert);
    $stmtInsert->execute([$id, $nome, $preco, $descricao, $profissional]);

    // Insere na tabela atendimentos com os campos adicionais
    $sqlInsertCompleto = "INSERT INTO atendimentos (tipo_ate, preco_ate, data_ate, id_user, profissional, pagamento, id_agendamento) VALUES (?, ?, ?, ?, ?, ?, ?)";
    $stmtInsertCompleto = $pdo->prepare($sqlInsertCompleto);
    $stmtInsertCompleto->execute([$nome, $preco, $data_ate, $id_user, $profissional, $pagamento, $id_agendamento]);
}


            $pdo->commit();
            header("Location: gerenciar.php?update_servicos=ok");
            exit();
        } catch (Exception $e) {
            $pdo->rollBack();
            header("Location: gerenciar.php?update_servicos=erro");
            exit();
        }
    } else {
        header("Location: gerenciar.php?update_servicos=erro");
        exit();
    }
}
?>
