<?php
$servername = "localhost";
$username = "seu_usuario";
$password = "sua_senha";
$dbname = "seu_banco_de_dados";

function criarPerguntaTexto($pergunta, $resposta, $conn) {
    global $dbname;

    // Prepara a consulta para inserir a pergunta no banco de dados
    $sql = "INSERT INTO perguntas (pergunta, resposta) VALUES ('$pergunta', '$resposta')";

    // Executa a consulta
    if ($conn->query($sql) === TRUE) {
        echo "Pergunta com resposta de texto criada com sucesso.";
    } else {
        echo "Erro ao criar pergunta: " . $conn->error;
    }
}

// Cria a conexão com o banco de dados
$conn = new mysqli($servername, $username, $password, $dbname);

// Verifica se ocorreu um erro na conexão
if ($conn->connect_error) {
    die("Erro na conexão com o banco de dados: " . $conn->connect_error);
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $pergunta = $_POST['pergunta'];
    $resposta = $_POST['resposta'];

    criarPerguntaTexto($pergunta, $resposta, $conn);
}

// Fecha a conexão com o banco de dados
$conn->close();
?>

<!DOCTYPE html>
<html>
<head>
    <title>Criar Pergunta com Resposta de Texto</title>
</head>
<body>
    <h2>Criar Pergunta com Resposta de Texto</h2>
    <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST">
        <label>Pergunta:</label><br>
        <textarea name="pergunta"></textarea><br><br>
        <label>Resposta:</label><br>
        <textarea name="resposta"></textarea><br><br>
        <input type="submit" value="Criar Pergunta">
    </form>
</body>
</html>
