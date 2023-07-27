<?php 
use Classes\Models\Cart;
$cartProduct = new Cart();
$carts = $cartProduct->todo();


?>

<h1>Cart</h1>

<table class="table">
        <thead>
            <tr>
                <th></th>
                <th>Product</th>
                <th>Price</th>
                <th>My Purchases</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($carts as $cartProduct): ?>
            <tr>     
                 <td><img  class="img-table" src="assets/imgs/<?=$cartProduct->getImage();?>" alt="product in cart"></td>
                <td><?=$cartProduct->getName();?></td>
                <td><?=$cartProduct->getPrice();?></td>
                <td>
                    
                </td>
            </tr>
            
            <?php endforeach; ?>
        </tbody>
</table>
