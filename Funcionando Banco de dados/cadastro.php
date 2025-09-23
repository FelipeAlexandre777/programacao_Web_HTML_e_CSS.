<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

$host = '127.0.0.1';
$porta = '3307';
$db = 'aula';
$usuario = 'root';
$senha = '';

try {
    $dsn = "mysql:host=$host;port=$porta;dbname=$db;charset=utf8mb4";
    $conexao = new PDO($dsn, $usuario, $senha);
    $conexao->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Erro de conexão: " . $e->getMessage());
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nome = trim($_POST['txtNome']);
    $cep = trim($_POST['txtCEP']);
    $endereco = trim($_POST['txtEndereço']);
    $bairro = trim($_POST['txtBairro']);
    $estado = trim($_POST['txtEstado']);
    $cidade = trim($_POST['txtCidade']);
    $telefone = trim($_POST['txtTelefone']);
    $email = trim($_POST['txtEmail']);

    // Validação básica - verifica se algum campo está vazio
    if (empty($nome) || empty($cep) || empty($endereco) || empty($bairro) || empty($estado) || empty($cidade) || empty($telefone) || empty($email)) {
        die("Todos os campos devem ser preenchidos.");
    }

    try {
        $SQL = "INSERT INTO alunos (nome, cep, endereco, bairro, estado, cidade, telefone, email) 
                VALUES (:nome, :cep, :endereco, :bairro, :estado, :cidade, :telefone, :email)";
        
        $stmt = $conexao->prepare($SQL);
        $stmt->bindParam(':nome', $nome);
        $stmt->bindParam(':cep', $cep);
        $stmt->bindParam(':endereco', $endereco);
        $stmt->bindParam(':bairro', $bairro);
        $stmt->bindParam(':estado', $estado);
        $stmt->bindParam(':cidade', $cidade);
        $stmt->bindParam(':telefone', $telefone);
        $stmt->bindParam(':email', $email);

        $stmt->execute();

        header('Location: listar.php');
        exit;
    } catch (PDOException $e) {
        die("Erro ao cadastrar aluno: " . $e->getMessage());
    }
} else {
    die("Método de requisição inválido.");
}
?>
