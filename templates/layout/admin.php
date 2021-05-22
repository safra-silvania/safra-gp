<?php
$description = 'Safra Consultoria';
?>
<!DOCTYPE html>
<html class="<?= $collapsedSidebar ? 'fixed sidebar-left-collapsed' : '' ?>">
<head>
    <?= $this->Html->charset() ?>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>
        <?= $description ?> <?php if (!$production) { echo "[TESTE]"; } ?> :
        <?= isset($title) ? $title : __($this->fetch('title')) ?>
    </title>
    <?= $this->Html->meta('icon') ?>

    <link href="https://fonts.googleapis.com/css?family=Raleway:400,700" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/normalize.css@8.0.1/normalize.css">

    <!-- Mobile Metas -->
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />

    <!-- Web Fonts  -->
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700,800|Shadows+Into+Light" rel="stylesheet" type="text/css">

    <?= $this->Html->css("/dist/main.css") ?>
    <?= $this->Html->script("/dist/vendor.js") ?>


    <?= $this->fetch('meta') ?>
    <?= $this->fetch('css') ?>
    <?= $this->fetch('script') ?>
</head>
<body>

<body>
    <section class="body">

        <?= $this->element('header') ?>

        <div class="inner-wrapper">

            <?php if (!$production): ?>
                <div class="div-ambiente-teste">
                    Ambiente de Teste
                </div>
            <?php endif; ?>

            <?= $this->element('sidebar') ?>

            <section role="main" class="content-body">
                <header class="page-header">
                    <h2><?= isset($title) ? $title : __($this->fetch('title')) ?></h2>

                    <div class="right-wrapper pull-right">
                        <ol class="breadcrumbs">
                            <li>
                                <?php
                                echo $this->Html->link(
                                    '<i class="fa fa-home"></i>',
                                    ['controller' => 'dashboard', 'action' => 'index'],
                                    ['escape' => false, 'title' => 'Editar']
                                );
                                ?>
                            </li>
                            <?php
                            if (isset($crumbs) && count($crumbs) > 0):
                                foreach ($crumbs as $crumb):
                                    ?>
                                    <li><span><?=$crumb?></span></li>
                                    <?php
                                endforeach;
                            endif;
                            ?>
                        </ol>

                        <span class="sidebar-right-toggle" style="cursor:default">&nbsp;</span>
                    </div>
                </header>

                <!-- Used by ajax requests -->
                <input type="hidden" id="api-base-url" value="<?= Cake\Routing\Router::url(["controller"=>"/api/v1"]); ?>" />
                <input type="hidden" id="now" value="<?= date('Y-m-d H:i:s'); ?>" />

                <!-- start: page -->
                <div class="row" id="general-content">
                    <?= $this->Flash->render() ?>
                    <?= $this->fetch('content') ?>
                </div>
            </section>
        </div>
    </section>

    <footer>
    </footer>

    <!-- Specific Page Vendor -->
    <?= $this->Html->script("/assets/vendor/jquery-ui/jquery-ui.min.js") ?>

    <!-- Theme Base, Components and Settings -->
    <?= $this->Html->script("/assets/javascripts/theme.js") ?>

    <!-- Static javascript -->
    <?= $this->Html->script("/assets/javascripts/theme.custom.js") ?>

    <!-- Theme Initialization Files -->
    <?= $this->Html->script("/assets/javascripts/theme.init.js") ?>

</body>
</html>
