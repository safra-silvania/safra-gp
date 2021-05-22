<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Sketch[]|\Cake\Collection\CollectionInterface $sketch
 */
?>

<div class="row">
    <div class="col-md-4 col-lg-3">
        <?php echo $this->cell('FieldCard', [$field->id]);?>
    </div>

    <div class="col-md-8 col-lg-9">
        <section class="panel">
            <header class="panel-heading">
                <div class="panel-actions pull-right">
                    <?php
                    echo $this->Html->link(
                        '<button type="button" class="btn btn-default mr-sm"><i class="fa fa-arrow-left mr-xs"></i>Voltar</button>',
                        ['controller' => 'fields', 'action' => 'index', $field->immobile_id],
                        ['escape' => false, 'title' => 'Voltar']
                    );
                    ?>

                    <a href="#" class="panel-action panel-action-toggle" data-panel-toggle=""></a>
                </div>

                <h2 class="panel-title">
                    <?= $field->name ?>
                    &nbsp;-&nbsp;
                    <?=$this->Number->format($field->total_area)?> <?=$field->measure_unit->initial?>
                </h2>
            </header>

            <div class="panel-body">
                <input type="hidden" id="field_id" name="field_id" value="<?=$field->id?>" />
                <input id="file-upload" name="file-upload" type="file" data-preview-file-type="text" multiple />
            </div>
        </section>
    </div>
</div>

<?= $this->Html->script("/bundle/sketches_index.bundle.js") ?>
