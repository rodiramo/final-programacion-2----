<?php
use Classes\Models\CartFinally;
ini_set('display_errors', 1);
error_reporting(E_ALL);

$user_id = isset($_GET['id']) ? intval($_GET['id']) : 0;
$cart = new CartFinally();
$cartItems = $cart->getLatestPurchasesForUser($user_id);

?>

<section class="container">
    <h1 class="mb-1">Purchases</h1>
    <h2>Latest purchases</h2>
    <table class="table">
        <thead>
            <tr>
                <th>Title</th>
                <th>Price</th>
                <th>Quantity</th>
                <th>Total Price</th>
                <th>Date</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($cartItems as $cartItem): ?>
                <tr>
                    <td><?= $cartItem->getName(); ?></td>                    
                    <td><?= $cartItem->getPrice(); ?></td>
                    <td><?= $cartItem->getCant(); ?></td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</section>
