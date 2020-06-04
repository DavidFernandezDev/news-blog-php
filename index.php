<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>

  <script type="text/javascript" src="js/jquery.js"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
  
  <link rel="stylesheet" href="index.css" />
  <script type="text/javascript" src="js/paginacion.js?v=<?php echo(rand()); ?>"></script>
</head>
<body>
  <section id="section">
    <?php
       $url = "http://newsapi.org/v2/top-headlines?country=us&apiKey=77fc7d5e7fe74f938feb2d1cb84aa141";
       $response = file_get_contents($url);
       $newsData = json_decode($response);
    ?>
    <div class="jumbotron header">
      <h1>News Blog</h1>
    </div>
    <div class="container-fluid">
      <?php
        $num_total_registros = count($newsData->articles);
         
        //Si hay registros
        if ($num_total_registros > 0) {
  
          //numero de registros por página
          $rowsPerPage = 10;
  
          //por defecto se comienza en la página 1
          $pageNum = 1;
  
          //se obtiene numero de página seleccionada por el usuario
          if(isset($_GET['pagina'])) {
            sleep(1);
            $pageNum = $_GET['pagina'];
          }
  
  
          $offset = ($pageNum - 1) * $rowsPerPage;    //numero de registro donde comienza la siguiente página
          $total_paginas = ceil($num_total_registros / $rowsPerPage);   //total paginas a mostrar
  
          foreach(
            array_slice($newsData->articles, $offset, $rowsPerPage)
            as $news
          ) {
      ?>
      <div class="container jumbotron">
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
            Author: <?php echo $news->author ?>
          </div>
          <div class="block">
            Published: <?php echo $news->publishedAt ?>
          </div>
        </div>
      </div>
      <?php
          }
        }
      ?>
      <?php
        //validamos que haya mas de 1 pagina
        if ($total_paginas > 1) {
      ?>
      <div class="contenedorPaginacion">
        <nav class="navbar navbar-fixed-bottom">
          <ul class="pagination">
            <!--si la página seleccionada es diferente a 1-->
            <?php
              if ($pageNum != 1)
            ?>
            <!--se muestra "Anterior" para retroceder de página-->
            <li class="page-item">
              <a
                class="pagina page-link"
                data-link="index.php"
                data="<?php echo $pageNum - 1; ?>"
              >
                &laquo;
              </a>
            </li>
            <?php
              //se recorre el total de las páginas para ir dibujandolas en la paginación
              for ($i=1; $i <= $total_paginas ; $i++) {
                //si la pagina seleccionada
                if ($pageNum == $i) {
            ?>
            <!--se activa la página que se encuentra seleccionada-->
            <li class="page-item active">
              <a class="page-link">
                <?php echo $i; ?>
              </a>
            </li>
            <?php
                } else {   //se cierra if y se abre else
            ?>
            <!--se dibuja página en la paginación-->
            <li class="page-item">
              <a
                class="pagina page-link"
                data-link="index.php"
                data="<?php echo $i; ?>"
              > 
                <?php echo $i; ?> 
              </a>
            </li>
            <?php 
                }  //se cierra else
              }  // se cierra for
            ?>
            <!--se muestra "siguiente" para avanzar de página-->
            <?php
              if ($pageNum != $total_paginas)
            ?>
            <li class="page-item">
              <a
                class="pagina page-link"
                data-link="/"
                data="<?php echo $pageNum + 1; ?>"
              >
                &raquo;
              </a>
            </li>
          </ul>
        </nav>
      </div>
      <?php
        }  //se cierra if
      ?>
    </div>
  </section>
</body>
</html>