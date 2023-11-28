<?php
session_start();
if(isset($_POST['username']) && isset($_POST['password'])) {
    // Verificar se o login está registrado no banco de dados
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Conectar ao banco de dados usando PDO
    $dsn = 'mysql:host=127.0.0.1;dbname=site';
    $username_db = 'root';
    $password_db = '';
    try {
        $pdo = new PDO($dsn, $username_db, $password_db);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $stmt = $pdo->prepare('SELECT * FROM usuarios WHERE username = :username AND password = :password');
        $stmt->execute(array(
            ':username' => $username,
            ':password' => $password
        ));
        $result = $stmt->fetch(PDO::FETCH_ASSOC);

        if($result) {
            $_SESSION['username'] = $result['username'];
            header('Location: index.php');
            exit();
        } else {
            echo "Usuário ou senha inválidos.";
        }
    } catch(PDOException $e) {
        echo 'Erro ao conectar ao banco de dados: ' . $e->getMessage();
    }
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Login</title>
</head>
<body>
    <h1>Login</h1>
    <form method="POST" action="">
        <label for="username">Usuário:</label>
        <input type="text" name="username" id="username" required><br>

        <label for="password">Senha:</label>
        <input type="password" name="password" id="password" required><br>

        <input type="submit" value="Entrar">
    </form>
</body>
</html>