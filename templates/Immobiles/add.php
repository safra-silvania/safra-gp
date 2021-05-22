<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Immobile $immobile
 */
?>

<?php $this->Form->setTemplates(['inputContainer' => '<div class="col-md-6 col-sm-8 col-xs-12 {{required}}">{{content}} </div>','inputContainerError' => '<div class="col-md-6 col-sm-4 col-xs-12 text-danger {{required}}">{{content}} <strong>{{error}}</strong> </div>']);?>

<?= $this->Form->create($immobile, ['class' => 'form-horizontal form-bordered']) ?>

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
            <h2 class="panel-title">Incluir</h2>
        </header>

        <div class="panel-body">
            <div class="form-group">
                <label class="col-md-3 col-sm-4 col-xs-12 control-label required-label" for="producer_id"><?= __('Producer_id') ?></label>
                <?= $this->Form->control('producer_id', ['options' => $producers, 'class' => 'form-control', 'label' => false]) ?>
            </div>
            <div class="form-group">
                <label class="col-md-3 col-sm-4 col-xs-12 control-label required-label" for="name"><?= __('Name') ?></label>
                <?= $this->Form->control('name', ['class' => 'form-control', 'label' => false]) ?>
            </div>
            <div class="form-group">
                <label class="col-md-3 col-sm-4 col-xs-12 control-label required-label" for="harvest"><?= __('Harvest') ?></label>
                <?= $this->Form->control('harvest', ['class' => 'form-control', 'label' => false]) ?>
            </div>
            <div class="form-group">
                <label class="col-md-3 col-sm-4 col-xs-12 control-label required-label" for="city_id"><?= __('City_id') ?></label>
                <?= $this->Form->control('city_id', ['options' => $cities, 'class' => 'form-control', 'label' => false]) ?>
            </div>
            <div class="form-group">
                <label class="col-md-3 col-sm-4 col-xs-12 control-label" for="observations"><?= __('Observations') ?></label>
                <?= $this->Form->control('observations', ['class' => 'form-control', 'label' => false]) ?>
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