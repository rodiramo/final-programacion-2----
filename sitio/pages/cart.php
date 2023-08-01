<?php 
use Classes\Models\Cart;
$cartProduct = new Cart();
$carts = $cartProduct->todo();
?>

<h1>Cart</h1>

<table class="table">
<?php if(!empty($carts)): ?>
        <thead>
            <tr>
                <th></th>
                <th>Product</th>
                <th>Price</th>
                <th>Count</th>
                <th>Delete item</th>
            </tr>
        </thead>
 <?php else: ?>
    <div class="container d-flex flex-column">
 <h2>Your Cart is Empty</h2> 
 <br>
 <p>Check out our products and choose your favourites to add to your cart!</p>
 <img src="assets/imgs/orchid.png" alt="orchid" class="orchid">
 </div>
 <?php endif; ?>
        <tbody>
            <?php foreach ($carts as $cartProduct): ?>
            <tr>     
                 <td><img  class="img-table" src="assets/imgs/<?=$cartProduct->getImage();?>" alt="product in cart"></td>
                <td><?=$cartProduct->getName();?></td>
                <td><?=$cartProduct->getPrice();?></td>
                <td><?=$cartProduct->getCant();?></td>
                <td>
                <form action="actions/cart-delete.php" method="post">
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
    <form action="actions/cart-finally.php" method="post">
        <?php if(!empty($carts)): ?>
        <button style="background-color: #5ED831;" class="btn btn-lg">
            <em class="text-white">Finish the Purchase!</em>
        </button>
     <?php endif; ?>

    </form>
</div>
