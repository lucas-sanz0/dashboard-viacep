<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $password = $_POST['password'];
    $hashed_password = password_hash($password, PASSWORD_DEFAULT); // Criptografa a senha

    $stored_hash = file_get_contents('users.dat'); // Lê o arquivo de usuários
    $users = unserialize($stored_hash); // Desserealiza os dados

    if (!isset($users[$username])) {
        $users[$username] = $hashed_password;
        file_put_contents('users.dat', serialize($users)); // Salva os dados criptografados
        echo "<p>Cadastro realizado com sucesso! <a href='index.html'>Faça login</a></p>";
    } else {
        echo "<p>Usuário já existe!</p>";
    }
}
?>
