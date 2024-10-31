<?php
require_once "../config/configtelles.php";
require_once "secure/acesso.php";


$id = $_SESSION['id_log'];
$consulta = $pdo->prepare("SELECT * FROM usuarios WHERE  id_user = :id_user");
$consulta->bindParam(':id_user', $id);
$consulta->execute();
$resultado_user = $consulta->fetch(PDO::FETCH_ASSOC);

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
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">



    <!-- Template Main CSS File -->
    <link href="../assets/css/style.css" rel="stylesheet">
</head>

<body>

    <!-- ======= Header ======= -->
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

    </header><!-- End Header -->

    <!-- ======= Sidebar ======= -->
    <aside id="sidebar" class="sidebar">

        <ul class="sidebar-nav" id="sidebar-nav">

            <li class="nav-item">
                <a class="nav-link collapsed" href="index.php">
                    <i class="bi bi-grid"></i>
                    <span>Início</span>
                </a>
            </li><!-- End Dashboard Nav -->
            <li class="nav-item">
                <a class="nav-link collapsed" href="agendados.php">
                    <i class="bi bi-calendar"></i> <!-- Ícone de calendário -->
                    <span>Agendamentos</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link collapsed" href="atendimentos.php">
                    <i class="bi bi-briefcase"></i>
                    <span>Atendimentos</span>
                </a>
            </li><!-- End Work Page Nav -->

            <li class="nav-item">

            <li class="nav-item">
                <a class="nav-link" href="relatorios.php">
                    <i class="bi bi-file-earmark-text"></i> <!-- Ícone de Relatório -->
                    <span>Relatórios</span>
                </a>
            </li><!-- End Profile Page Nav -->
            <li class="nav-item">
                <a class="nav-link collapsed" href="perfil.php">
                    <i class="bi bi-person"></i>
                    <span>Perfil</span>
                </a>
            </li><!-- End Profile Page Nav -->

            <li class="nav-item">
                <a class="nav-link collapsed" href="sair.php">
                    <i class="bi bi-box-arrow-in-right"></i>
                    <span>Sair</span>
                </a>
            </li><!-- End Login Page Nav -->
        </ul>

    </aside><!-- End Sidebar-->

    <main id="main" class="main">

        <div class="pagetitle">
            <h1>Relatórios</h1>
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="index.php">Início</a></li>
                    <li class="breadcrumb-item active">Relatórios</li>
                </ol>
            </nav>
        </div><!-- End Page Title -->

        <section class="section profile" style="margin-top: 90px;">
            <div class="row">
                <div class="col-xl-4">
                    <div class="card">
                        <a href="relatorio_diario.php" class="text-decoration-none">
                            <div class="card-body profile-card pt-4 d-flex flex-column align-items-center">
                                <i class="fas fa-calendar-day" style="font-size: 50px; color: #007bff;"></i> <!-- Ícone de relatório diário -->

                                <p>Relatório Diário</p>

                                <p style="color: #444;">Visualize os agendamentos do dia.</p> <!-- Descrição -->
                            </div>
                        </a>
                    </div>
                </div>

                <div class="col-xl-4">
                    <div class="card">
                        <a href="relatorio_semanal.php" class="text-decoration-none">

                            <div class="card-body profile-card pt-4 d-flex flex-column align-items-center">
                                <i class="fas fa-calendar-week" style="font-size: 50px; color: #28a745;"></i> <!-- Ícone de relatório semanal -->
                                <p>Relatório Semanal</p>

                                <p style="color: #444;">Veja os agendamentos da semana.</p> <!-- Descrição -->
                            </div>
                        </a>
                    </div>
                </div>

                <div class="col-xl-4">
                    <div class="card">
                        <a href="relatorio_mensal.php" class="text-decoration-none">

                            <div class="card-body profile-card pt-4 d-flex flex-column align-items-center">
                                <i class="fas fa-calendar-alt" style="font-size: 50px; color: #dc3545;"></i> <!-- Ícone de relatório mensal -->
                                <p>Relatório Mensal</p>
                                <p style="color: #444;">Consulte os agendamentos do mês.</p> <!-- Descrição -->
                            </div>
                        </a>

                    </div>
                </div>
            </div>


        </section>

    </main><!-- End #main -->


    <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i
            class="bi bi-arrow-up-short"></i></a>

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
    <!-- Script para adicionar e remover campos de seleção -->
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            const addButton = document.getElementById("add-select");
            const selectContainer = document.getElementById("select-container");
            let selectCount = 1; // Contador para os selects adicionados

            addButton.addEventListener("click", function() {
                if (selectCount < 3) { // Limite de 3 selects
                    selectCount++;

                    // Criar novo select
                    const newSelectGroup = document.createElement("div");
                    newSelectGroup.classList.add("form-group");
                    newSelectGroup.style.marginTop = "5px";
                    newSelectGroup.id = "select-group" + selectCount;

                    const newSelectLabel = document.createElement("label");
                    newSelectLabel.setAttribute("for", "tipo" + selectCount);

                    const newSelect = document.createElement("select");
                    newSelect.classList.add("form-select");
                    newSelect.setAttribute("name", "tipo[]");
                    newSelect.setAttribute("id", "tipo" + selectCount);
                    newSelect.innerHTML = `
            <option value="">Serviços oferecidos</option>
            <?php
            // Reiniciar a consulta para exibir todas as opções novamente
            $consulta->execute();
            while ($resultado = $consulta->fetch(PDO::FETCH_ASSOC)) {
                echo '<option value="' . $resultado['id_tipo'] . '">' . $resultado['nome_tipo'] . '</option>';
            }
            ?>
        `;

                    const removeButton = document.createElement("button");
                    removeButton.type = "button";
                    removeButton.classList.add("btn", "btn-danger", "ml-2", "mt-1");
                    removeButton.textContent = "Excluir campo";
                    removeButton.addEventListener("click", function() {
                        selectContainer.removeChild(newSelectGroup);
                        selectCount--;
                    });

                    newSelectGroup.appendChild(newSelectLabel);
                    newSelectGroup.appendChild(newSelect);
                    newSelectGroup.appendChild(removeButton);
                    selectContainer.appendChild(newSelectGroup);
                } else {
                    alert("Você atingiu o máximo de 3 campos de seleção.");
                }
            });
        });
    </script>

</body>
<?php if (isset($_GET['metodo']) && $_GET['metodo'] === 'erro') {
    echo "<script>alert('Erro no metodo de comunicação!');</script>";
}
if (isset($_GET['tipo']) && $_GET['tipo'] === 'erro') {
    echo "<script>alert('Nenhum serviço foi selecionado!');</script>";
}
if (isset($_GET['pagamento']) && $_GET['pagamento'] === 'erro') {
    echo "<script>alert('Nenhum metodo de pagamento foi selecionado!');</script>";
}
if (isset($_GET['atendimento']) && $_GET['atendimento'] === 'ok') {
    echo "<script>alert('Atendimento adicionado com sucesso!');</script>";
}
?>

</html>