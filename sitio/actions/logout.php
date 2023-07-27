<?php
use Classes\Auth\Auth;
require_once __DIR__ . '/../bootstrap/init.php';

(new Auth)->logout();

$_SESSION['msgFeedback'] = "You Logged Out";


header("Location: ../index.php?s=login");
exit;