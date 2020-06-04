<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>

  <script type="text/javascript" src="js/jquery.js"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
  
  <link rel="stylesheet" href="index.css?v=<?php echo(rand()); ?>" />
  <script type="text/javascript" src="js/paginacion.js?v=<?php echo(rand()); ?>"></script>
  <script type="text/javascript" src="js/home/index.js?v=<?php echo(rand()); ?>"></script>
</head>
<body>
  <section id="section">
    <?php
      //consumiendo APIs
       $url = "http://newsapi.org/v2/top-headlines?country=us&apiKey=77fc7d5e7fe74f938feb2d1cb84aa141";
       $response = file_get_contents($url);
       $newsData = json_decode($response);

       $urlRandomUser = "https://randomuser.me/api/?results=100";
       $responseUser = file_get_contents($urlRandomUser);
       $users = json_decode($responseUser);
      
       $authors = $users->results;
       $numNews = count($newsData->articles);
       
       $rowsPerPage = 10;   //numero de registros por página
       $pageNum = 1;    //pagina activa
  
       //se obtiene numero de página seleccionada por el usuario
        if(isset($_GET['pagina'])) {
          sleep(1);
          $pageNum = $_GET['pagina'];   //cambiando la pagina activa
        }
  
        $offset = ($pageNum - 1) * $rowsPerPage;    //numero de registro donde comienza la siguiente página
        $total_paginas = ceil($numNews / $rowsPerPage);   //total paginas a mostrar
        $idx = 0;
    ?>
    <div class="jumbotron header">
      <h1>News Blog</h1>
    </div>
    <div class="container-fluid">
      <?php
        //Si hay registros
        if ($numNews > 0) {

          //se recorre cada noticia
          foreach(
            array_slice($newsData->articles, $offset, $rowsPerPage)
            as $news
          ) {
      ?>
      <div
        class="newContainer jumbotron"
        onclick="onClickNews('<?php echo $news->url; ?>')"
      >
        <img class="image rounded img-fluid" src="<?php echo $news->urlToImage ?>" />
        <div class="content">
          <h1 class="title">
            <?php echo $news->title ?>
          </h1>
          <div class="block">
            <?php echo $news->description ?>
          </div>
          <div class="block">
            <?php echo $news->content ?>
          </div>
          <div class="block">
            Author:
            <?php
              echo $authors[$idx]->name->first . ' ' . $authors[$idx]->name->last;
            ?>
          </div>
          <div class="block">
            Published: <?php echo $news->publishedAt ?>
          </div>
        </div>
      </div>
      <?php
            $idx++;
          } //se cierra foreach
        } //se cierra if
      ?>
      <div class="paginationSection">
        <?php include("php/home/pagination.php"); ?>
      </div>
    </div>
  </section>
</body>
</html>