<!DOCTYPE html>
<html lang="pt-BR">
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
 <head>
    <title>IFSC Programação IV</title>
<link rel="stylesheet" href="https://www.modulo4.migueldebarba.com.br/thiago/style.css" type="text/css" />
</head>
<body>  
    <div class="container">
        <footer>
            &copy; 2025 Banco de Dados. Todos os direitos reservados a Thiago Polesello
        </footer>
    </div>
</body>
<?php
$username='miguelde_modulo4';
$password='modulo4';
$dbname='miguelde_modulo4';
$host='localhost';

try {
 $conn = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
 $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
 ?>

    <div class="container">
        <h1><a class="voltar" href="index.php"> Voltar </a></h1>
    </div>

    <div class='container'>
        <h1>Página de Leituras do Thiago</h1>
        <h2>Listagem de leituras</h2>
    </div>

    <div class='container'>
        <table>
        <tr>
            <th>ID Leitura</th>
            <th>ID Placa</th>
            <th>Data</th>
            <th>Hora</th>
            <th>Umidade</th>
            <th>Temperatura</th>
        </tr>
    </div>


<?php
 $sql='SELECT * FROM leiturathiago order by idleiturathiago DESC';
 $data = $conn->query($sql);
 foreach($data as $row) {
 echo '<tr>';
    echo '<td>'.($row[0]).'</td>';
    echo '<td>'.($row[1]).'</td>';
    echo '<td>'.($row[2]).'</td>';
    echo '<td>'.($row[3]).'</td>';
    echo '<td>'.($row[4]).'</td>';
    echo '<td>'.($row[5]).'</td></tr>';

 }echo'</table></div>';
 } catch(PDOException $e) {
 echo 'ERROR: ' . $e->getMessage();
}
 ?>