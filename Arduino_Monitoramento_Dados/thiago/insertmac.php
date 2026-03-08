<?php
$servername = "localhost";
$database = "miguelde_modulo4"; 
$username = "miguelde_modulo4";
$password = "modulo4";
$sql = "mysql:host=$servername;dbname=$database;";
$dsn_Options = [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION];

try { 
  $my_Db_Connection = new PDO($sql, $username, $password, $dsn_Options);
  echo "Connected successfully";
} catch (PDOException $error) {
  echo 'Connection error: ' . $error->getMessage();
}

// $_POST["idmac"], $_POST["nome"] são campos do formulário, insertmac.html
$idmac = $_POST["idmac"];
$nome = $_POST["nome"];

// $my_Insert_Statement->bindParam(':idmac', $idmac); = associado o valor a ser inserido com a variavel global, $idmac
$my_Insert_Statement = $my_Db_Connection->prepare("INSERT INTO macthiago (idmacthiago, nome) VALUES (:idmac, :nome)");
$my_Insert_Statement->bindParam(':idmac', $idmac);
$my_Insert_Statement->bindParam(':nome', $nome);

if ($my_Insert_Statement->execute()) {
  echo "Placa Inserida com Sucesso!";
} else {
  echo "Deu Ruim!";
}
?>
