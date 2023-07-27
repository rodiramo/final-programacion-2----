<?php 


use Classes\Models\Product;

$errors = $_SESSION['errors'] ?? [];
$dataForm = $_SESSION['data-form'] ?? [];
unset($_SESSION['errors'], $_SESSION['data-form']);



$product = (new Product) ->viewById($_GET['id']);


?>
<section class="container">
    <h1 class="mb-1">Edit Product</h1>

    <p class="mb-1">Modify the data of the product </p>

    <form action="actions/product-edit.php?id=<?= $product->getProductId();?>" method="post"
        enctype="multipart/form-data">
        <div class="form-fila">
            <label for="name">Name</label>
            <input type="text" id="name" name="name" class="form-control"
                aria-describedby="help-name <?= isset($errors['name']) ? 'error-name' : null; ?>"
                value="<?= $dataForm['name'] ?? $product->getTitle();?>">
            <div class="form-help text-danger" id="help-name">Has to have at least two characters.</div>
            <?php 
			if(isset($errors['name'])):
			?>
            <div class="msg-error" id="error-name"><span class="visually-hidden">Error:</span>
                <?= $errors['name'];?></div>
            <?php 
			endif;
			?>
        </div>
        <div class="form-fila">
            <label for="category">Category</label>
            <input type="text" id="category" name="category" class="form-control"
                aria-describedby="help-category <?= isset($errors['category']) ? 'error-category' : null; ?>"
                value="<?= $dataForm['category'] ?? $product->getCategory();?>">
            <?php 
            if(isset($errors['category'])):
            ?>
            <div class="msg-error" id="error-category"><span class="visually-hidden">Error:</span>
                <?= $errors['category'];?></div>
            <?php 
            endif;
            ?>
        </div>

        <div class="form-fila">
            <label for="type">Family</label>
            <input type="text" id="type" name="type" class="form-control"
                aria-describedby="help-type <?= isset($errors['type']) ? 'error-type' : null; ?>"
                value="<?= $dataForm['type'] ?? $product->getType();?>">
            <?php 
			if(isset($errors['type'])):
			?>
            <div class="msg-error" id="error-type"><span class="visually-hidden">Error:</span>
                <?= $errors['type'];?></div>
            <?php 
			endif;
			?>
        </div>

        <div class="form-fila">
            <label for="description">Description</label>
            <textarea id="description" name="description" class="form-control"
                <?php if(isset($errors['description'])):?> aria-describedby="error-description"
                <?php endif;?>><?= $dataForm['description'] ?? $product->getDescription();?></textarea>
            <?php 
			if(isset($errors['description'])):
			?>
            <div class="msg-error" id="error-description"><span class="visually-hidden">Error:</span>
                <?= $errors['description'];?></div>
            <?php 
			endif;
			?>
        </div>

        </div>

        <div class="form-fila">
            <label for="price">Product Price</label>
            <input type="text" id="price" name="price" class="form-control"
                aria-describedby="help-price <?= isset($errors['price']) ? 'error-price' : null; ?>"
                value="<?= $dataForm['price'] ?? $product->getPrice();?>">
            <?php 
			if(isset($errors['price'])):
			?>
            <div class="msg-error" id="error-price"><span class="visually-hidden">Error:</span>
                <?= $errors['price'];?></div>
            <?php 
			endif;
			?>
        </div>
        <div class="form-fila">
            <p>Current Image</p>
            <img src="<?= '../imgs/' . $product->getImg();?>" alt="<?= $product->getImgDesc();?>" class="w-25">
        </div>
        <div class="form-fila">
            <label for="img">Image <span class="text-small">(optional)</span></label>
            <input type="file" id="img" name="img" class="form-control" aria-describedby="help-imagen">
            <div class="form-help" id="help-imagen">If you want to change the image.</div>
        </div>
        <div class="form-fila">
            <label for="img_desc">Image Description <span class="text-small">(optional)</span></label>
            <input type="text" id="img_desc" name="img_desc" class="form-control"
                value="<?= $dataForm['img_desc'] ?? $product->getImgDesc();?>">
        </div>
        <button type="submit" class="button">Update</button>
    </form>
</section>