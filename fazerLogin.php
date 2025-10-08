<?php

session_start(); // Inicia sessão no início

$nome = $_POST["nome"];
$senha = $_POST["senha"];

$servidor = "127.0.0.1"; // ou localhost
$usuario_mysql = "caetano";
$senha_mysql = "123";
$banco = "carros";

$pdo = new PDO("mysql:host=$servidor;dbname=$banco", $usuario_mysql, $senha_mysql);
$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

$stmt = $pdo->prepare('SELECT * FROM admin WHERE nome = ?');
$stmt->execute([$nome]);
$usuario = $stmt->fetch(PDO::FETCH_ASSOC);

if ($usuario && $senha === $usuario['senha']) {
    $_SESSION['id'] = $usuario['id'];
    $_SESSION['nome'] = $usuario['nome'];
    header('Location: ver.php');
    exit;
} else {
    echo 'Nome e/ou senha incorreto(s)';
}
?>