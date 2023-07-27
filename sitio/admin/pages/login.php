<?php 

unset($_SESSION['errors'], $_SESSION['data-form']); 
?>
<section class="container">
    <h1 class="mb-1">Enter de Admin Panel!</h1>

    <p class="mb-1">Complete with your info to access the panel.</p>

    <form action="actions/login.php" method="post">
        <div class="form-fila">
            <label for="email">Email</label>
            <input type="email" id="email" name="email" class="form-control" value="<?= $dataForm['email'] ?? null;?>">
        </div>
        <div class="form-fila">
            <label for="password">Password</label>
            <input type="password" id="password" name="password" class="form-control">
        </div>
        <button type="submit" class="button">Enter</button>
    </form>
</section>