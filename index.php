<!DOCTYPE html>
<html lang="pt-br">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="icon" type="image/x-icon" href="/app-de-tv.png">
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css"
    integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
  <title>Linguagem da TV</title>
</head>
<style>
    body {
    background: rgb(0, 0, 0)
  }

    h1{
        text-align: center;
        color: #ffff;
    }
    h2{
        color: #ffff;
    }
    h3 {
        color: black;
    }
    p{
        color: #ffff;
    }
    .cab{
      position: absolute;
      top: 300px;
      left: 700px;
    }
</style>
<body>

  <nav class="navbar navbar-dark bg-dark">
    <a class="navbar-brand" href="/index.html">
      <img src="tv.png" width="30" height="30" alt="">
    </a>
  </nav>

  <h1>Bem-vindo ao Portal Linguagem da TV</h1>
  <a href="login.php">Login</a>
    <?php
    session_start();
    if(isset($_SESSION['username'])) {
        echo "<p>Usuário cadastrado: " . $_SESSION['username'] . "</p>";
        echo "<a class='user' href='criar_noticia.php'>Criar notícia</a>";
    }

    $dsn = 'mysql:host=127.0.0.1;dbname=site';
    $username_db = 'root';
    $password_db = '';
    try {
        $pdo = new PDO($dsn, $username_db, $password_db);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    } catch(PDOException $e) {
        echo 'Erro ao conectar ao banco de dados: ' . $e->getMessage();
    }
    ?>
    <br>
    <br>
    <h2>Últimas notícias:</h2>

    <div class="cab">
    <div class="card" style="width: 30rem;">
      <img class="card-img-top" src="noticias/apple.png" alt="Imagem de capa do card">
      <div class="card-body">
        <h5 class="card-title">
            <?php
            $stmt = $pdo->query('SELECT titulo FROM noticias ORDER BY id_noticia DESC LIMIT 1');
            $noticias = $stmt->fetchAll(PDO::FETCH_ASSOC);
            if (count($noticias) > 0 || count($noticias) < 2) {
                foreach ($noticias as $noticia) {
                    echo '<h3>' . $noticia['titulo'] . '</h3>';
                }
            } else {
                echo 'Nenhuma notícia encontrada.';
            }
            ?>
        </h5>
        <p class="card-text"></p>
        <a href="noticias/656532788449c.php" class="btn btn-primary">Visitar</a>
      </div>
    </div>
    </div>

</body>

</html>