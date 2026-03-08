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
        <h1><a class="voltar" href="index.php"> Voltar </a></h2>
    </div>

    <div class='container'>
        <h2>Página do Thiago</h2>
        <h3>Listagem de Placas MAC</h3>
    </div>

    <div class='container'>
        <table border=1>
            <tr>
                <th>Id Mac</th>
                <th>Nome</th>
                <th>Contador</th>
            </tr>


<?php
$sql='SELECT * FROM macthiago';
$data = $conn->query($sql);
foreach($data as $row) {
    echo'<tr>';
    echo'<td>'.($row[0]).'</td>';
    echo'<td>'.($row[1]).'</td>';
    echo'<td>'.($row[2]).'</td>';
} echo'</table></div>';
} catch(PDOException $e) {
echo 'ERROR: ' . $e->getMessage();
}
?>