<?php
// leer JSON

use Classes\Models\Product;
$product = new Product;
$products = $product->todo();


?>
<section id="products-section">
    <div>
        <h1>Shop Our Products</h1>
    </div>
    <article class="main-cards">
        <h2>The best place for plants</h2>
        <div class="cards-container">
            <?php foreach ($products as $product) : ?>
            <div class="cards-item">
                <div class="card">
                    <a href="index.php?s=product-view&id=<?= $product->getProductId(); ?>">
                        <div class="card_image">
                            <img src="assets/imgs/<?= $product->getImg(); ?>" alt="<?= $product->getImgDesc() ?>">
                            <div class="overlay">
                                <div class="icon_card_img">View More</div>
                            </div>
                        </div>
                    </a>
                    <div class="card_content">
                        <em class="product_category"><?= $product->getCategory(); ?></em>
                        <h3 class="card_title"><?= $product->getTitle() ?></h3>
                        <p><?= $product->getType(); ?></p>
                        <p class="card_text"><?= $product->getPrice(); ?>$USD</p>
                       <form action="actions/cart.php" method="post">
                            <div class="cart-card"> <button type="submit" name="addToCart"><i class='bx bx-cart'></i></button>
                            </div>
                            <!--hidden-->
                            <input type="hidden"  name="name" value="<?= $product->getTitle();?>">
                            <input type="hidden"  name="image" value="<?= $product->getImg();?>">
                            <input type="hidden"  name="price" value="<?= $product->getPrice();?>">
                            <input type="hidden" name="product_id" value="<?= $product->getProductId(); ?>">
                        </form>
                    </div>



                </div>
            </div>
            <?php endforeach; ?>

        </div>
    </article>
</section>