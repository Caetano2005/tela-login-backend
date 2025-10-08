<script>
    function deletar(id) {
        if (confirm("Voce realmente deseja deletar?")) {
            window.location.href = 'excluir.php?id=' + id;
        }
    }
</script>

<?php

$marca = $_POST["marca"];
$modelo = $_POST["modelo"];
$ano = $_POST["ano"];

//Criar conexao com o MySQL/MariaDB
$servidor = "127.0.0.1"; // ou localhost
$usuario_mysql = "caetano";
$senha_mysql = "123";
$banco = "carros";

try {
    //PDO = PHP Data Object
    // Maneira de acessar o SGBD usando Orientação a Objetos
    $pdo = new PDO(
        "mysql:host=$servidor;dbname=$banco",
        $usuario_mysql,
        $senha_mysql
    );

    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    //EXIBIR DADOS DO BANCO AQUI
    $sql = "SELECT * FROM veiculos ORDER BY id DESC";
    $executar = $pdo->query($sql);

    $veiculos = $executar->fetchAll();

    if (count($veiculos) > 0) {
        echo "<table border='1' cellpadding='5' cellspacing='0'>";
        echo "<tr>
                <th>ID</th>
                <th>Marca</th>
                <th>Modelo</th>
                <th>Ano</th>
                <th>Ações</th>
              </tr>";

        foreach ($veiculos as $veiculo) {
            $id = $veiculo["id"];
            echo "<tr>
                    <td>{$id}</td>
                    <td>{$veiculo['marca']}</td>
                    <td>{$veiculo['modelo']}</td>
                    <td>{$veiculo['ano']}</td>
                    <td><a href='javascript:void(0)' onClick='deletar($id)'>Excluir</a> <br>
                    <a href='editar.php?id=$id'>Editar</a>
                    </td>
                  </tr>";
        }

        echo "</table>";
    } else {
        echo "Nenhum veículo cadastrado.";
    }
} catch (PDOException $e) {
    die("ERRO: " . $e->getMessage());
}
?>