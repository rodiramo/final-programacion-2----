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
                <th>Count</th>
                <th>Delete item</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($carts as $cartProduct): ?>
            <tr>     
                 <td><img  class="img-table" src="assets/imgs/<?=$cartProduct->getImage();?>" alt="product in cart"></td>
                <td><?=$cartProduct->getName();?></td>
                <td><?=$cartProduct->getPrice();?></td>
                <td><?=$cartProduct->getCant();?></td>
                <td>
                <form action="actions/Cart-delete.php" method="post">
                    <input type="hidden" name="cart_byUser_id" value="<?php echo $cartProduct->getCart_byUser_id()?>">
                    <button style="border: none; background: transparent">

                    <i class="bx bx-trash text-white button-delete btn-danger"></i>                                    
                </button>
                </form>
                    
                </td>
            </tr>
            
            <?php endforeach; ?>
        </tbody>
</table>

<div class="d-flex">
    <form action="actions/Cart-finally.php" method="post">
        <button style="background-color: #b84d1c;" class="btn btn-lg">
            <em class="text-white">Buy</em>
        </button>
    </form>
</div>
