<?php
$servidor = "127.0.0.1";
$usuario_mysql = "caetano";
$senha_mysql = "123";
$banco = "carros";

try {
    $pdo = new PDO("mysql:host=$servidor;dbname=$banco", $usuario_mysql, $senha_mysql);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    if(isset($_GET['id'])){
        $id = $_GET['id'];

        // Buscar os dados atuais do veículo
        $stmt = $pdo->prepare("SELECT * FROM veiculos WHERE id = ?");
        $stmt->execute([$id]);
        $veiculo = $stmt->fetch();

        if(!$veiculo){
            die("Veículo não encontrado.");
        }
    }

    if(isset($_POST['atualizar'])){
        $marca = $_POST['marca'];
        $modelo = $_POST['modelo'];
        $ano = $_POST['ano'];

        // Atualizar os dados no banco
        $stmt = $pdo->prepare("UPDATE veiculos SET marca = ?, modelo = ?, ano = ? WHERE id = ?");
        $stmt->execute([$marca, $modelo, $ano, $id]);

        echo "Veículo atualizado com sucesso!";
        echo "<br><a href='mostrar.php'>Voltar</a>";
        exit;
    }

} catch(PDOException $e){
    die("ERRO: ". $e->getMessage());
}
?>

<!-- Formulário de edição -->
<form method="post">
    Marca: <input type="text" name="marca" value="<?= $veiculo['marca'] ?>"><br>
    Modelo: <input type="text" name="modelo" value="<?= $veiculo['modelo'] ?>"><br>
    Ano: <input type="number" name="ano" value="<?= $veiculo['ano'] ?>"><br>
    <input type="submit" name="atualizar" value="Atualizar">
</form>
