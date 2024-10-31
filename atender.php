<?php
require_once "../config/configtelles.php";
require_once "secure/acesso.php";

date_default_timezone_set('America/Sao_Paulo');  // Configura o fuso horário

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST["tipo"]) && is_array($_POST["tipo"]) && count(array_filter($_POST["tipo"], 'strlen')) > 0) {
        if (isset($_POST["pagamento"]) && !empty($_POST["pagamento"])) {
            if (isset($_POST["profissional"]) && !empty($_POST["profissional"])) {
                $pagamento = $_POST["pagamento"];
                $date_time = date("Y-m-d H:i:s");  // Obtém a data e hora atual no formato correto
                $tipos = $_POST["tipo"];
                $id_user = $_POST["id_user"];
                $profissional = $_POST["profissional"]; // Obtém o profissional selecionado

                try {
                    // Inicia a transação
                    $pdo->beginTransaction();

                    // Prepara a consulta para obter os preços dos tipos
                    $consulta_preco_tipo = $pdo->prepare("SELECT preco_tipo FROM tipos WHERE id_tipo = :id_tipo");

                    $total_preco = 0;
                    $tipo_ate_array = [];

                    foreach ($tipos as $tipo) {
                        $consulta_preco_tipo->bindParam(":id_tipo", $tipo, PDO::PARAM_INT);
                        $consulta_preco_tipo->execute();
                        $resultado_tipo = $consulta_preco_tipo->fetch(PDO::FETCH_ASSOC);

                        if ($resultado_tipo) {
                            $total_preco += $resultado_tipo['preco_tipo'];
                            $tipo_ate_array[] = $tipo;  // Adicionando o tipo ao array
                        }
                    }

                    // Converte o array de tipos para uma string separada por vírgulas
                    $tipo_ate_string = implode(',', $tipo_ate_array);

                    // Prepara a consulta para inserção do atendimento com o campo 'profissional'
                    $inserir_atendimento = $pdo->prepare("
                        INSERT INTO atendimentos (tipo_ate, preco_ate, data_ate, id_user, profissional, pagamento) 
                        VALUES (:tipo_ate, :preco_ate, :date_ate, :id_user, :profissional, :pagamento)
                    ");
                    $inserir_atendimento->bindParam(":tipo_ate", $tipo_ate_string, PDO::PARAM_STR);
                    $inserir_atendimento->bindParam(":preco_ate", $total_preco, PDO::PARAM_STR);
                    $inserir_atendimento->bindParam(":date_ate", $date_time, PDO::PARAM_STR);
                    $inserir_atendimento->bindParam(":id_user", $id_user, PDO::PARAM_INT);
                    $inserir_atendimento->bindParam(":profissional", $profissional, PDO::PARAM_STR);
                    $inserir_atendimento->bindParam(":pagamento", $pagamento, PDO::PARAM_STR);
                    $inserir_atendimento->execute();

                    // Confirma a transação
                    $pdo->commit();

                    // Redireciona em caso de sucesso
                    header("Location: atendimentos.php?atendimento=ok");
                    exit();
                } catch (Exception $e) {
                    // Reverte a transação se algo der errado
                    $pdo->rollBack();
                    header("Location: index.php?erro=" . urlencode($e->getMessage()));
                    exit();
                }
            } else {
                header("Location: index.php?profissional=erro");
                exit();
            }
        } else {
            header("Location: index.php?pagamento=erro");
            exit();
        }
    } else {
        header("Location: index.php?tipo=erro");
        exit();
    }
} else {
    header("Location: index.php?metodo=erro");
    exit();
}
?>
<?php
require_once "../config/configtelles.php";
require_once "secure/acesso.php";

date_default_timezone_set('America/Sao_Paulo');  // Configura o fuso horário

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST["tipo"]) && is_array($_POST["tipo"]) && count(array_filter($_POST["tipo"], 'strlen')) > 0) {
        if (isset($_POST["pagamento"]) && !empty($_POST["pagamento"])) {
            if (isset($_POST["profissional"]) && !empty($_POST["profissional"])) {
                $pagamento = $_POST["pagamento"];
                $date_time = date("Y-m-d H:i:s");  // Obtém a data e hora atual no formato correto
                $tipos = $_POST["tipo"];
                $id_user = $_POST["id_user"];
                $profissional = $_POST["profissional"]; // Obtém o profissional selecionado

                try {
                    // Inicia a transação
                    $pdo->beginTransaction();

                    // Prepara a consulta para obter os preços dos tipos
                    $consulta_preco_tipo = $pdo->prepare("SELECT preco_tipo FROM tipos WHERE id_tipo = :id_tipo");

                    $total_preco = 0;
                    $tipo_ate_array = [];

                    foreach ($tipos as $tipo) {
                        $consulta_preco_tipo->bindParam(":id_tipo", $tipo, PDO::PARAM_INT);
                        $consulta_preco_tipo->execute();
                        $resultado_tipo = $consulta_preco_tipo->fetch(PDO::FETCH_ASSOC);

                        if ($resultado_tipo) {
                            $total_preco += $resultado_tipo['preco_tipo'];
                            $tipo_ate_array[] = $tipo;  // Adicionando o tipo ao array
                        }
                    }

                    // Converte o array de tipos para uma string separada por vírgulas
                    $tipo_ate_string = implode(',', $tipo_ate_array);

                    // Prepara a consulta para inserção do atendimento com o campo 'profissional'
                    $inserir_atendimento = $pdo->prepare("
                        INSERT INTO atendimentos (tipo_ate, preco_ate, data_ate, id_user, profissional, pagamento) 
                        VALUES (:tipo_ate, :preco_ate, :date_ate, :id_user, :profissional, :pagamento)
                    ");
                    $inserir_atendimento->bindParam(":tipo_ate", $tipo_ate_string, PDO::PARAM_STR);
                    $inserir_atendimento->bindParam(":preco_ate", $total_preco, PDO::PARAM_STR);
                    $inserir_atendimento->bindParam(":date_ate", $date_time, PDO::PARAM_STR);
                    $inserir_atendimento->bindParam(":id_user", $id_user, PDO::PARAM_INT);
                    $inserir_atendimento->bindParam(":profissional", $profissional, PDO::PARAM_STR);
                    $inserir_atendimento->bindParam(":pagamento", $pagamento, PDO::PARAM_STR);
                    $inserir_atendimento->execute();

                    // Confirma a transação
                    $pdo->commit();

                    // Redireciona em caso de sucesso
                    header("Location: atendimentos.php?atendimento=ok");
                    exit();
                } catch (Exception $e) {
                    // Reverte a transação se algo der errado
                    $pdo->rollBack();
                    header("Location: index.php?erro=" . urlencode($e->getMessage()));
                    exit();
                }
            } else {
                header("Location: index.php?profissional=erro");
                exit();
            }
        } else {
            header("Location: index.php?pagamento=erro");
            exit();
        }
    } else {
        header("Location: index.php?tipo=erro");
        exit();
    }
} else {
    header("Location: index.php?metodo=erro");
    exit();
}
?>
