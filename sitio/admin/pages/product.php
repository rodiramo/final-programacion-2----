<?php 

use Classes\Models\Product;

$products = (new Product)->todo();

?>
<section class="container">
    <h1 class="mb-1">Admin Products</h1>

    <div class="mb-1"><a href="index.php?s=product-publish">Publish new Product</a></div>

    <table class="table">
        <thead>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Category</th>
                <th>Family</th>
                <th>Descripcion</th>
                <th>Price</th>
                <th>Image</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            <?php 
			foreach($products as $product):
			?>
            <tr>
                <td><?= $product->getProductId();?></td>
                <td><?= $product->getTitle();?></td>
                <td><?= $product->getCategory();?></td>
                <td><?= $product->getType();?></td>
                <td><?= $product->getDescription();?></td>
                <td><?= $product->getPrice();?>$USD</td>
                <td><img src="<?= '../assets/imgs/' . $product->getImg();?>" alt="<?= $product->getImgDesc();?>">
                </td>
                <td>
                    <div>
                        <div class="button-space">

                            <a class="text-white button m-20"
                                href="index.php?s=product-edit&id=<?= $product->getProductId();?>"> Edit</a>

                        </div>

                        <div class="button-space">
                            <a class="text-white button-delete btn-danger" href=" 
                                    index.php?s=product-delete&id=<?= $product->getProductId();?>">Delete</a>

                        </div>
                    </div>
                </td>
            </tr>
            <?php 
			endforeach;
			?>
        </tbody>
    </table>
</section>