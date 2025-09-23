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

// Ajuste o SELECT para buscar as colunas atuais da tabela
$sql = "SELECT id, nome, cep, endereco, bairro, estado, cidade, telefone, email FROM alunos";
$stmt = $conexao->prepare($sql);
$stmt->execute();
$alunos = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Lista de Alunos</title>
</head>
<body>
    <h1>Lista de Alunos</h1>

    <?php if (count($alunos) > 0): ?>
        <table border="1" cellpadding="8" cellspacing="0">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nome</th>
                    <th>CEP</th>
                    <th>Endereço</th>
                    <th>Bairro</th>
                    <th>Estado</th>
                    <th>Cidade</th>
                    <th>Telefone</th>
                    <th>Email</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($alunos as $aluno): ?>
                    <tr>
                        <td><?= htmlspecialchars($aluno['id']) ?></td>
                        <td><?= htmlspecialchars($aluno['nome']) ?></td>
                        <td><?= htmlspecialchars($aluno['cep']) ?></td>
                        <td><?= htmlspecialchars($aluno['endereco']) ?></td>
                        <td><?= htmlspecialchars($aluno['bairro']) ?></td>
                        <td><?= htmlspecialchars($aluno['estado']) ?></td>
                        <td><?= htmlspecialchars($aluno['cidade']) ?></td>
                        <td><?= htmlspecialchars($aluno['telefone']) ?></td>
                        <td><?= htmlspecialchars($aluno['email']) ?></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    <?php else: ?>
        <p>Nenhum aluno cadastrado.</p>
    <?php endif; ?>

    <p><a href="index.html">Voltar para o formulário</a></p>
</body>
</html>
