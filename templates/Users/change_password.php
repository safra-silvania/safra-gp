<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\User $user
 */
?>

<?php $this->Form->setTemplates([
    'inputContainer' => '<div class="col-xs-12 col-md-6 {{required}}">{{content}} </div>',
    'inputContainerError' => '<div class="col-xs-12 col-md-6 text-danger {{required}}">{{content}}<strong>{{error}}</strong> </div>'
    ]); ?>
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
            <h2 class="panel-title">Alterar Senha</h2>
        </header>

        <div class="panel-body">
            <div class="form-group">
                <label class="col-xs-12 col-md-3 control-label required-label" for="name"><?= __('Name') ?></label>
                <div class="col-lg-6">
                    <p class="form-control-static"><strong><?= $user->name ?></strong></p>
                </div>
            </div>
            <div class="form-group">
                <label class="col-xs-12 col-md-3 control-label required-label" for="password"><?= __('Password') ?></label>
                <?= $this->Form->control('password', ['empty' => false, 'required' => true, 'value' => '', 'placeholder' => "Digite a nova senha", 'class' => 'form-control', 'label' => false, 'autocomplete'=>'off']) ?>
            </div>
            <div class="form-group">
                <label class="col-xs-12 col-md-3 control-label required-label" for="password"><?= __('Password Confirm') ?></label>
                <?= $this->Form->control('password_confirm', ['empty' => false, 'required' => true, 'value' => '', 'type' => 'password', 'placeholder' => "", 'class' => 'form-control', 'label' => false]) ?>
            </div>
        </div>

        <footer class="panel-footer">
            <div class="row">
                <div class="col-sm-9 col-sm-offset-3">
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