<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Seed $seed
 */

use App\Model\Enum;
?>

<?php $this->Form->setTemplates(['inputContainer' => '<div class="col-md-6 col-sm-8 col-xs-12 {{required}}">{{content}} </div>','inputContainerError' => '<div class="col-md-6 col-sm-4 col-xs-12 text-danger {{required}}">{{content}} <strong>{{error}}</strong> </div>']);?>

<?= $this->Form->create($seed, ['class' => 'form-horizontal form-bordered']) ?>

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
                <label class="col-md-3 col-sm-4 col-xs-12 control-label required-label" for="seed_note_id"><?= __('Seed_note_id') ?></label>
                <?= $this->Form->control('seed_note_id', ['options' => $seedNotes, 'class' => 'form-control', 'label' => false]) ?>
            </div>
            <div class="form-group">
                <label class="col-md-3 col-sm-4 col-xs-12 control-label required-label" for="culture_id"><?= __('Culture_id') ?></label>
                <?= $this->Form->control('culture_id', ['options' => $cultures, 'class' => 'form-control', 'label' => false]) ?>
            </div>
            <div class="form-group">
                <label class="col-md-3 col-sm-4 col-xs-12 control-label required-label" for="variety_id"><?= __('Variety_id') ?></label>
                <?= $this->Form->control('variety_id', ['options' => $varieties, 'class' => 'form-control', 'label' => false]) ?>
            </div>
            <div class="form-group">
                <label class="col-md-3 col-sm-4 col-xs-12 control-label required-label" for="technology_id"><?= __('Technology_id') ?></label>
                <?= $this->Form->control('technology_id', ['options' => $technologies, 'class' => 'form-control', 'label' => false]) ?>
            </div>
            <div class="form-group">
                <label class="col-md-3 col-sm-4 col-xs-12 control-label required-label" for="maturation_group"><?= __('Maturation_group') ?></label>
                <?= $this->Form->control('maturation_group', ['class' => 'form-control decimal', 'type'=>'text', 'label' => false]) ?>
            </div>
            
            <div class="form-group">
                <?php
                $start = $seed['cycle_days'];
                $max = Enum\CyclesEnum::Max;
                ?>
                <label class="col-md-3 col-sm-4 col-xs-12 control-label required-label" for="periodo">Período</label>
                <div class="col-md-6 col-sm-8 col-xs-12">
                    <div id="periodo"></div>
                    <?= $this->Form->hidden('cycle_days', ['value' => $start, 'id' => 'cycle_days']) ?>
                    <p>&nbsp;</p>
                </div>
            </div>

            <?php
            foreach ($cycles as $cycle):
                echo $this->Form->hidden('hd-cycles', ['value'=>$cycle->id, 'data-name'=>$cycle->name, 'start'=>$cycle->start, 'end'=>$cycle->end]);
            endforeach;

            echo $this->Form->hidden('cycle_id', ['value'=>$seed->cycle->id, 'id'=>'cycle_id']);
            ?>

            <div class="form-group">
                <label class="col-md-3 col-sm-4 col-xs-12 control-label required-label" for="zoning_region_id"><?= __('Zoning_region_id') ?></label>
                <?= $this->Form->control('zoning_region_id', ['options' => $zoningRegions, 'class' => 'form-control', 'label' => false]) ?>
            </div>
            <div class="form-group">
                <label class="col-md-3 col-sm-4 col-xs-12 control-label" for="productive_potencial_id"><?= __('Productive_potencial_id') ?></label>
                <?= $this->Form->control('productive_potencial_id', ['options' => $productivePotencials, 'empty' => true, 'class' => 'form-control', 'label' => false]) ?>
            </div>
            <div class="form-group">
                <label class="col-md-3 col-sm-4 col-xs-12 control-label" for="resistency"><?= __('Resistency') ?></label>
                <?= $this->Form->control('resistency', ['class' => 'form-control', 'label' => false]) ?>
            </div>
            <div class="form-group">
                <label class="col-md-3 col-sm-4 col-xs-12 control-label" for="population"><?= __('Population') ?></label>
                <?= $this->Form->control('population', ['class' => 'form-control', 'label' => false]) ?>
            </div>
            <div class="form-group">
                <label class="col-md-3 col-sm-4 col-xs-12 control-label" for="city_id"><?= __('City_id') ?></label>
                <?= $this->Form->control('city_id', ['options' => $cities, 'empty' => true, 'class' => 'form-control', 'label' => false]) ?>
            </div>
            <div class="form-group">
                <label class="col-md-3 col-sm-4 col-xs-12 control-label" for="supplier_id"><?= __('Supplier_id') ?></label>
                <?= $this->Form->control('supplier_id', ['options' => $suppliers, 'empty' => true, 'class' => 'form-control', 'label' => false]) ?>
            </div>
            <div class="form-group">
                <label class="col-md-3 col-sm-4 col-xs-12 control-label" for="observations"><?= __('Observations') ?></label>
                <?= $this->Form->control('observations', ['class' => 'form-control', 'label' => false]) ?>
            </div>
            <div class="form-group">
                <label class="col-md-3 col-sm-4 col-xs-12 control-label" for="fertilities"><?= __('Fertilities') ?></label>
                <?= $this->Form->control('fertilities._ids', ['options' => $fertilities, 'class' => 'form-control', 'label' => false]) ?>
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

<?= $this->Html->script("/bundle/seeds_form.bundle.js") ?>