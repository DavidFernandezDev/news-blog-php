<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
  <link rel="stylesheet" href="index.css" />
</head>
<body>
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
      foreach($newsData->articles as $news) {
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
    ?>
  </div>
</body>
</html>