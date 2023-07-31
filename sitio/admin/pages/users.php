<?php
use Classes\Models\User;
$users = (new User)->todo();
?>
<section class="container">
	<h1 class="mb-1">Administrate Users</h1>

	<table class="table">
		<thead>
			<tr>
				<th>ID</th>
				<th>Email</th>
				<th>Rol</th>
				<th>Purchases</th>
			</tr>
		</thead>
		<tbody>
        <?php 
			foreach($users as $user):
			?>
			<tr>

				<td><?= $user->getUserId();?></td>
				<td><?= $user->getEmail();?></td>
				<td><?= $user->getRolFk();?></td>
				<td>
					<a class="text-white button m-20"
                                href="index.php?s=purchases&id=<?=$user->getUserId(); ?>"> <i class="bx bx-search"></i></a></td>
			</tr>
            <?php 
			endforeach;
			?>
		</tbody>
	</table>
</section>