<!doctype html>
<html lang="en">
<head>

    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&display=swap" rel="stylesheet">
    <?php foreach ( service('assets')->getPaths('css') as  $path) { ?>
        <?= '<link rel="preload" href="'.config('Assets')->getWebBase().$path.'" as="style">' ?>
    <?php } ?>

    <?php foreach ( service('assets')->getPaths('js') as  $path) { ?>
        <?= '<link rel="preload" href="'.config('Assets')->getWebBase().$path.'" as="script">' ?>
    <?php } ?>

    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <?= service('assets')->css() ?>

    <title>Logowanie</title>

    <script type="text/javascript">
        var baseUrl = '<?= site_url(); ?>';
    </script>
</head>
<body>
<div class="body-background">
    <img class="body-background-image" src="<?= site_url('assets/images/bckg_grass.jpg') ?>" alt="grass background image">
</div>
<div class="main-container">
