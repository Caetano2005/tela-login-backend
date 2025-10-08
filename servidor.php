<script>
 function deletar(id){
     if(confirm("Voce realmente deseja deletar?")){
	 window.location.href = 'excluir.php?id='+id;
     }
 }
</script>

<?php

$marca = $_POST["marca"];
$modelo = $_POST["modelo"];
$ano = $_POST["ano"];

print("A marca digital foi: " . $marca . "<br>");
print("O modelo digital foi: " . $modelo . "<br>");
print("O ano digital foi: " . $ano . "<br>");
echo "<br><a href='cadastrar.php'>Novo Cadastro</a>";
echo "<br><a href='cliente.php'>Ver Veiculos</a>";

//Criar conexao com o MySQL/MariaDB
$servidor = "127.0.0.1"; // ou localhost
$usuario_mysql = "caetano";
$senha_mysql = "123";
$banco = "carros";

try{
    //PDO = PHP Data Object
    // Maneira de acessar o SGBD usando Orientação a Objetos
    $pdo = new PDO(
	"mysql:host=$servidor;dbname=$banco", $usuario_mysql, $senha_mysql);
    
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    if($marca!="" || $modelo!=""){

	//Preparar a query SQL para inserir no banco
	$sql = "INSERT INTO veiculos (marca, modelo, ano) VALUES (?, ?, ?)";
	$executar = $pdo->prepare($sql);
        $executar->execute([$marca, $modelo, $ano]);

    }
	
    
}catch(PDOException $e){
    die("ERRO: ". $e->getMessage());
}

?>