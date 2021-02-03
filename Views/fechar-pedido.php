<?php
  if(!isset($_SESSION['carrinho'])){
    die('Você não tem itens no carrinho!');
  }else{
?>
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
      <h2>Seu carrinho!</h2>
      <a href="<?= INCLUDE_PATH ?>home">Voltar Home</a>
    </div><!--container-->
  </section><!--descricao-home-->

  <?php
    if(isset($_POST['acao'])){

      if(!isset($_SESSION['carrinho'])){
        die('Você não tem itens no carrinho!');
      }

      $metodoPagamento = $_POST['opcao_pagamento'];
      $_SESSION['tipo_pagamento'] = $metodoPagamento;
      $_SESSION['total'] = deliveryModel::totalPedido();

      if($metodoPagamento == 'dinheiro'){
        if($_POST['troco'] != ''){
          $valorTroco = $_POST['troco'] - deliveryModel::totalPedido();
          if($valorTroco >= 0){
            $_SESSION['valor_troco'] = $valorTroco;
          }else{
            die('O valor precisa ser maior do que o preço do pedido');
          }
        }else{
          die('Você escolheu dinheiro como pagamento, portanto precisa especificar o troco!');
        }
      }
      echo '<script>alert("Seu pedido foi efetuado com sucesso!")</script>';
      echo '<script>location.href="'.INCLUDE_PATH.'historico"</script>';

    }
  ?>

  <div class="container">
    <br>
      <h5>O total do seu pedido foi: R$<?= number_format(deliveryModel::totalPedido(), 2, ',',' '); ?></p>
    <br>
      <form method="post">
        <p>Escolha seu método de pagamento:</p>
        <br>
        <select name="opcao_pagamento">
          <option value="cartao credito">Cartão de Crédito</option>
          <option value="cartao debito">Cartão de Debito</option>
          <option value="dinheiro">Dinheiro</option>
        </select>
        <br>
      <div style="display: none;" class="troco">
      <br>
        <p>Troco para quanto?</p>
        <input type="text" name="troco">
        <br>
      </div>
      <br>
      <input type="submit" name="acao" value="Fechar Pedido">
      </form>

    <br>
  <table>
    <?php
      $carrinhoItems = deliveryModel::getItemsCart();
      foreach($carrinhoItems as $key => $value){
        $item = deliveryModel::getItem($value);
    ?>
      <tr>
        <td>
          <img src="<?= INCLUDE_PATH.'images/'.$item['0'] ?>">
        </td>
        <td>R$<?= $item['1'] ?></td>
      </tr>
    <?php } ?>
  </table>
  <br>
  <br>      
</div><!--container-->

<script src="<?= INCLUDE_PATH ?>js/all.min.js"></script>
<script>
  let select = document.querySelector('select');
  let troco = document.querySelector('.troco');
  select.addEventListener('change',function(){
    if(this.value == 'dinheiro'){
      troco.style.display = "block";
    }else{
      troco.style.display = "none";
    }
  })
</script>
</body>
</html>
<?php } ?>