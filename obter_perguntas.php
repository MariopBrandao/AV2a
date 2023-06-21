<?php
$servername = "localhost";
$username = "seu_usuario";
$password = "sua_senha";
$dbname = "seu_banco_de_dados";

// Cria a conexão com o banco de dados
$conn = new mysqli($servername, $username, $password, $dbname);

// Verifica se ocorreu um erro na conexão
if ($conn->connect_error) {
    die("Erro na conexão com o banco de dados: " . $conn->connect_error);
}

// Executa a consulta para obter as perguntas
$sql = "SELECT titulo, conteudo FROM perguntas";
$result = $conn->query($sql);

$perguntas = array();
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $pergunta = array(
            "titulo" => $row["titulo"],
            "conteudo" => $row["conteudo"]
        );
        $perguntas[] = $pergunta;
    }
}

// Fecha a conexão com o banco de dados
$conn->close();

// Converte as perguntas em JSON e retorna a resposta
echo json_encode($perguntas);
?>
