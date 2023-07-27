<?php 

$errors = $_SESSION['errors'] ?? [];
$dataForm = $_SESSION['data-form'] ?? [];
unset($_SESSION['errors'], $_SESSION['data-form']); 
?>
<section class="container">
    <h1 class="mb-1">Log In to your Account!</h1>

    <form action="actions/login.php" method="post" class="mb-1">
        <div class="form-fila">
            <label for="email">Email</label>
            <input
                type="email"
                id="email"
                name="email"
                class="form-control"
                value="<?= $dataForm['email'] ?? null;?>"
            >
        </div>
        <div class="form-fila">
            <label for="password">Password</label>
            <input type="password" id="password" name="password" class="form-control">
        </div>
        <button type="submit" class="button">Log In</button>
    </form>

    <p>Did you forget your password? You can <a href="index.php?s=reset-password">reset your password here</a>.</p>
</section>