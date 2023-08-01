<?php
use Classes\Models\Cart_Finally;

$userId = $_GET['id'];

$cart = (new Cart_Finally)->viewById();


        ?>
        <section class="container">
            <h1 class="mb-1">Purchases</h1>
          
            <h2>Latest purchases</h2>
        
            <table class="table">
                <thead>
                    <tr>
                        <th>Title</th>
                        <th>Price</th>
                        <th>Cant</th>
                    </tr>
                </thead>
                <tbody>
                       <tr>
                            <td><?=$cart->getFinalPrice(); ?></td>
                            <td><?=$cart->getFecha(); ?></td>
                        </tr>
                </tbody> 
            </table>
        </section>
        <?php
    
?>
