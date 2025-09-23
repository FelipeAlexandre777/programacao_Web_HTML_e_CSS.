<?php
// Conexão com o banco de dados
error_reporting(E_ALL);
ini_set('display_errors', 1);

$host = '127.0.0.1';
$porta = '3307'; // Porta do MariaDB
$db = 'aula';    // Nome do banco de dados
$usuario = 'root'; // Usuário padrão do XAMPP
$senha = '';      // Senha vazia para o XAMPP

try {
    $dsn = "mysql:host=$host;port=$porta;dbname=$db";
    $conexao = new PDO($dsn, $usuario, $senha);
    $conexao->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $conexao->exec("SET NAMES 'UTF8'");
} catch (PDOException $e) {
    echo "Erro de conexão: " . $e->getMessage();
    die();
}
?>
