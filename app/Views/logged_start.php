<?php
use App\Entities\UserEntity;

/** @var UserEntity $user */
?>
<div class="container">
    <header class="row">
        <div class="col-auto mx-auto">
            <h1 class="main-header">Welcome <?= $user->getUsername() ?>!</h1>
            <p class="sub-header">You're logged in! Now you can log out below :)</p>
        </div>
    </header>
    <div class="row">
        <div class="col-12 text-center">
            <a href="<?= route_to('home.logout') ?>" class="btn btn-success">Log out</a>
        </div>
    </div>
</div>