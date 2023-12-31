<?php
use Classes\Models\CartFinally;
ini_set('display_errors', 1);
error_reporting(E_ALL);

$user_id = isset($_GET['id']) ? intval($_GET['id']) : 0;
$cart = new CartFinally();
$cartItems = $cart->getLatestPurchasesForUser($user_id);
$auxId = -1;
$isNewCart = true;

?>
<section class="container">

    <h1 class="mb-1">User Purchases</h1>
    
     <?php if(empty($cartItems)):?>
        <div class="mb-1"><p>This user has no purchases 😔</p></div>
     <?php else:?>
         <div class="mb-1"><p>Latest purchases</p></div>
     <?php endif;?>
    <?php foreach ($cartItems as $item): ?>

        <?php
        if($auxId != $item->getCart_byUser_id())
        {
            $isNewCart = true;
        }
        ?>
               <?php 
            if($isNewCart || $auxId == $item->getCart_byUser_id()):
        ?>           
        <?php if($isNewCart):?>                 
             <h2 class="total">TOTAL: USD$<?=$item->getFinalPrice(); ?></h2>
             
             <?php endif; ?>
     <table class="table">
          <?php if($isNewCart):?> 
                    
                  
                    
                    <thead>
                        <tr>
                            <th>Title</th>
                            <th>Price</th>
                            <th>Cant</th>
                        </tr>
                    </thead>
                <?php endif; ?>
            
            <tbody>
            
            <tr>
                    <td><?=$item->getName(); ?></td>
                    <td><?=$item->getPrice(); ?></td>
                    <td><?=$item->getCant(); ?></td>
            </tr>

            <?php endif;?>
          
            <?php $auxId = $item->getCart_byUser_id();
                  $isNewCart = false; ?>
            
            </tbody> 
        
            </table>
    <?php endforeach; ?>
</section>
