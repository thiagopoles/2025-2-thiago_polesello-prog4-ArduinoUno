<!DOCTYPE html>

<html lang="pt-BR">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">

    <head>
        <title>IFSC Programação IV</title>
    <link rel="stylesheet" href="https://www.modulo4.migueldebarba.com.br/thiago/style.css" type="text/css" />
</head>

<?php
include 'conectabanco.php';
$charset = 'utf8mb4';

try {
    $conn = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
    $tabela = 'leiturathiago';
    $stmt = $conn->query("DESCRIBE `$tabela`");
?>


    <div class='container'>
        <h2>Página do Thiago</h2>
        <h3>Listagem Fields</h3>
    </div>

    <div class='container'>
    <table border=2>
        <tr>
            <th>Nome</th>
            <th>Tipo</th>
            <th>Null</th>
            <th>Chave</th>
            <th>Padrão</th>
            <th>Extra</th>
        </tr>


<?php
    while ($coluna = $stmt->fetch(PDO::FETCH_ASSOC)) {
        echo '<tr><td>' . $coluna['Field'] . '</td>';
        echo '<td>'  . $coluna['Type'] . '</td>';
        echo '<td>' . $coluna['Null'] . '</td>';
        echo '<td>' . $coluna['Key'] . '</td>';
        echo '<td>' . $coluna['Default'] . '</td>';
        echo '<td>' . $coluna['Extra'] . '</td></tr>';
    }echo'</table>';

} catch (PDOException $e) {
    echo "Erro na conexão: " . $e->getMessage();
}
?>
