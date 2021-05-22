<?php $this->Form->setTemplates(['inputContainer' => '<div class="col-md-6 col-sm-8 col-xs-12 {{required}}">{{content}} </div>','inputContainerError' => '<div class="col-md-6 col-sm-4 col-xs-12 text-danger {{required}}">{{content}} <strong>{{error}}</strong> </div>']);?>

<?= $this->Form->create(null, ['class' => 'form-horizontal form-bordered']) ?>

<div class="col-lg-12">
    <section class="panel">
        <header class="panel-heading">
            <div class="panel-actions">
                <a href="#" class="panel-action panel-action-toggle" data-panel-toggle=""></a>
            </div>
            <h2 class="panel-title">Email Test</h2>
        </header>

        <div class="panel-body">

            <div class="form-group">
                <label class="col-md-3 col-sm-4 col-xs-12 control-label required-label" for="email"><?= __('E-mail') ?></label>
                <?= $this->Form->control('email', ['class' => 'form-control', 'label' => false, 'value' => 'delfino.cesar@gmail.com']) ?>
            </div>
        </div>

        <footer class="panel-footer">
            <div class="row">
                <div class="col-lg-12 text-center">
                    <?= $this->Form->button('Enviar', ['class' => 'btn btn-primary']) ?>
                </div>
            </div>
        </footer>
    </section>
</div>

<?= $this->Form->end() ?>