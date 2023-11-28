<?php
session_start();
if(!isset($_SESSION['username'])) {
    header('Location: index.php');
    exit();
}

if(isset($_POST['titulo']) && isset($_FILES['imagem']) && isset($_POST['noticia'])) {
    // Salvar os dados da notícia no banco de dados
    $titulo = $_POST['titulo'];
    $imagem = $_FILES['imagem']['name'];
    $noticia = $_POST['noticia'];

    // Conectar ao banco de dados usando PDO
    $dsn = 'mysql:host=127.0.0.1;dbname=site';
    $username_db = 'root';
    $password_db = '';
    try {
        $pdo = new PDO($dsn, $username_db, $password_db);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        // Salvar os dados da notícia na tabela de notícias
        $stmt = $pdo->prepare('INSERT INTO noticias (titulo, imagem, noticia) VALUES (:titulo, :imagem, :noticia)');
        $stmt->execute(array(
            ':titulo' => $titulo,
            ':imagem' => $imagem,
            ':noticia' => $noticia
        ));

        // Mover a imagem para a pasta de notícias
        move_uploaded_file($_FILES['imagem']['tmp_name'], 'noticias/' . $imagem);

        if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // Processar os dados do formulário

        // Criar o conteúdo da nova página
        $conteudo = "<?php require_once 'base.php'; ?>";

        // Gerar um nome único para a nova página
        $nomePagina = uniqid() . ".php";

        // Caminho completo para a nova página
        $caminhoPagina = "noticias/" . $nomePagina;

        // Criar o arquivo da nova página
        file_put_contents($caminhoPagina, $conteudo);

        // Redirecionar o usuário para a nova página
        header("Location: $caminhoPagina");
        exit;
        }
    } catch(PDOException $e) {
        echo 'Erro ao conectar ao banco de dados: ' . $e->getMessage();
    }
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Criar Notícia</title>
</head>
<body>
    <h1>Criar Notícia</h1>
    <form method="POST" action="" enctype="multipart/form-data">
        <label for="titulo">Título:</label>
        <input type="text" name="titulo" id="titulo" required><br>

        <label for="imagem">Imagem:</label>
        <input type="file" name="imagem" id="imagem" required><br>

        <label for="noticia">Notícia:</label><br>
        <textarea name="noticia" id="noticia" rows="10" cols="50" required></textarea><br>

        <input type="submit" value="Publicar">
    </form>
</body>
</html>
