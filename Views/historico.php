<?php
  if(!isset($_SESSION['tipo_pagamento'])){
    die('Você não tem itens no carrinho e não fechou o pedido!');
  }else{
?>
<h2>Pedido em andamento:</h2>

<p>Tipo de pagamento: <?= $_SESSION['tipo_pagamento'] ?></p>
<hr>
<p>Total: R$<?= $_SESSION['total'] ?></p>

<?php
  if($_SESSION['tipo_pagamento'] == 'dinheiro'){
    echo '<hr>';
    echo '<p>Troco: R$'.$_SESSION['valor_troco'].'</p>';
  }
?>

<h2>Itens do seu pedido:</h2>

<table style="width:100%;">
  <tr> 
    <td>#</td>
    <td>Preço</td>
  </tr>
    <?php
      $carrinhoItems = deliveryModel::getItemsCart();
      foreach($carrinhoItems as $key => $value){
        $item = deliveryModel::getItem($value);
    ?>
      <tr>
        <td>
          <?= $item['2'] ?>
        </td>
        <td>
          R$<?= $item['1'] ?>
        </td>
      </tr>
    <?php } ?>
  </table>
<br>

<a href="<?= INCLUDE_PATH ?>historico?resetar">Pedido Entregue!</a>

<?php
  if(isset($_GET['resetar'])){
    session_destroy();
    header('Location: '.INCLUDE_PATH);
  }
}
?>