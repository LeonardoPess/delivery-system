<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="<?= INCLUDE_PATH ?>css/style.css">
  <title>Delivery</title>
</head>
<body>

  <section class="descricao-home">
    <div class="container">
      <h2><i class="fas fa-bullhorn"></i> Faça seu pedido conosco!</h2>
      <a href="<?= INCLUDE_PATH ?>fechar-pedido">Fechar pedido</a>
    </div><!--container-->
  </section><!--descricao-home-->

  <section class="lista-produtos">
    <div class="container">

    <?php 
      $sushi = deliveryModel::listarItems();
      foreach($sushi as $key => $value){
    ?>

      <div class="box-single-food">
        <img src="<?= INCLUDE_PATH ?>/images/<?= $value['0'] ?>">
        <p><?= $value['1'] ?></p>
        <a href="<?= INCLUDE_PATH ?>?addCart=<?= $key ?>">Adicionar ao carrinho</a>
      </div><!--box-single-food-->

      <?php } ?>

    </div><!--container-->
  </section><!--descricao-home-->
  
<script src="<?= INCLUDE_PATH ?>js/all.min.js"></script>
</body>
</html>