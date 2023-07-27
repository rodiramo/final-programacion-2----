<?php

use Classes\Models\Product;
// require_once __DIR__ . '/../libraries/products.php';
$product = (new Product)-> viewById($_GET['id']);


?>
<section id="services" class="services section-bg">
    <h1 hidden>Product Page</h1>
    <div class="column-xs-12 space">

        <ol class="breadcrumb-list">
            <li class="breadcrumb-item"><a href="index.php?s=home">Home</a></li>
            <li class="breadcrumb-item"><a href="index.php?s=products">Household Plants</a></li>
            <li class="breadcrumb-item active"><?= $product->getTitle() ?></li>
        </ol>

    </div>

    <aside class="container-fluid space">

        <div class="row d-flex justify-content-center">
            <div class="col-md-4 img-productview">
                <img src="assets/imgs/<?= $product->getImg(); ?>" alt="<?= $product->getImgDesc() ?>">
            </div>
            <div class="col-md-6">

                <h2 class="p-name"><?= $product->getTitle(); ?></h2>
                <div class="linea2"></div>

                <div class="product-detail-content">
                    <p class="p-category"><?= $product->getCategory(); ?></p>

                    <div class="p-features">
                        <h4>Plant Family</h4>
                        <p class="p-name"><?= $product->getType(); ?></p>
                        <h4>About this product</h4>
                        <p class="p-description"> <?= $product->getDescription() ?></p>
                    </div>
                    <div class="p-qty-and-cart">
                        <div class="p-add-cart">
                            <span class="price"><?= $product->getPrice(); ?> $USD</span>
                           
                            <form action="actions/cart.php" method="post">
                           
                        <button class="btn-theme btn buy-btn" type="submit" name="addToCart" tabindex="0"><em class="text-white">Add to Cart</em>
                            <i class='bx bx-cart'></i>
                            </button> 
                            <!--hidden-->
                            <input type="hidden"  name="name" value="<?= $product->getTitle();?>">
                            <input type="hidden"  name="image" value="<?= $product->getImg();?>">
                            <input type="hidden"  name="price" value="<?= $product->getPrice();?>">
                            <input type="hidden" name="product_id" value="<?= $product->getProductId(); ?>">
                        </form>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </aside>
</section>