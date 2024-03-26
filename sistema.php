<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Calculadora de Salário</title>
    <style>
     body {
    font-family: Arial, sans-serif;
    margin: 0;
    padding: 0;
    background-color: #f4f4f4;
}

.container {
    max-width: 800px;
    margin: 0 auto;
    padding: 20px;
}

h1 {
    text-align: center;
    color: #333;
}

form {
    background-color: #fff;
    padding: 20px;
    border-radius: 5px;
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
}

label {
    display: block;
    margin-bottom: 10px;
    font-weight: bold;
}

input[type="text"],
input[type="number"],
input[type="submit"] {
    width: 100%;
    padding: 10px;
    margin-bottom: 20px;
    border: 1px solid #ccc;
    border-radius: 5px;
}

input[type="submit"] {
    background-color: #007bff;
    color: #fff;
    cursor: pointer;
    transition: background-color 0.3s ease;
}

input[type="submit"]:hover {
    background-color: #0056b3;
}

.result {
    margin-top: 20px;
    padding: 10px;
    background-color: #d4edda;
    border: 1px solid #c3e6cb;
    border-radius: 5px;
    color: #155724;
}
    </style>
</head>
<body>
    <h1>Calculadora de Salário</h1>
    <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
        <label for="nome">Nome do Vendedor:</label>
        <input type="text" id="nome" name="nome"><br><br>
        <label for="vendas_semanais">Valor das Vendas Semanais:</label>
        <input type="number" id="vendas_semanais" name="vendas_semanais"><br><br>
        <label for="vendas_mensais">Valor das Vendas Mensais:</label>
        <input type="number" id="vendas_mensais" name="vendas_mensais"><br><br>
        <input type="submit" value="Calcular Salário">
    </form>

    <?php
    // Verifica se o formulário foi submetido
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // Recebe os dados do formulário
        $nome = $_POST["nome"];
        $vendasSemanais = $_POST["vendas_semanais"];
        $vendasMensais = $_POST["vendas_mensais"];

        // Definição das metas e valores
        $metaSemanal = 20000; // 20 mil reais
        $metaMensal = 80000; // 80 mil reais
        $salarioMinimo = 2000; // Salário mínimo

        // Cálculo do salário final
        $salarioFinal = $salarioMinimo;

        // Verifica se a meta semanal foi cumprida
        if ($vendasSemanais >= $metaSemanal) {
            $salarioFinal += $metaSemanal * 0.01; // 1% sobre o valor da meta
            $excedenteSemanal = $vendasSemanais - $metaSemanal;
            $salarioFinal += $excedenteSemanal * 0.05; // 5% sobre o excedente semanal
        }

        // Verifica se a meta mensal foi cumprida
        if ($vendasMensais >= $metaMensal && $vendasSemanais >= $metaSemanal) {
            $excedenteMensal = $vendasMensais - $metaMensal;
            $salarioFinal += $excedenteMensal * 0.1; // 10% sobre o excedente mensal
        }

        // Exibe o resultado para o usuário
        echo "<h2>Resultado</h2>";
        echo "Nome do Vendedor: $nome<br>";
        echo "Salário Final: R$ " . number_format($salarioFinal, 2, ",", ".");
    }
   ?>
</body>
</html>