<?php
$id = $_GET["id"];

print($id);

$servidor = "127.0.0.1"; // ou localhost
$usuario_mysql = "caetano";
$senha_mysql = "123";
$banco = "carros";

$pdo = new PDO("mysql:host=$servidor;dbname=$banco", $usuario_mysql, $senha_mysql);

$sql = "DELETE FROM veiculos WHERE id=$id";
$executar = $pdo->query($sql);
$executar->execute();

header("location: mostrar.php");

?>