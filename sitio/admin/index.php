<?php

use Classes\Auth\Auth;

require __DIR__ . '/../bootstrap/init.php';



$rutas = [
    '404' => [
       'title' => 'Error page not found',
    ],
    'home' => [
        'title' => 'Home',
        'requireAuth' => true
    ],
    'product' => [
        'title' => 'Administrate the Products',
        'requireAuth' => true
    ],
    'product-publish' => [
        'title' => 'Publish a Product',
        'requireAuth' => true
    ],
    'product-edit' => [
        'title' => 'Edit product',
        'requireAuth' => true
     ],
     'users' => [
         'title' => 'Administrate the Users',
        'requireAuth' => true
      ],
    'product-delete' => [
        'title' => 'Delete Product',
        'requireAuth' => true
    ],    
    'product-nonexistent' => [
        'title' => 'Product doesnt Exist',
        'requireAuth' => true
    ],
    'login' => [
        'title' => 'Login'
    ],
    'purchases' => [
        'title' => 'Purchases'
    ]
];

$page = $_GET['s'] ?? 'home';
/* page - 404 */
if(!file_exists('pages/' . $page . '.php')) {
    $page = '404';
}
if(!isset($rutas[$page])) {
    $page = '404';
}


// Auth
$auth = new Auth;
$requireAuth = $rutas[$page]['requireAuth'] ?? false;
if(
    $requireAuth &&
    !$auth->admin()
) {
    
    $_SESSION['msgError'] = "To view this content, you must be signed in as an Admin";
    header("Location: index.php?s=login");
    exit;
}


$msgFeedback = $_SESSION['msgFeedback'] ?? null;
$msgError = $_SESSION['msgError'] ?? null;

unset($_SESSION['msgFeedback'], $_SESSION['msgError']);


?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- icono -->
    <link rel="icon" href="../assets/imgs/orchid.png">
    <!-- title -->
    <title> Blomma - <?= $rutas[$page]['title']; ?></title>
    <!--BOOTSTRAP-->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <!--ANIMATE.CSS-->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css">
    <!-- Boxicons CSS -->
    <link href="https://unpkg.com/boxicons@2.1.1/css/boxicons.min.css" rel="stylesheet">
    <!-- CSS -->
    <link rel="stylesheet" href="../css/estilos.css">
    <link rel="stylesheet" href="../assets/fonts/stylesheet.css">
</head>

<body>
    <!-- header  -->
    <header>
        <div class="px-3 py-2  text-white">
            <div class="container">
                <div class=" d-flex align-items-center justify-content-center ">
                    <a href="index.php?s=home" class="text-white">
                        <span>Blomma.</span>
                    </a>
                </div>
            </div>
        </div>
    </header>
    <!-- nav -->
    <nav id="main-nav">
        <div class="hamburger">
            <div class="line1"></div>
            <div class="line2"></div>
            <div class="line3"></div>
        </div>
        <div class="container-fixed flex-nav">
            <?php 
            if($auth->admin()):
            ?>
            <ul class="nav-links">
                <li><a href="index.php?s=home">Home</a></li>
                <li><a href="index.php?s=product">Products</a></li>
                <li><a href="index.php?s=users">Users</a></li>
                <li class="dropdown">
                    <a class="dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown"
                        aria-expanded="false">
                        <i class='bx bx-user'></i>
                    </a>
                    <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                        <li>
                            <form action="actions/logout.php" method="post"><button type="submit" class="dropdown"><i
                                        class='bx bx-exit'></i>Log Out
                                    <?= $auth->getUser()->getEmail();?></button>
                        </form>
                        </li>
                    </ul>
                </li>
            </ul>

            <?php 
            endif;
            ?>
        </div>
    </nav>

    <main class="main-content">
        <?php
        if($msgFeedback !== null):
            ?>
        <div class="msg-success text-center"><?= $msgFeedback; ?></div>
        <?php 
            endif; 
            ?>
        <?php 
        if($msgError !== null):
        ?>
        <div class="msg-error"><?= $msgError; ?></div>
        <?php 
        endif; 
        ?>
        <?php
            
            require __DIR__ . '/pages/' . $page . '.php';

            ?>

    </main>
    <!-- footer-->
        <footer class="d-flex flex-wrap justify-content-between align-items-center py-3 border-top">
            <p class="col-md-4 mb-0 text-white">&copy;The website was made by Rocio Diaz Ramos and Tomas Ramirez Cordero, who are students of Web Design and Web Development at Escuela Davinci, this project is for the final is for the subject of Programming 2, which is taught  by the teacher: Santiago Gallino.</p>

            <a href="index.php?s=home"
                class="col-md-4 d-flex align-items-center justify-content-center mb-3 mb-md-0 me-md-auto text-decoration-none">
                <span>Blomma.</span>
            </a>

            <ul class="nav col-md-4 justify-content-end">
                <li><a href="../index.php?s=home" class="p-2">Home</a></li>
                <li><a href="../index.php?s=products" class="p-2">Products</a></li>
                <li><a href="../index.php?s=contact" class="p-2">Contact</a></li>
            </ul>
        </footer>
  

    <!--mine js -->
    <script src="../js/main.js"></script>
    <!-- iconos js -->
    <script src="https://unpkg.com/boxicons@2.1.2/dist/boxicons.js"></script>
    <!-- Bootstrap js-->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js">
    </script>


</body>

</html>