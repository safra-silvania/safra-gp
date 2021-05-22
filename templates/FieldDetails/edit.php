<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\FieldDetail $fieldDetail
 */
?>

<?php $this->Form->setTemplates(['inputContainer' => '<div class="col-md-6 col-sm-8 col-xs-12 {{required}}">{{content}} </div>','inputContainerError' => '<div class="col-md-6 col-sm-4 col-xs-12 text-danger {{required}}">{{content}} <strong>{{error}}</strong> </div>']);?>

<?= $this->Form->create($fieldDetail, ['class' => 'form-horizontal form-bordered']) ?>

<div class="col-lg-12">
    <section class="panel">
        <header class="panel-heading">
            <div class="panel-actions pull-right">
                <?php
                echo $this->Html->link(
                    '<button type="button" class="btn btn-default mr-sm"><i class="fa fa-arrow-left mr-xs"></i>Voltar</button>',
                    ['action' => 'index', $field->id],
                    ['escape' => false, 'title' => 'Voltar']
                );
                ?>

                <a href="#" class="panel-action panel-action-toggle" data-panel-toggle=""></a>
            </div>
            <h2 class="panel-title">Editar</h2>
        </header>

        <div class="panel-body">

            <?= $this->Form->hidden('field_id', ['value' => $field->id]) ?>
            
            <div class="form-group">
                <label class="col-md-3 col-sm-4 col-xs-12 control-label required-label" for="culture_id"><?= __('Culture_id') ?></label>
                <?= $this->Form->control('culture_id', ['options' => $cultures, 'class' => 'form-control', 'label' => false]) ?>
            </div>
            <div class="form-group">
                <label class="col-md-3 col-sm-4 col-xs-12 control-label required-label" for="fertility_id"><?= __('Fertility_id') ?></label>
                <?= $this->Form->control('fertility_id', ['options' => $fertilities, 'class' => 'form-control', 'label' => false]) ?>
            </div>
            <div class="form-group">
                <label class="col-md-3 col-sm-4 col-xs-12 control-label required-label" for="area"><?= __('Area') ?></label>
                <?= $this->Form->control('area', ['class' => 'form-control decimal', 'type'=>'text', 'label' => false]) ?>
            </div>
            <div class="form-group">
                <label class="col-md-3 col-sm-4 col-xs-12 control-label required-label" for="measure_unit_id"><?= __('Measure_unit_id') ?></label>
                <?= $this->Form->control('measure_unit_id', ['options' => $measureUnits, 'class' => 'form-control', 'label' => false]) ?>
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
                        ['action' => 'index', $field->id],
                        ['escape' => false, 'title' => 'Cancelar']
                    );
                    ?>
                </div>
            </div>
        </footer>
    </section>
</div>

<?= $this->Form->end() ?>