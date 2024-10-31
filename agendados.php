<?php
require_once "../config/configtelles.php";
require_once "secure/acesso.php";

// Obtém o ID do usuário logado
$id = $_SESSION['id_log'];

// Consulta as informações do usuário
$consulta = $pdo->prepare("SELECT * FROM usuarios WHERE id_user = :id_user");
$consulta->bindParam(':id_user', $id);
$consulta->execute();
$resultado_user = $consulta->fetch(PDO::FETCH_ASSOC);

// Consulta os agendamentos
$consulta = $pdo->prepare("SELECT * FROM agendamentosbaiano");
$consulta->execute();
$resultado = $consulta->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">

    <title>Barbearia</title>
    <meta content="" name="description">
    <meta content="" name="keywords">

    <!-- Favicons -->
    <link href="../assets/img/favicon.png" rel="icon">
    <link href="../assets/img/apple-touch-icon.png" rel="apple-touch-icon">

    <!-- Google Fonts -->
    <link href="https://fonts.gstatic.com" rel="preconnect">
    <link
        href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Nunito:300,300i,400,400i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i"
        rel="stylesheet">

    <!-- Vendor CSS Files -->
    <link href="../assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="../assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
    <link href="../assets/vendor/boxicons/css/boxicons.min.css" rel="stylesheet">
    <link href="../assets/vendor/quill/quill.snow.css" rel="stylesheet">
    <link href="../assets/vendor/quill/quill.bubble.css" rel="stylesheet">
    <link href="../assets/vendor/remixicon/remixicon.css" rel="stylesheet">
    <link href="../assets/vendor/simple-datatables/style.css" rel="stylesheet">

    <!-- Template Main CSS File -->
    <link href="../assets/css/style.css" rel="stylesheet">
    
    
</head>




<body>
<header id="header" class="header fixed-top d-flex align-items-center">

        <div class="d-flex align-items-center justify-content-between">
            <a href="index.php" class="logo d-flex align-items-center">
                <img src="../assets/img/download.ico" alt="">
                <span class="d-none d-lg-block"><?php echo $resultado_user['barbearia_user']; ?></span>
            </a>
            <i class="bi bi-list toggle-sidebar-btn"></i>
        </div><!-- End Logo -->

        <nav class="header-nav ms-auto">
            <ul class="d-flex align-items-center">

                <li class="nav-item d-block d-lg-none">
                    <a class="nav-link nav-icon search-bar-toggle " href="#">
                        <i class="bi bi-search"></i>
                    </a>
                </li><!-- End Search Icon-->
                <li class="nav-item dropdown pe-3">

                    <a class="nav-link nav-profile d-flex align-items-center pe-0" href="#" data-bs-toggle="dropdown">
                        <img src="../assets/img/logotelles.png" class="rounded-circle">
                        <span
                            class="d-none d-md-block dropdown-toggle ps-2"><?php echo $resultado_user['nome_user']; ?></span>
                    </a><!-- End Profile Iamge Icon -->

                    <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow profile">
                        <li class="dropdown-header">
                            <h6><?php echo $resultado_user['nome_user']; ?></h6>
                            <span><?php echo $resultado_user['profissao_user']; ?></span>
                        </li>
                        <li>
                            <hr class="dropdown-divider">
                        </li>

                        <li>
                            <a class="dropdown-item d-flex align-items-center" href="users-profile.html">
                                <i class="bi bi-person"></i>
                                <span>Meu perfil</span>
                            </a>
                        </li>
                        <li>
                            <hr class="dropdown-divider">
                        </li>

                        <li>
                            <a class="dropdown-item d-flex align-items-center" href="users-profile.html">
                                <i class="bi bi-gear"></i>
                                <span>configurações da conta</span>
                            </a>
                        </li>
                        <li>
                            <hr class="dropdown-divider">
                        </li>

                        <li>
                            <a class="dropdown-item d-flex align-items-center" href="pages-faq.html">
                                <i class="bi bi-question-circle"></i>
                                <span>Precisa de ajuda?</span>
                            </a>
                        </li>
                        <li>
                            <hr class="dropdown-divider">
                        </li>

                        <li>
                            <a class="dropdown-item d-flex align-items-center" href="sair.php">
                                <i class="bi bi-box-arrow-right"></i>
                                <span>Sair</span>
                            </a>
                        </li>

                    </ul><!-- End Profile Dropdown Items -->
                </li><!-- End Profile Nav -->

            </ul>
        </nav><!-- End Icons Navigation -->
    </header>

