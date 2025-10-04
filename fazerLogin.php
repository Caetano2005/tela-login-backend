<?php

/*$nome = $_GET["nome"];
$senha = $_GET["senha"];

$servidor = "127.0.0.1"; // ou localhost
$usuario_mysql = "caetano";
$senha_mysql = "123";
$banco = "carros";

$pdo = new PDO("mysql:host=$servidor;dbname=$banco", $usuario_mysql, $senha_mysql);

$executar = $pdo->prepare('SELECT * FROM admin WHERE nome = ? ');

$executar->execute([$nome]);

$usuario = $executar->fetch();

//Caso exista um usuário e a senha (transformada para password_hash usando password_verify) exista no banco, então
//exiba os dados do usuário do banco e inicia a sessão.
if ($usuario && password_verify($senha, $usuario['senha'])) {
    
    print($usuario["id"]."<br>".$usuario["nome"] . " " );
    
    //Inicia Sessão
    session_start();

    //Coloca id e nome do usuário em variáveis da sessão
    $_SESSION['id'] = $usuario['id'];
    $_SESSION['nome'] = $usuario['nome'];

    //redireciona para a página cliente.php
    header('location: mostrar.php');

    
} else {

    //Caso usuário e senha nao existam, exibe este erro.
    echo 'nome e/ou senha incorreto(s)';
}*/

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
    header('Location: mostrar.php');
    exit;
} else {
    echo 'Nome e/ou senha incorreto(s)';
}
?>