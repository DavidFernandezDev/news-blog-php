<?php
  //validamos que se muestre mas de 1 pagina
  if ($total_paginas > 1) {
?>
<div class="paginationContainer">
  <nav class="navbar navbar-fixed-bottom pagination">
    <ul class="pagination">
      <?php
          //dibujamos la flecha anterior
          if ($pageNum != 1) {
      ?>
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
          } //se cierra if
      ?>
      <?php
        //se recorre el total de las páginas para ir dibujandolas en la paginación
        for ($i=1; $i <= $total_paginas ; $i++) {
          //identificamos la pagina activada
          if ($pageNum == $i) {
      ?>
      <li class="page-item active">
        <a class="page-link">
          <?php echo $i; ?>
        </a>
      </li>
      <?php
        } else {   //se cierra if y se abre else
      ?>
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
          }   //se cierra else
        }   // se cierra for
      ?>
      <?php
        //dibujamos la flecha siguiente
        if ($pageNum != $total_paginas) {
      ?>
      <li class="page-item">
        <a
          class="pagina page-link"
          data-link="index.php"
          data="<?php echo $pageNum + 1; ?>"
        >
          &raquo;
        </a>
      </li>
      <?php
        }   //se cierra if
      ?>
    </ul>
  </nav>
</div>
<?php
  }   //se cierra if
?>