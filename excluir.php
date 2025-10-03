<?php
$id = $_GET["id"];

print($id);

$pdo = new PDO("mysql:host=localhost;dbname=banco", "usuario", "123");

$sql = "DELETE FROM veiculos WHERE id=$id";
$executar = $pdo->query($sql);
$executar->execute();

header("location: servidor.php");

?>