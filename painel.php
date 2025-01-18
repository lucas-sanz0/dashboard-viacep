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
</head>
<body>
    <div class="container">
        <h2>Olá, <?php echo htmlspecialchars($username); ?>!</h2>
        <p>Bem-vindo ao seu painel.</p>
        <a href="logout.php">Sair</a>
    </div>
</body>
</html>
