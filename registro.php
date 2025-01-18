<?php
AAAAAA
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $password = $_POST['password'];
    $hashed_password = password_hash($password, PASSWORD_DEFAULT); // Criptografa a senha

    $stored_hash = file_get_contents('usuarios.dat'); // Lê o arquivo
    $users = unserialize($stored_hash); // Desserealiza os dados

    if (!isset($users[$username])) {
        $users[$username] = $hashed_password;
        file_put_contents('usuarios.dat', serialize($users)); // Salva os dados criptografados
        echo "<p>Cadastro realizado com sucesso! <a href='index.html'>Faça login</a></p>";
    } else {
        echo "<p>Usuário já existe!</p>";
    }
}
?>
