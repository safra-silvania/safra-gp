<?php
$description = 'Safra Consultoria';
?>
<!DOCTYPE html>
<html>
<head>
    <?= $this->Html->charset() ?>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>
        <?= $description ?>:
        Login
    </title>
    <?= $this->Html->meta('icon') ?>

    <link href="https://fonts.googleapis.com/css?family=Raleway:400,700" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/normalize.css@8.0.1/normalize.css">

    <!--
    <?= $this->Html->css('milligram.min.css') ?>
    <?= $this->Html->css('cake.css') ?>
    -->
    
    <!-- Mobile Metas -->
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />

    <!-- Web Fonts  -->
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700,800|Shadows+Into+Light" rel="stylesheet" type="text/css">

    <!-- Vendor CSS -->
    <?= $this->Html->css('/assets/vendor/bootstrap/css/bootstrap.css') ?>
    <?= $this->Html->css('/assets/vendor/font-awesome/css/font-awesome.css') ?>

    <!-- Theme CSS -->
    <?= $this->Html->css('/assets/stylesheets/theme.css') ?>

    <!-- Skin CSS -->
    <?= $this->Html->css('/assets/stylesheets/skins/default.css') ?>

    <!-- Theme Custom CSS -->
    <?= $this->Html->css('/assets/stylesheets/theme-custom.css') ?>

    <?= $this->fetch('meta') ?>
    <?= $this->fetch('css') ?>
    <?= $this->fetch('script') ?>
</head>
<body>

    <main class="main">
        <div class="container">
            <?= $this->Flash->render() ?>
            <?= $this->fetch('content') ?>
        </div>
    </main>
    
    <footer>
    </footer>
    
</body>
</html>
