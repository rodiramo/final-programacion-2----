<?php 

use Classes\Models\Cart_Finally;

$cartFinally = (new Cart_Finally)->viewById($_GET['id']);

?>
<style>

</style>

<section class="container">
    <h1 class="mb-1">Purchases</h1>
    <?php echo $_GET['id']

        
    ?>
    <div class="mb-1"><spam>Latest purchases</spam></div>

    <table class="table">
        <thead>
            <tr>
                <th>Title</th>
                <th>Price</th>
                <th>Cant</th>
                <th></th>
            </tr>
        </thead>
         <tbody>
            <!-- <?php 
			foreach($cartFinally as $item):
			?>
            <tr>
                <td><?= $item->getName();?></td>
                <td><?= $item->getPrice();?></td>
                <td><?= $item->getCant();?></td>
                
            </tr>
            <?php 
			endforeach;
			?> -->
        </tbody> 
    </table>
</section>