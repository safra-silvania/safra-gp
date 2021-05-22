<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Cycle $cycle
 */

use App\Model\Enum;
?>

<?php $this->Form->setTemplates(['inputContainer' => '<div class="col-md-6 col-sm-8 col-xs-12 {{required}}">{{content}} </div>','inputContainerError' => '<div class="col-md-6 col-sm-4 col-xs-12 text-danger {{required}}">{{content}} <strong>{{error}}</strong> </div>']);?>

<?= $this->Form->create($cycle, ['class' => 'form-horizontal form-bordered']) ?>

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
            <div class="form-group">
                <?php
                $start = $cycle['start'];
                $end = $cycle['end'];
                $max = Enum\CyclesEnum::Max;
                ?>
                <label class="col-md-3 col-sm-4 col-xs-12 control-label required-label" for="periodo">Período</label>
                <div class="col-md-6 col-sm-8 col-xs-12">
                    <div id="periodo"></div>
                    <?= $this->Form->hidden('start', ['value' => $start]) ?>
                    <?= $this->Form->hidden('end', ['value' => $end]) ?>
                    <p>&nbsp;</p>
                </div>
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
    (function() {
        var slider = document.getElementById('periodo');

        noUiSlider.create(slider, {
            start: [<?=$start?>, <?=$end?>],
            connect: true,
            tooltips: true,
            step: 1,
            pips: {
                mode: 'range',
                density: 5
            },
            range: {
                'min': 0,
                'max': <?=$max?>
            },
            format: wNumb({
                decimals: 0
            }),
        });

        slider.noUiSlider.on("update", function(values) {
            var start = values[0];
            var end = values[1];

            $(".panel-body input[name='start']").val(start);
            $(".panel-body input[name='end']").val(end);
        });
    })();
</script>