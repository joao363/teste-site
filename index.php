<?php
    // Inclui o arquivo de configuração
    include('config.php');

    if(isset($_POST['submit'])) {
        // Sanitiza e obtém os dados do formulário
        $paciente = $conexao->real_escape_string($_POST['entrevistado']);
        $entrevistador = $conexao->real_escape_string($_POST['entrevistador']);
        $pergunta1 = $conexao->real_escape_string($_POST['recepcao']);
        $pergunta2 = $conexao->real_escape_string($_POST['quarto']);
        $pergunta3 = $conexao->real_escape_string($_POST['geral']);
        $observacoes = $conexao->real_escape_string($_POST['observacoes']);

        // Insere os dados na tabela
        $sql = "INSERT INTO pesquisanir (paciente, entrevistador, pergunta1, pergunta2, pergunta3, observacoes) VALUES ('$paciente', '$entrevistador', '$pergunta1', '$pergunta2', '$pergunta3', '$observacoes')";

        if($conexao->query($sql) === TRUE) {
            echo "<div style='position: absolute; top: 10px; left: 10px;'>
                    <p>Dados enviados com sucesso!</p>
                  </div>";
        } else {
            echo "<div style='position: absolute; top: 10px; left: 10px;'>
                    <p>Erro: " . $conexao->error . "</p>
                  </div>";
        }
    }
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Formulário de Satisfação NIR</title>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Merriweather:wght@400;700&family=Poppins:wght@400;500&display=swap">
    <style>
        body {
            font-family: 'Poppins', sans-serif;
            background-image: linear-gradient(to right, rgb(219, 152, 8), rgb(126, 219, 157));
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }
        .container {
            background-color: #fff;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            max-width: 800px;
            width: 100%;
        }
        .title {
            text-align: center;
            font-size: 24px;
            margin-bottom: 20px;
            font-weight: bold;
            font-family: 'Merriweather', serif;
        }
        .input-group {
            margin-bottom: 15px;
        }
        .input-group label {
            display: block;
            margin-bottom: 5px;
            font-weight: bold;
            font-family: 'Merriweather', serif;
        }
        .input-group input,
        .input-group textarea {
            width: 100%;
            padding: 8px;
            box-sizing: border-box;
            font-family: 'Poppins', sans-serif;
        }
        .form-group {
            margin-bottom: 20px;
        }
        .form-group label {
            display: block;
            margin-bottom: 5px;
            font-weight: bold;
        }
        .button-rating {
            display: flex;
            justify-content: space-between;
        }
        .button-option {
            padding: 10px 20px;
            border: 1px solid #ccc;
            border-radius: 5px;
            cursor: pointer;
        }
        .button-option.selected {
            background-color: #ccc;
        }
        .submit-button {
            background-color: #4CAF50;
            color: white;
            padding: 15px 20px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }
        .submit-button:hover {
            background-color: #45a049;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="title">Formulário de Satisfação NIR</div>
        <form method="POST" action="">
            <div class="input-group">
                <label for="entrevistado">Nome do Entrevistado:</label>
                <input type="text" id="entrevistado" name="entrevistado">
            </div>
            <div class="input-group">
                <label for="entrevistador">Nome do Entrevistador:</label>
                <input type="text" id="entrevistador" name="entrevistador">
            </div>
            <div class="form-group">
                <label>Qual seu nível de satisfação com a recepção?</label>
                <div class="button-rating" id="button-rating-recepcao">
                    <div class="button-option pessimo" onclick="setButtonSatisfaction('recepcao', 'Péssimo', this)">Péssimo</div>
                    <div class="button-option ruim" onclick="setButtonSatisfaction('recepcao', 'Ruim', this)">Ruim</div>
                    <div class="button-option bom" onclick="setButtonSatisfaction('recepcao', 'Bom', this)">Bom</div>
                    <div class="button-option excelente" onclick="setButtonSatisfaction('recepcao', 'Excelente', this)">Excelente</div>
                </div>
                <input type="hidden" id="recepcao" name="recepcao">
            </div>
            <div class="form-group">
                <label>Qual seu nível de satisfação com o quarto?</label>
                <div class="button-rating" id="button-rating-quarto">
                    <div class="button-option pessimo" onclick="setButtonSatisfaction('quarto', 'Péssimo', this)">Péssimo</div>
                    <div class="button-option ruim" onclick="setButtonSatisfaction('quarto', 'Ruim', this)">Ruim</div>
                    <div class="button-option bom" onclick="setButtonSatisfaction('quarto', 'Bom', this)">Bom</div>
                    <div class="button-option excelente" onclick="setButtonSatisfaction('quarto', 'Excelente', this)">Excelente</div>
                </div>
                <input type="hidden" id="quarto" name="quarto">
            </div>
            <br>
            <div class="form-group">
                <label>Qual seu nível de satisfação geral?</label>
                <div class="button-rating" id="button-rating-geral">
                    <div class="button-option pessimo" onclick="setButtonSatisfaction('geral', 'Péssimo', this)">Péssimo</div>
                    <div class="button-option ruim" onclick="setButtonSatisfaction('geral', 'Ruim', this)">Ruim</div>
                    <div class="button-option bom" onclick="setButtonSatisfaction('geral', 'Bom', this)">Bom</div>
                    <div class="button-option excelente" onclick="setButtonSatisfaction('geral', 'Excelente', this)">Excelente</div>
                </div>
                <input type="hidden" id="geral" name="geral">
            </div>
            
            <div class="input-group">
                <label for="observacoes">Observações:</label>
                <input type="text" id="observacoes" name="observacoes">                
            </div>

            <button class="submit-button" type="submit" name="submit">ENVIAR</button>
        </form>
    </div>

    <script>
        function setButtonSatisfaction(field, value, element) {
            document.getElementById(field).value = value;
            
            var options = element.parentNode.getElementsByClassName('button-option');
            for (var i = 0; i < options.length; i++) {
                options[i].classList.remove('selected');
            }
            element.classList.add('selected');
        }
    </script>
</body>
</html>
