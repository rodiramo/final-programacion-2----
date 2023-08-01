<?php

use Classes\Models\Product;
require_once __DIR__ . '/bootstrap/init.php';

$routes = [
  '404' => [
    'title' => 'Page not found :(',
  ],
  'home' => [
    'title' => 'Home',
  ],
  'products' => [
    'title' => 'Our Products',
  ],
  'product-view' => [
    'title' => 'Product',
  ],
  'contact' => [
    'title' => 'Contact Us!',
  ],
  'contact-post' => [
    'title' => 'Welcome back!',
  ],
  'login' => [
    'title' => 'Login',
  ],
  'cart' => [
    'title' => 'Cart',
   'requireAuth' => true,
  ],
   'register' => [
    'title' => 'Register',
  ],
  'reset-password' => [
    'title' => 'Request New Password',
  ], 
  'new-password' => [
    'title' => 'Set New Password',
  ],
  'profile' => [
    'title' => 'Your Profile',
    'requireAuth' => true,
  ],

];


$page = $_GET['s'] ?? 'home';

if (!file_exists("pages/" . $page . ".php")) {
  $page = '404';
}

if (!isset($routes[$page])) {

  $page = '404';
}

if ($page === 'product-view') {

  require_once __DIR__ . '/assets/libraries/products.php';
  $product = (new Product)-> viewById($_GET['id']);
  $routes[$page]['title'] = $product->getTitle();
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
    <link rel="icon" href="assets/imgs/orchid.png">
    <!-- title -->
    <title> Blomma - <?= $routes[$page]['title']; ?></title>
    <!--BOOTSTRAP-->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <!--ANIMATE.CSS-->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css">
    <!-- Boxicons CSS -->
    <link href="https://unpkg.com/boxicons@2.1.1/css/boxicons.min.css" rel="stylesheet">
    <!-- CSS -->
    <link rel="stylesheet" href="css/estilos.css">
    <link rel="stylesheet" href="assets/fonts/stylesheet.css">
</head>


<body>
    <?php
          // require headers and nav
          require 'partials/header.php';
          require 'partials/nav.php';
      ?>
    <!-- main content -->
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
              $filename = __DIR__ . '/pages/' . $page . '.php';
              if (file_exists($filename)) {
                require $filename;
              } else {
                require __DIR__ . '/pages/404.php';
              }
            
       ?>
    </main>

    <?php
        require 'partials/footer.php';
  ?>