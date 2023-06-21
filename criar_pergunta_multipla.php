<?php
function criarPerguntaMultipla($pergunta, $respostas) {
    $servername = "localhost"; // substitua pelo nome do servidor
    $username = "seu_usuario"; // substitua pelo nome de usuário do banco de dados
    $password = "sua_senha"; // substitua pela senha do banco de dados
    $database = "seu_banco_de_dados"; // substitua pelo nome do banco de dados

    // Criar uma conexão com o banco de dados
    $conn = new mysqli($servername, $username, $password, $database);

    // Verificar se a conexão foi estabelecida com sucesso
    if ($conn->connect_error) {
        die("Falha na conexão com o banco de dados: " . $conn->connect_error);
    }

    // Escapar os caracteres especiais nas variáveis antes de inserir no banco de dados
    $pergunta = $conn->real_escape_string($pergunta);

    // Inserir a pergunta e respostas no banco de dados
    $sql = "INSERT INTO perguntas (pergunta, respostas) VALUES ('$pergunta', '$respostas')";
    if ($conn->query($sql) === true) {
        echo "Pergunta com respostas de múltipla escolha criada com sucesso.";
    } else {
        echo "Erro ao criar a pergunta: " . $conn->error;
    }

    // Fechar a conexão com o banco de dados
    $conn->close();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $pergunta = $_POST['pergunta'];
    $respostas = $_POST['respostas'];
    
    criarPerguntaMultipla($pergunta, $respostas);
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Criar Pergunta com Respostas de Múltipla Escolha</title>
</head>
<body>
    <h2>Criar Pergunta com Respostas de Múltipla Escolha</h2>
    <form action="criar_pergunta_multipla.php" method="POST">
        <label>Pergunta:</label><br>
        <textarea name="pergunta"></textarea><br><br>
        <label>Respostas:</label><br>
        <textarea name="respostas"></textarea><br><br>
        <input type="submit" value="Criar Pergunta">
    </form>
</body>
</html>
