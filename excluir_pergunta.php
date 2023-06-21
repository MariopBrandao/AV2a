<?php
function listarPerguntas($conexao) {
    $sql = "SELECT * FROM perguntas";
    $result = mysqli_query($conexao, $sql);

    if (mysqli_num_rows($result) === 0) {
        echo "Não há perguntas cadastradas.";
        return;
    }

    echo "Perguntas existentes:<br>";
    while ($row = mysqli_fetch_assoc($result)) {
        $pergunta = $row['pergunta'];
        echo "- $pergunta<br>";
    }
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nomeArquivo = $_POST['arquivo'];

    // Realize a conexão com o banco de dados
    $conexao = mysqli_connect("localhost", "usuario", "senha", "nome_do_banco");

    if (!$conexao) {
        echo "Erro ao conectar ao banco de dados: " . mysqli_connect_error();
        exit;
    }

    // Realize a exclusão da pergunta
    $sql = "DELETE FROM perguntas WHERE pergunta = '$nomeArquivo'";
    $result = mysqli_query($conexao, $sql);

    if ($result) {
        echo "Pergunta excluída com sucesso.";
    } else {
        echo "Erro ao excluir pergunta: " . mysqli_error($conexao);
    }

    // Feche a conexão com o banco de dados
    mysqli_close($conexao);
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Excluir Pergunta</title>
</head>
<body>
    <h2>Selecionar Pergunta para Excluir</h2>
    <?php
    // Realize a conexão com o banco de dados
    $conexao = mysqli_connect("localhost", "usuario", "senha", "nome_do_banco");

    if (!$conexao) {
        echo "Erro ao conectar ao banco de dados: " . mysqli_connect_error();
        exit;
    }

    listarPerguntas($conexao);

    // Feche a conexão com o banco de dados
    mysqli_close($conexao);
    ?>
    <br>
    <h2>Selecione a Pergunta a Ser Excluída</h2>
    <form action="excluir_pergunta.php" method="POST">
        <label>Nome do Arquivo:</label><br>
        <input type="text" name="arquivo"><br><br>
        <input type="submit" name="excluir" value="Excluir Pergunta">
    </form>
</body>
</html>