<aside id="sidebar" class="sidebar">
    <ul class="sidebar-nav" id="sidebar-nav">
        <li class="nav-item">
            <a class="nav-link <?php echo basename($_SERVER['PHP_SELF']) == 'index.php' ? '' : 'collapsed'; ?>" href="index.php">
                <i class="bi bi-grid"></i>
                <span>Início</span>
            </a>
        </li>

        <li class="nav-item">
            <a class="nav-link <?php echo basename($_SERVER['PHP_SELF']) == 'agendados.php' ? '' : 'collapsed'; ?>" href="agendados.php">
                <i class="bi bi-calendar"></i>
                <span>Agendamentos</span>
            </a>
        </li>

        <li class="nav-item">
            <a class="nav-link <?php echo basename($_SERVER['PHP_SELF']) == 'atendimentos.php' ? '' : 'collapsed'; ?>" href="atendimentos.php">
                <i class="bi bi-briefcase"></i>
                <span>Atendimentos</span>
            </a>
        </li>

        <li class="nav-item">
            <a class="nav-link <?php echo basename($_SERVER['PHP_SELF']) == 'relatorios.php' ? '' : 'collapsed'; ?>" href="relatorios.php">
                <i class="bi bi-file-earmark-text"></i>
                <span>Relatórios</span>
            </a>
        </li>

        <li class="nav-item">
            <a class="nav-link <?php echo basename($_SERVER['PHP_SELF']) == 'perfil.php' ? '' : 'collapsed'; ?>" href="perfil.php">
                <i class="bi bi-person"></i>
                <span>Perfil</span>
            </a>
        </li>

        <li class="nav-item">
            <a class="nav-link <?php echo basename($_SERVER['PHP_SELF']) == 'sair.php' ? '' : 'collapsed'; ?>" href="sair.php">
                <i class="bi bi-box-arrow-in-right"></i>
                <span>Sair</span>
            </a>
        </li>
    </ul>
