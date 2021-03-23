<?php
use App\Entities\UserEntity;

/** @var UserEntity $user */
?>
<div class="container">
    <div class="row ">
        <div class="col-12 ">
            <h1 class="text-center">Welcome <?= $user->getUsername() ?>!</h1>
            <p class="text-center">You're logged in! Now you can log out below :)</p>
        </div>
    </div>
    <div class="row">
        <div class="col-12 text-center">
            <a href="<?= route_to('home.logout') ?>" class="btn btn-success">Log out</a>
        </div>
    </div>
</div>