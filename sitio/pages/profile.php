<?php 
require_once __DIR__ . '/../bootstrap/init.php';

use Classes\Auth\Auth;
$auth = new Auth;
?>



<section>
<h1>My Profile</h1>

<table class="table">
        <thead>
            <tr>
                <th>Name</th>
                <th>Surname</th>
                <th>Email</th>
                <th>My Purchases</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td><?= $auth->getUser()->getName();?></td>
                <td><?= $auth->getUser()->getSurname();?></td>
                <td><?= $auth->getUser()->getEmail();?></td>
            </tr>
        </tbody>
</table>
