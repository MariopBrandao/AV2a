<!DOCTYPE html>
<html>
<head>
    <title>Listar Todas as Perguntas</title>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script>
        $(document).ready(function() {
            $.ajax({
                url: "obter_perguntas.php",
                type: "GET",
                success: function(response) {
                    var perguntas = JSON.parse(response);
                    perguntas.forEach(function(pergunta) {
                        var conteudo = pergunta.conteudo;
                        var perguntaHTML = "<h3>" + pergunta.titulo + "</h3><pre>" + conteudo + "</pre><hr>";
                        $("#perguntas-container").append(perguntaHTML);
                    });
                }
            });
        });
    </script>
</head>
<body>
    <h2>Listar Todas as Perguntas</h2>
    <div id="perguntas-container"></div>
</body>
</html>
