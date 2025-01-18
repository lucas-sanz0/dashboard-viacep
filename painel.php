<?php
session_start();

if (!isset($_SESSION['username'])) {
    header("Location: index.html");
    exit();
}

$username = $_SESSION['username'];
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Painel</title>
    <link rel="stylesheet" href="style.css">
    <script>
        // Buscar o CEP
        async function buscarCep() {
            const cep = document.getElementById("cep").value;
            if (cep.length !== 8 || isNaN(cep)) {
                alert("Por favor, insira um CEP válido (8 números).");
                return;
            }

            try {
                const response = await fetch(`https://viacep.com.br/ws/${cep}/json/`);
                if (!response.ok) throw new Error("Erro ao buscar o CEP.");
                
                const data = await response.json();
                if (data.erro) {
                    alert("CEP não encontrado.");
                    return;
                }

                // Exibe os dados no formulário
                document.getElementById("logradouro").value = data.logradouro || "";
                document.getElementById("bairro").value = data.bairro || "";
                document.getElementById("cidade").value = data.localidade || "";
                document.getElementById("uf").value = data.uf || "";
            } catch (error) {
                alert("Erro ao buscar o CEP. Tente novamente.");
            }
        }
    </script>
</head>
<body>
<div class="container">
        <h2>Olá, <?php echo htmlspecialchars($username); ?>!</h2>

        <h3>Consulta de CEP</h3>
        <form onsubmit="event.preventDefault(); buscarCep();">
            <input type="text" id="cep" placeholder="Digite o CEP" maxlength="8" required>
            <button type="button" onclick="buscarCep()">Buscar CEP</button>
        </form>

        <h3>Informações do CEP</h3>
        <input type="text" id="logradouro" placeholder="Logradouro" readonly>
        <input type="text" id="bairro" placeholder="Bairro" readonly>
        <input type="text" id="cidade" placeholder="Cidade" readonly>
        <input type="text" id="uf" placeholder="UF" readonly>

        <br><br>
        <a href="logout.php">Sair</a>
    </div>
</body>
</html>
