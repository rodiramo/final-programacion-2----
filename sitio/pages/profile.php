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
                <td>
					<a class="text-white button m-20"
                                href="index.php?s=user-purchases&id=<?=$auth->getUser()->getUserId(); ?>"> <i class="bx bx-search"></i></a>
                </td>
            </tr>
        </tbody>
</table>
