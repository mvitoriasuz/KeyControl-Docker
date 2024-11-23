<?php
session_start();

if (!isset($_SESSION['user_id'])) {
    header("Location: ../app/controllers/verifica_login.php");
    exit();
}

require '../controllers/db_conexao.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['action']) && $_POST['action'] === 'cadastrar') {
    $nome = $_POST['nome'] ?? null;
    $cpf_cnpj = $_POST['cpf_cnpj'] ?? null;
    $telefone = $_POST['telefone'] ?? null;
    $data_nascimento_fundacao = $_POST['data_nascimento_fundacao'] ?? null;
    $rg_ie = $_POST['rg_ie'] ?? null;
    $email = $_POST['email'] ?? null;
    $nacionalidade = $_POST['nacionalidade'] ?? null;
    $estado_civil = $_POST['estado_civil'] ?? null;
    $profissao = $_POST['profissao'] ?? null;
    $cep = $_POST['cep'] ?? null;
    $rua = $_POST['rua'] ?? null;
    $numero = $_POST['numero'] ?? null;
    $bairro = $_POST['bairro'] ?? null;
    $complemento = $_POST['complemento'] ?? null;
    $cidade = $_POST['cidade'] ?? null;
    $estado = $_POST['estado'] ?? null;
    $pais = $_POST['pais'] ?? null;
    $locador = isset($_POST['locador']) ? 1 : 0;
    $locatario = isset($_POST['locatario']) ? 1 : 0;
    $fiador = isset($_POST['fiador']) ? 1 : 0;
    $comprador = isset($_POST['comprador']) ? 1 : 0;

    $id_imobiliaria = $_SESSION['user_cnpj'];

    $stmt = $pdo->prepare("INSERT INTO cadastro_cliente (nome, cpf_cnpj, telefone, data_nascimento_fundacao, rg_ie, email, nacionalidade, estado_civil, profissao, cep, rua, numero, bairro, complemento, cidade, estado, pais, locador, locatario, fiador, comprador, id_imobiliaria) 
                            VALUES (:nome, :cpf_cnpj, :telefone, :data_nascimento_fundacao, :rg_ie, :email, :nacionalidade, :estado_civil, :profissao, :cep, :rua, :numero, :bairro, :complemento, :cidade, :estado, :pais, :locador, :locatario, :fiador, :comprador, :id_imobiliaria)");

    $stmt->bindParam(':nome', $nome);
    $stmt->bindParam(':cpf_cnpj', $cpf_cnpj);
    $stmt->bindParam(':telefone', $telefone);
    $stmt->bindParam(':data_nascimento_fundacao', $data_nascimento_fundacao);
    $stmt->bindParam(':rg_ie', $rg_ie);
    $stmt->bindParam(':email', $email);
    $stmt->bindParam(':nacionalidade', $nacionalidade);
    $stmt->bindParam(':estado_civil', $estado_civil);
    $stmt->bindParam(':profissao', $profissao);
    $stmt->bindParam(':cep', $cep);
    $stmt->bindParam(':rua', $rua);
    $stmt->bindParam(':numero', $numero);
    $stmt->bindParam(':bairro', $bairro);
    $stmt->bindParam(':complemento', $complemento);
    $stmt->bindParam(':cidade', $cidade);
    $stmt->bindParam(':estado', $estado);
    $stmt->bindParam(':pais', $pais);
    $stmt->bindParam(':locador', $locador);
    $stmt->bindParam(':locatario', $locatario);
    $stmt->bindParam(':fiador', $fiador);
    $stmt->bindParam(':comprador', $comprador);
    $stmt->bindParam(':id_imobiliaria', $id_imobiliaria);

    if ($stmt->execute()) {
        header("Location: ../../views/lista_cliente.php");
        exit();
    } else {
        echo "Erro ao cadastrar cliente: " . $stmt->errorInfo()[2];
    }
} else {
    echo "Método de requisição inválido.";
}
?>
