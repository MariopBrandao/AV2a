<?php
function listarPerguntas() {
    $arquivos = glob("*.txt");
    if (empty($arquivos)) {
        echo "Não há perguntas cadastradas.";
        return;
    }

    echo "Perguntas existentes:<br>";
    foreach ($arquivos as $arquivo) {
        $conteudo = file_get_contents($arquivo);
        $pergunta = preg_match("/Pergunta: (.+)/", $conteudo, $matches) ? $matches[1] : "Pergunta desconhecida";
        echo "- $pergunta<br>";
    }
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nomeArquivo = $_POST['arquivo'];

    if (!file_exists("$nomeArquivo.txt")) {
        echo "Pergunta não encontrada.";
        exit;
    }

    $conteudo = file_get_contents("$nomeArquivo.txt");
    $pergunta = preg_match("/Pergunta: (.+)/", $conteudo, $matches) ? $matches[1] : "";

    echo "<h2>Alterar Pergunta</h2>";
    echo "<form action=\"alterar_pergunta.php\" method=\"POST\">";
    echo "<label>Nome do Arquivo:</label><br>";
    echo "<input type=\"hidden\" name=\"arquivo\" value=\"$nomeArquivo\">";
    echo "<input type=\"text\" value=\"$nomeArquivo\" disabled><br><br>";
    echo "<label>Pergunta:</label><br>";
    echo "<textarea name=\"pergunta\">$pergunta</textarea><br><br>";
    echo "<input type=\"submit\" name=\"confirmar\" value=\"Confirmar Alteração\">";
    echo "</form>";
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Listar Perguntas</title>
</head>
<body>
    <h2>Selecionar Pergunta para Alterar</h2>
    <?php listarPerguntas(); ?>
    <br>
    <h2>Selecione a Pergunta a Ser Alterada</h2>
    <form action="listar_pergunta.php" method="POST">
        <label>Nome do Arquivo:</label><br>
        <input type="text" name="arquivo"><br><br>
        <input type="submit" name="alterar" value="Alterar Pergunta">
    </form>
</body>
</html>
