<?php 
// Configurações de conexão com o banco de dados
$host = "localhost"; 
$user = "root"; 
$password = "1234";
$dbname = "oflixo";

// ESTE OBJETO COMENTADO ABAIXO AI DEU ERRO POR CAUSA DA ORDEM QUE PASSEI OS PARAMETROS.
// ERRADO: $conn = new mysqli($host, $dbname, $user, $password);

//ordem certa:
$conn = new mysqli($host, $user, $password, $dbname);

//Verifica a conexão
if($conn->connect_error){
    die("Falha na conexão" .$conn->connect_error);
} //else {echo "Conectado com sucesso";}
//$conn->close();
?>