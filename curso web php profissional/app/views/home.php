<h2>Users</h2>


<ul>
    <?php foreach($users as $user):?>
    <li> <?php echo $user -> firstName;?> | <a href="/user/<?php echo $user ->ID;?>">Detalhes</a></li>
    <?php endforeach; ?>
</ul>