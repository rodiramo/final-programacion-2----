<?php 

use Classes\Models\CartFinally;

$id = $_GET['id'];

$cartFinally = (new CartFinally)->getLatestPurchasesForUser($id);

$auxId = -1;
$isNewCart = true;

?>
<style>
td{
    min-width: 150px;
    max-width: 150px;
}
</style>

<section class="container">

    <h1 class="mb-1">My Purchases</h1>
    
     <?php if(empty($cartFinally)):?>
        <div class="mb-1"><spam>You have no purchases yet, check out our products!</spam></div>
     <?php else:?>
         <div class="mb-1"><spam>Latest purchases</spam></div>
     <?php endif;?>
    <?php foreach ($cartFinally as $item): ?>

        <?php
        if($auxId != $item->getCart_byUser_id())
        {
            $isNewCart = true;
        }
        ?>
            <table class="table">
        <?php 
            if($isNewCart || $auxId == $item->getCart_byUser_id()):
        ?>            
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
            <?php if($isNewCart):?>
            <h2 class="total">TOTAL: USD$<?=$item->getFinalPrice(); ?></h2>
                    
            <?php endif;?>
            <?php $auxId = $item->getCart_byUser_id();
                  $isNewCart = false; ?>
            
            </tbody> 
           
            </table>
    
    <?php endforeach; ?>
</section>