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

  if (($_POST['from']=='HTML')){
    $dataleitura = $_POST['dataleitura'];
    $horaleitura = $_POST['horaleitura'];

}else{
    $h = "3"; //HORAS DO FUSO ((BRASÃLIA = -3) COLOCA-SE SEM O SINAL -).
    $hm = $h * 60;
    $ms = $hm * 60;
    //COLOCA-SE O SINAL DO FUSO ((BRASÃLIA = -3) SINAL -) ANTES DO ($ms). DATA
    $dataleitura = gmdate("Y/m/d", time()-($ms)); 
    $horaleitura = gmdate("H:i:s", time()-($ms));     
}

} catch (PDOException $error) {
  echo 'Connection error: ' . $error->getMessage();
}   

$idmac = $_POST['idmac'];
$umidade = $_POST['umidade'];
$temperatura = $_POST['temperatura'];

$my_Insert_Statement = $my_Db_Connection->prepare
("INSERT INTO leiturathiago (macthiago_idmacthiago, dataleitura, horaleitura, umidade, temperatura) 
VALUES        (:macthiago_idmacthiago, :dataleitura, :horaleitura, :umidade, :temperatura)");

$my_Insert_Statement->bindParam(':macthiago_idmacthiago', $idmac);
$my_Insert_Statement->bindParam(':dataleitura', $dataleitura);
$my_Insert_Statement->bindParam(':horaleitura', $horaleitura);
$my_Insert_Statement->bindParam(':umidade', $umidade);
$my_Insert_Statement->bindParam(':temperatura', $temperatura);

if ($my_Insert_Statement->execute()) {
  echo "Leitura inserida com Sucesso!";
} else {
  echo "Leitura não inserida!";
}
?>  
