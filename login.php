<?php
session_start();
AAAAAAAA
$stored_hash = file_get_contents('usuarios.dat'); // Lê o arquivo de usuários
$users = unserialize($stored_hash); // Desserealiza os dados

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $password = $_POST['password'];

    if (isset($users[$username]) && password_verify($password, $users[$username])) {
        $_SESSION['username'] = $username;
        header("Location: painel.php");
        exit();
    } else {
        echo "<p>Usuário ou senha inválidos!</p>";
    }
}
?>
