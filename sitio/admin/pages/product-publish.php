<?php 
// Definimos las variables "flasheadas" que se necesitan.
$errors = $_SESSION['errors'] ?? [];
$dataForm = $_SESSION['data-form'] ?? [];
unset($_SESSION['errors'], $_SESSION['data-form']);

?>

<section class="container">
    <h1 class="mb-1">Publish a New Plant</h1>
    <p class="mb-1">Complete de fields of the form, when you are done and ready, just press "Publish".
    </p>

    <form action="actions/product-create.php" method="post" enctype="multipart/form-data">
        <div class="form-fila">
            <label for="name">Name*</label>
            <input type="text" id="name" name="name" class="form-control">
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
            <label for="category">Category*</label>
            <input type="text" id="category" name="category" class="form-control">
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
            <label for="type">Family*</label>
            <input type="text" id="type" name="type" class="form-control">
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
            <label for="description">Description*</label>
            <textarea id="description" name="description" class="form-control"
                <?php if(isset($errors['description'])):?> <?php endif;?>></textarea>
            <?php 
			if(isset($errors['description'])):
			?>
            <div class="msg-error" id="error-description"><span class="visually-hidden">Error:</span>
                <?= $errors['description'];?></div>
            <?php 
			endif;
			?>
        </div>
        <div class="form-fila">
            <label for="price">Product Price*</label>
            <input type="text" id="price" name="price" class="form-control" <?php if(isset($errors['price'])):?>
                <?php endif;?>>
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
            <label for="img">Image</label>
            <input type="file" id="img" name="img" class="form-control">
        </div>

        <div class="form-fila">
            <label for="img_desc">Image Description <span class="text-small">(optional)</span></label>
            <input type="text" id="img_desc" name="img_desc" class="form-control">
        </div>

        <button type="submit" class="button">Publish</button>
    </form>
</section>