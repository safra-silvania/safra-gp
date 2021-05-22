<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\User $user
 */
?>

<?php $this->Form->setTemplates(['inputContainer' => '<div class="col-md-6 col-sm-8 col-xs-12 {{required}}">{{content}} </div>','inputContainerError' => '<div class="col-md-6 col-sm-4 col-xs-12 text-danger {{required}}">{{content}} <strong>{{error}}</strong> </div>']);?>

<?= $this->Form->create($user, ['class' => 'form-horizontal form-bordered']) ?>

<div class="col-lg-12">
    <section class="panel">
        <header class="panel-heading">
            <div class="panel-actions pull-right">
                <?php
                echo $this->Html->link(
                    '<button type="button" class="btn btn-default mr-sm"><i class="fa fa-arrow-left mr-xs"></i>Voltar</button>',
                    ['action' => 'index'],
                    ['escape' => false, 'title' => 'Voltar']
                );
                ?>

                <a href="#" class="panel-action panel-action-toggle" data-panel-toggle=""></a>
            </div>
            <h2 class="panel-title">Editar</h2>
        </header>

        <div class="panel-body">
            <div class="form-group">
                <label class="col-md-3 col-sm-4 col-xs-12 control-label required-label" for="name"><?= __('Name') ?></label>
                <?= $this->Form->control('name', ['class' => 'form-control', 'label' => false]) ?>
            </div>
            <?php if ($canChangeRole): ?>
            <div class="form-group">
                <label class="col-md-3 col-sm-4 col-xs-12 control-label required-label" for="role_id"><?= __('Role_id') ?></label>
                <?= $this->Form->control('role_id', ['options' => $roles, 'class' => 'form-control', 'label' => false]) ?>
            </div>
            <div class="form-group">
                <label class="col-md-3 col-sm-4 col-xs-12 control-label required-label" for="user_status_id"><?= __('User_status_id') ?></label>
                <?= $this->Form->control('user_status_id', ['options' => $userStatuses, 'class' => 'form-control', 'label' => false]) ?>
            </div>
            <?php endif ?>
            <div class="form-group">
                <label class="col-md-3 col-sm-4 col-xs-12 control-label required-label" for="email"><?= __('Email') ?></label>
                <?= $this->Form->control('email', ['class' => 'form-control', 'label' => false]) ?>
            </div>
            <div class="form-group">
                <label class="col-md-3 col-sm-4 col-xs-12 control-label required-label" for="password"><?= __('Password') ?></label>
                <?= $this->Form->control('password', ['empty' => true, 'required' => false, 'value' => '', 'placeholder' => "Deixe em branco para manter a mesma senha", 'class' => 'form-control', 'label' => false, 'autocomplete'=>'off']) ?>
            </div>
            <div class="form-group">
                <label class="col-md-3 col-sm-4 col-xs-12 control-label required-label" for="password"><?= __('Password Confirm') ?></label>
                <?= $this->Form->control('password_confirm', ['empty' => true, 'required' => false, 'value' => '', 'type' => 'password', 'placeholder' => "", 'class' => 'form-control', 'label' => false]) ?>
            </div>
        </div>

        <footer class="panel-footer">
            <div class="row">
                <div class="col-lg-12 text-center">
                    <?= $this->Form->button('Gravar', ['class' => 'btn btn-primary']) ?>

                    <?php
                    echo $this->Html->link(
                        '<button type="button" class="btn btn-default mr-sm">Cancelar</button>',
                        ['action' => 'index'],
                        ['escape' => false, 'title' => 'Cancelar']
                    );
                    ?>
                </div>
            </div>
        </footer>
    </section>
</div>

<?= $this->Form->end() ?>

<script>
$(document).ready(function () {
    setTimeout(() => {
        $("#password").val("");
    }, 500);
});
</script>