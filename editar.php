<?php
require_once "../config/configtelles.php";
require_once "secure/acesso.php";

$id = $_GET['id']; // Pega o ID do agendamento a ser editado

// Busca o agendamento no banco de dados usando PDO
$sql = "SELECT * FROM agendamentosbaiano WHERE id_agendamento = :id";
$stmt = $pdo->prepare($sql);
$stmt->bindParam(':id', $id, PDO::PARAM_INT);
$stmt->execute();
$agendamento = $stmt->fetch(PDO::FETCH_ASSOC);
?>

<!-- Botão para abrir o modal -->
<button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#editarModal">
    Editar Agendamento
</button>

<!-- Modal de edição -->
<div class="modal fade" id="editarModal" tabindex="-1" aria-labelledby="editarModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editarModalLabel">Concluir Agendamento</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="atualizar.php" method="POST">
                    <input type="hidden" name="id" value="<?php echo $agendamento['id_agendamento']; ?>">
                    
                    <div class="mb-3">
                        <label for="nome" class="form-label">Nome do Cliente:</label>
                        <input type="text" class="form-control" id="nome" name="nome" value="<?php echo htmlspecialchars($agendamento['nome']); ?>">
                    </div>
                    
                    <div class="mb-3">
                        <label for="telefone" class="form-label">Telefone:</label>
                        <input type="text" class="form-control" id="telefone" name="telefone" value="<?php echo htmlspecialchars($agendamento['telefone']); ?>">
                    </div>
                    
                    <div class="mb-3">
                        <label for="dia" class="form-label">Data do Agendamento:</label>
                        <input type="date" class="form-control" id="dia" name="dia" value="<?php echo htmlspecialchars($agendamento['dia']); ?>">
                    </div>
                    
                    <div class="mb-3">
                        <label for="horario" class="form-label">Horário:</label>
                        <input type="time" class="form-control" id="horario" name="horario" value="<?php echo htmlspecialchars($agendamento['horario']); ?>">
                    </div>
                    
                    <div class="mb-3">
                        <label for="status" class="form-label">Status:</label>
                        <input type="text" class="form-control" id="status" name="status" value="<?php echo htmlspecialchars($agendamento['status']); ?>">
                    </div>
                    
                    <div class="mb-3">
                        <label for="observacao" class="form-label">Observação:</label>
                        <input type="text" class="form-control" id="observacao" name="observacao" value="<?php echo htmlspecialchars($agendamento['observacao']); ?>">
                    </div>
                    
                    <div class="mb-3">
                        <label for="profissional" class="form-label">Profissional:</label>
                        <input type="text" class="form-control" id="profissional" name="profissional" value="<?php echo htmlspecialchars($agendamento['profissional']); ?>">
                    </div>
                    
                    <button type="submit" class="btn btn-primary">Salvar</button>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fechar</button>
            </div>
        </div>
    </div>
</div>

<!-- Bootstrap CSS e JS -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
