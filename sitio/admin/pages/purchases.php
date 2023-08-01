<?php
use Classes\Models\Cart_Finally;
ini_set('display_errors', 1);
error_reporting(E_ALL);
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
        <?php foreach ($cart as $item): ?>
    <?php echo "<pre>"; print_r($item); echo "</pre>"; ?>
            <tr>
                <td><?=$item->getTitle(); ?></td>
                <td><?=$item->getPrice(); ?></td>
            </tr>
        <?php endforeach; ?>
        </tbody> 
    </table>
</section>