</aside>


    <main id="main" class="main">
        <div class="pagetitle">
            <h1>Agendados</h1>
        </div>

        <section class="section dashboard">
            <div class="row">
                <div class="col-md-12">
                    <div class="card info-card sales-card">
                        <div class="card-body">
                            <h5 class="card-title">Telles</h5>
                            
                            <div class="table-responsive">

                              <table class="table-responsive">
                                <thead>
                                    <tr>
                                        <th>Nome do Cliente</th>
                                        <th>Telefone</th>
                                        <th>Data do Agendamento</th>
                                        <th>Status</th>
                                        <th>Profissional</th>
                                        <th>Ações</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    if (!empty($resultado)) {
                                        foreach ($resultado as $row) {
                                            echo "<tr>
                                                <td>{$row['nome']}</td>
                                                <td>{$row['telefone']}</td>
                                                <td>{$row['dia']} {$row['horario']}</td>
                                                <td>{$row['status']}</td>
                                                <td>{$row['profissional']}</td>
                                                <td>
                                                    <button class='btn btn-danger btn-sm' onclick=\"window.location.href='cancelar.php?id_agendamento={$row['id_agendamento']}'\">Excluir</button>
                                                    <button class='btn btn-warning' data-bs-toggle='modal' data-bs-target='#editarModal' onclick='loadEditForm(" . json_encode($row) . ")'>Editar</button>
                                                    <button class='btn btn-success btn-sm' data-bs-toggle='modal' data-bs-target='#concluirModal' onclick='setAgendamentoId({$row['id_agendamento']})'>Concluir</button>
                                                </td>
                                            </tr>";
                                        }
                                    } else {
                                        echo "<tr><td colspan='6'>Nenhum agendamento encontrado.</td></tr>";
                                    }
                                    ?>
                                    </tbody>
                               </table>
                            </div>
                    </div>
                </div>
            </div>
        </section>

        <div class="modal" id="concluirModal" tabindex="-1" aria-labelledby="concluirModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="concluirModalLabel">Concluir Agendamento</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
    <form id="concluirForm">
        <div class="mb-3">
            <label for="tipoServico" class="form-label">Tipo de Serviço</label>
            <select class="form-select" id="tipoServico" onchange="atualizarPreco()" required>
                <option value="">Selecione um serviço</option>
                <option value="1" data-preco="35.00">Corte de Cabelo</option>
                <option value="2" data-preco="25.00">Barba</option>
                <option value="3" data-preco="10.00">Sobrancelha</option>
                <option value="4" data-preco="55.00">Cabelo e Barba</option>
                <option value="5" data-preco="60.00">Cabelo, Sobrancelha e Barba</option>
                <option value="5" data-preco="45.00">Cabelo e Sobrancelha</option>
                <option value="5" data-preco="35.00">Sobrancelha e Barba</option>
            </select>
        </div>

        <div class="mb-3">
            <label for="profissional" class="form-label">Escolha o Profissional</label>
            <select class="form-select" id="profissional" required>
                <option value="">Selecione um profissional</option>
                <option value="telles">Telles</option>
            </select>
        </div>

        <div class="mb-3">
            <label for="pagamento" class="form-label">Tipo de Pagamento</label>
            <select class="form-select" id="pagamento">
                <option value="">Tipos de pagamentos</option>
                <option value="dinheiro">Dinheiro</option>
                <option value="pix">Pix</option>
                <option value="cartao_credito">Cartão de Crédito</option>
            </select>
        </div>
        
        <div class="mb-3">
            <label for="precoServico" class="form-label">Preço do Serviço</label>
            <input type="text" class="form-control" id="precoServico" readonly>
        </div>
    </form>
