<?php 

use Classes\Models\Product;

$product = (new Product)->viewById($_GET['id']);

if(!$product) {
	require 'vistas/product-nonexistent.php';
} else {
?>
<section class="container">
    <h1 class="mb-1">You are about to delete a product</h1>

    <article class=" mb-1">
        <div class=" card-body">
            <h2><?= $product->getTitle();?></h2>
            <p><?= $product->getCategory();?></p>
        </div>
        <picture class="">
            <img class="w-25" src="../assets/imgs/<?= $product->getImg();?>" alt="<?= $product->getImgDesc();?>">
        </picture>

        <div><?= $product->getDescription();?></div>
    </article>

    <hr class="mb-1">

    <form action="actions/product-delete.php?id=<?= $_GET['id'];?>" method="post">
        <button class="button button-danger" type="submit">Yes, delete</button>
    </form>
</section>
<?php 
}
?>