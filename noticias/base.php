<!DOCTYPE html>
<html lang="pt-br">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="icon" type="image/x-icon" href="/app-de-tv.png">
  <link href="https://fonts.googleapis.com/css2?family=Noto+Sans:wght@600&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css"
    integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
  <title>Linguagem da TV</title>
</head>
<style>
  p {
    font-family: 'Noto Sans', Arial;
    font-size: 17px;
    padding: 0;
    margin: 0;
    text-align: justify;
    margin-left: 25%;
    margin-right: 25%;
    color: white
  }

  h1 {
    font-family: 'Noto Sans', Arial;
    font-size: 30px;
    color: white
  }

  body {
    background: rgb(0, 0, 0)
      /* Green background with 30% opacity */
  }

  .container {
    display: flex;
    align-items: center;
    justify-content: center;
    gap: 8px;
  }
</style>

<body>

<nav class="navbar navbar-dark bg-dark">
  <a class="navbar-brand" href="../index.php">
    <img src="tv.png" width="30" height="30" alt="">
  </a>
</nav>

<br>
<br>
<center>
<?php
  session_start();

  $dsn = 'mysql:host=127.0.0.1;dbname=site';
  $username_db = 'root';
  $password_db = '';
  try {
      $pdo = new PDO($dsn, $username_db, $password_db);
      $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
  } catch(PDOException $e) {
      echo 'Erro ao conectar ao banco de dados: ' . $e->getMessage();
  }

  $stmt = $pdo->query('SELECT * FROM noticias ORDER BY id_noticia DESC LIMIT 1');
  $noticias = $stmt->fetchAll(PDO::FETCH_ASSOC);
  if (count($noticias) > 0 || count($noticias) < 2) {
      foreach ($noticias as $noticia) {
          echo '<h1>' . $noticia['titulo'] . '</h1>';
          echo '<br>';
          echo '<img src="' . $noticia['imagem'] . '">';
          echo '<p>' . $noticia['noticia'] . '</p>';
      }
  } else {
      echo 'Nenhuma notícia encontrada.';
  }
  ?>

  <!-- <img src="/IF-Futebol.jpg" alt="Girl in a jacket" width="700" height="400"> -->
</center>
</body>

</html>