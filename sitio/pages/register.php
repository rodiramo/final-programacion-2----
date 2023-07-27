<div class="container">
    <h1 class="mb-1">Register</h1>
  
    <form action="actions/register.php" method="POST">
    <div class="form-fila">
            <label for="name">Name</label>
            <input type="name" id="name" name="name" class="form-control">
        </div>
        <div class="form-fila">
            <label for="surname">Last Name</label>
            <input type="surname" id="surname" name="surname" class="form-control">
        </div>
        <div class="form-fila">
            <label for="email">Email</label>
            <input type="email" id="email" name="email" class="form-control">
        </div>
        <div class="form-fila">
            <label for="password">Password</label>
            <input type="password" id="password" name="password" class="form-control">
        </div>
        <button type="submit" class="button">Create Account</button>
    </form>
</div>