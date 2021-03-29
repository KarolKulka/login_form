<div class="container">
    <header class="row">
        <div class="col-auto mx-auto">
            <h1 class="main-header">Welcome!</h1>
            <p class="sub-header">To see more please log in</p>
        </div>
    </header>
    <?php if (!empty($validationErrors)) { ?>
        <div class="border border-danger pt-3 pb-2 mb-5 validation-errors">
            <ul class="fa-ul">
                <?php foreach ( $validationErrors as $error ) { ?>
                    <li class="text-danger"><span class="fa-li"><i class="fas fa-exclamation-circle"></i></span><?= esc($error) ?></li>
                <?php } ?>
            </ul>
        </div>
    <?php } ?>
    <?= form_open(route_to('home.login'), ['id' => 'login_form']) ?>
    <div class="row">
        <div class="col-12 col-md-6 col-xl-3 offset-xl-3">
            <div class="form-group">
                <label for="username">Username</label>
                <input name="username" type="text" class="form-control" id="username" placeholder="Username" >
            </div>
        </div>
        <div class="col-12 col-md-6 col-xl-3">
            <div class="form-group">
                <label for="password">Password</label>
                <input name="password" type="password" class="form-control" id="password" placeholder="Password" >
            </div>
        </div>
        <div class="col-12 col-md-6 offset-md-3 col-xl-4 offset-xl-4 text-center">
            <button type="submit" class="btn btn-success">Log in</button>
        </div>

    </div>
    <?= form_close() ?>

</div>