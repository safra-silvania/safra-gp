<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Fertilizer $fertilizer
 */
?>

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
            <h2 class="panel-title">Visualizar</h2>
        </header>

        <div class="panel-body">
            <table class="table table-hover">
                <tbody>
                    <tr>
                        <th class="col-lg-3"><?= __('Name') ?></th>
                        <td class="col-lg-9"><?= h($fertilizer->name) ?></td>
                    </tr>
                    <tr>
                        <th class="col-lg-3"><?= __('Supplier') ?></th>
                        <td class="col-lg-9"><?= $fertilizer->has('supplier') ? ($userAuthenticated->can('view', $fertilizer->supplier) ? $this->Html->link($fertilizer->supplier->name, ['controller' => 'Suppliers', 'action' => 'view', $fertilizer->supplier->id]) : $fertilizer->supplier->name) : '' ?></td>
                    </tr>
                    <tr>
                        <th class="col-lg-3"><?= __('Formula') ?></th>
                        <td class="col-lg-9"><?= h($fertilizer->formula) ?></td>
                    </tr>
                    <tr>
                        <th class="col-lg-3"><?= __('Increment') ?></th>
                        <td class="col-lg-9"><?= h($fertilizer->increment) ?></td>
                    </tr>
                    <tr>
                        <th class="col-lg-3"><?= __('Fertilizer Measure Unit') ?></th>
                        <td class="col-lg-9"><?= $fertilizer->has('fertilizer_measure_unit') ? ($userAuthenticated->can('view', $fertilizer->fertilizer_measure_unit) ? $this->Html->link($fertilizer->fertilizer_measure_unit->name, ['controller' => 'FertilizerMeasureUnits', 'action' => 'view', $fertilizer->fertilizer_measure_unit->id]) : $fertilizer->fertilizer_measure_unit->name) : '' ?></td>
                    </tr>
                    <tr>
                        <th class="col-lg-3"><?= __('Id') ?></th>
                        <td class="col-lg-9"><?= $this->Number->format($fertilizer->id) ?></td>
                    </tr>
                    <tr>
                        <th class="col-lg-3"><?= __('Created') ?></th>
                        <td class="col-lg-9"><?= h($fertilizer->created) ?></td>
                    </tr>
                    <tr>
                        <th class="col-lg-3"><?= __('Modified') ?></th>
                        <td class="col-lg-9"><?= h($fertilizer->modified) ?></td>
                    </tr>
                </tbody>
            </table>
        </div>
    </section>
</div>

<div class="col-lg-12">
    <section class="panel panel-collapsed">
        <header class="panel-heading">
            <div class="panel-actions">
                <a href="#" id="view-audit-log" class="panel-action panel-action-toggle" data-panel-toggle="" data-target-url="<?= Cake\Routing\Router::url(["controller"=>"AuditLogs","action"=>"get-timeline-data", $fertilizer->id, 'fertilizers']); ?>"></a>
            </div>

            <h2 class="panel-title">Hist??rico de Altera????es</h2>
        </header>
        <div id="audit-timeline" class="panel-body loading-overlay-showing" style="display: none; min-height: 150px;" data-loading-overlay="" data-loading-overlay-options="{ &quot;startShowing&quot;: true }">
        </div>
    </section>
</div>