</div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fechar</button>
                        <button type="button" class="btn btn-primary" onclick="confirmarConclusao()">Confirmar</button>
                    </div>
                </div>
            </div>
        </div>

              <!-- Modal de Edição -->
        <div class="modal fade" id="editarModal" tabindex="-1" aria-labelledby="editarModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="editarModalLabel">Editar Agendamento</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form id="editForm">
                            <input type="hidden" id="edit_id">
                            <div class="mb-3">
                                <label for="edit_nome" class="form-label">Nome do Cliente:</label>
                                <input type="text" class="form-control" id="edit_nome">
                            </div>
                            <div class="mb-3">
                                <label for="edit_telefone" class="form-label">Telefone:</label>
                                <input type="text" class="form-control" id="edit_telefone">
                            </div>
                            <div class="mb-3">
                                <label for="edit_dia" class="form-label">Data do Agendamento:</label>
                                <input type="date" class="form-control" id="edit_dia">
                            </div>
                            <div class="mb-3">
                                <label for="edit_horario" class="form-label">Horário:</label>
                                <input type="time" class="form-control" id="edit_horario">
                            </div>
                            <div class="mb-3">
                                <label for="edit_status" class="form-label">Status:</label>
                                <input type="text" class="form-control" id="edit_status">
                            </div>
                            <div class="mb-3">
                                <label for="edit_observacao" class="form-label">Observação:</label>
                                <input type="text" class="form-control" id="edit_observacao">
                            </div>
                            <div class="mb-3">
                                <label for="edit_profissional" class="form-label">Profissional:</label>
                                <input type="text" class="form-control" id="edit_profissional">
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-primary" onclick="salvarEdicao()">Salvar</button>
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fechar</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </main>
    
    <!-- Scripts -->
    <script src="../assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script>
        function loadEditForm(data) {
            // Preenche os campos do formulário de edição com os dados do agendamento
            document.getElementById('edit_id').value = data.id_agendamento;
            document.getElementById('edit_nome').value = data.nome;
            document.getElementById('edit_telefone').value = data.telefone;
            document.getElementById('edit_dia').value = data.dia;
            document.getElementById('edit_horario').value = data.horario;
            document.getElementById('edit_status').value = data.status;
            document.getElementById('edit_observacao').value = data.observacao || ''; 
            document.getElementById('edit_profissional').value = data.profissional;
        }

        function salvarEdicao() {
            const updatedData = {
                id: document.getElementById('edit_id').value,
                nome: document.getElementById('edit_nome').value,
                telefone: document.getElementById('edit_telefone').value,
                dia: document.getElementById('edit_dia').value,
                horario: document.getElementById('edit_horario').value,
                status: document.getElementById('edit_status').value,
                observacao: document.getElementById('edit_observacao').value,
                profissional: document.getElementById('edit_profissional').value
            };

            fetch("atualizar.php", {
                method: "POST",
                headers: { "Content-Type": "application/json" },
                body: JSON.stringify(updatedData)
            })
            .then(response => response.json())
            .then(result => {
                if (result.success) {
                    alert("Agendamento atualizado com sucesso!");
                    location.reload();
                } else {
                    alert("Erro ao atualizar: " + result.message);
                }
            })
            .catch(error => console.error("Erro:", error));
        }
    </script>

    </main>

    <script src="../assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script>
    let agendamentoId;

    function setAgendamentoId(id) {
        agendamentoId = id;
    }
    
    function atualizarPreco() {
            const select = document.getElementById('tipoServico');
            const precoInput = document.getElementById('precoServico');
            const selectedOption = select.options[select.selectedIndex];
            precoInput.value = selectedOption.dataset.preco || 0;
        }

    

  
async function confirmarConclusao() {
    const tipoServicoId = document.getElementById('tipoServico').value;
    const formaPagamento = document.getElementById('pagamento').value;
    const preco = document.getElementById('precoServico').value;
    const userId = <?php echo $_SESSION['id_log']; ?>;
    const profissional = document.getElementById('profissional').value;

    if (tipoServicoId && formaPagamento) {
        const dados = {
            tipo_ate: tipoServicoId,
            pagamento: formaPagamento,
            preco_ate: preco,
            data_ate: new Date().toISOString().slice(0, 19).replace('T', ' '),
            id_user: userId,
            profissional: profissional,
            id_agendamento: agendamentoId
        };

        try {
            const response = await fetch('inserir_agendamento.php', {
                method: 'POST',
                headers: { 'Content-Type': 'application/json' },
                body: JSON.stringify(dados),
            });
            const result = await response.json();

            if (result.success) {
                alert('Agendamento concluído com sucesso!');
                location.reload();
            } else {
                alert('Erro ao inserir o agendamento: ' + result.message);
            }
        } catch (error) {
            console.error('Erro:', error);
            alert('Erro na conexão com o servidor.');
        }
    } else {
        alert('Por favor, preencha todos os campos.');
    }
}


    </script>
    
    <!-- Vendor JS Files -->
    <script src="../assets/vendor/apexcharts/apexcharts.min.js"></script>
    <script src="../assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="../assets/vendor/chart.js/chart.umd.js"></script>
    <script src="../assets/vendor/echarts/echarts.min.js"></script>
    <script src="../assets/vendor/quill/quill.js"></script>
    <script src="../assets/vendor/simple-datatables/simple-datatables.js"></script>
    <script src="../assets/vendor/tinymce/tinymce.min.js"></script>
    <script src="../assets/vendor/php-email-form/validate.js"></script>

    <!-- Template Main JS File -->
    <script src="../assets/js/main.js"></script>
</body>

</html>
