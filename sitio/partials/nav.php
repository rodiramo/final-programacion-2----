<!-- nav -->
<?php 

use Classes\Auth\Auth;


// Autenticación.
$auth = new Auth;
$requireAuth = $route[$page]['requireAuth'] ?? false;
if(
    $requireAuth &&
    !$auth->authenticated()
) {
    $_SESSION['msgError'] = "You must sign in to access this";
    header("Location: index.php?s=login");
    exit;
}

?>
<nav id="main-nav">
  <div class="hamburger">
    <div class="line1"></div>
    <div class="line2"></div>
    <div class="line3"></div>
  </div>
  <div class="container-fixed flex-nav">
    <ul class="nav-links">
      <li><a href="index.php?s=home">Home</a></li>
      <li><a href="index.php?s=products">Products</a></li>
      <li><a href="index.php?s=contact">Contact</a></li>
      
      <li class="dropdown">
       <a class="dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown"
           aria-expanded="false">
           <i class='bx bx-user'></i>
       </a>
       <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
       <?php if(!$auth->authenticated()):
                ?>
       
          <li><a href="index.php?s=login"><i class='bx bx-log-in' ></i>Log In</a></li>
          <li><a href="index.php?s=register">Register</a></li>
              <?php 
              else:
              ?><li><a href="index.php?s=cart">My Cart</a></li>
          <li><a href="index.php?s=profile"><i class='bx bx-user-circle'></i>My Profile</a></li>
          <li>
              <form action="actions/logout.php" method="post">
                  <button type="submit" class="button"><i class='bx bx-log-out'></i> Log Out(<?= $auth->getUser()->getEmail();?>)</button>
              </form>
          </li>
              <?php 
              endif;
              ?>
          </ul>
        </li>
         
    </ul>
  </div>
</nav>
