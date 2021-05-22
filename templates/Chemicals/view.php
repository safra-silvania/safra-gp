<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Chemical $chemical
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
                        <th class="col-lg-3"><?= __('Id') ?></th>
                        <td class="col-lg-9"><?= $this->Number->format($chemical->id) ?></td>
                    </tr>
                    <tr>
                        <th class="col-lg-3"><?= __('Chemical Note') ?></th>
                        <td class="col-lg-9 note-text <?=$chemical->chemical_note->class?>"><?= $chemical->chemical_note->name ?></td>
                    </tr>
                    <tr>
                        <th class="col-lg-3"><?= __('Name') ?></th>
                        <td class="col-lg-9"><?= h($chemical->name) ?></td>
                    </tr>
                    <tr>
                        <th class="col-lg-3"><?= __('Chemical Class') ?></th>
                        <td class="col-lg-9"><?= $chemical->has('chemical_class') ? ($userAuthenticated->can('view', $chemical->chemical_class) ? $this->Html->link($chemical->chemical_class->name, ['controller' => 'ChemicalClasses', 'action' => 'view', $chemical->chemical_class->id]) : $chemical->chemical_class->name) : '' ?></td>
                    </tr>
                    <tr>
                        <th class="col-lg-3"><?= __('ChemicalGroups') ?></th>
                        <td class="col-lg-9"><?php foreach ($chemical->chemical_groups as $group) echo $group->name . "<br>"; ?></td>
                    </tr>
                    <tr>
                        <th class="col-lg-3"><?= __('Supplier') ?></th>
                        <td class="col-lg-9"><?= $chemical->has('supplier') ? ($userAuthenticated->can('view', $chemical->supplier) ? $this->Html->link($chemical->supplier->name, ['controller' => 'Suppliers', 'action' => 'view', $chemical->supplier->id]) : $chemical->supplier->name) : '' ?></td>
                    </tr>
                    <tr>
                        <th class="col-lg-3"><?= __('Chemical Measure Unit') ?></th>
                        <td class="col-lg-9"><?= $chemical->has('chemical_measure_unit') ? ($userAuthenticated->can('view', $chemical->chemical_measure_unit) ? $this->Html->link($chemical->chemical_measure_unit->name, ['controller' => 'ChemicalMeasureUnits', 'action' => 'view', $chemical->chemical_measure_unit->id]) : $chemical->chemical_measure_unit->name) : '' ?></td>
                    </tr>
                    <tr>
                        <th class="col-lg-3"><?= __('Chemical Target') ?></th>
                        <td class="col-lg-9"><?= $chemical->has('chemical_target') ? ($userAuthenticated->can('view', $chemical->chemical_target) ? $this->Html->link($chemical->chemical_target->name, ['controller' => 'ChemicalTargets', 'action' => 'view', $chemical->chemical_target->id]) : $chemical->chemical_target->name) : '' ?></td>
                    </tr>
                    <tr>
                        <th class="col-lg-3"><?= __('Dose') ?></th>
                        <td class="col-lg-9"><?= $this->Number->format($chemical->dose) ?></td>
                    </tr>
                    <tr>
                        <th class="col-lg-3"><?= __('Created') ?></th>
                        <td class="col-lg-9"><?= h($chemical->created) ?></td>
                    </tr>
                    <tr>
                        <th class="col-lg-3"><?= __('Modified') ?></th>
                        <td class="col-lg-9"><?= h($chemical->modified) ?></td>
                    </tr>
                </tbody>
            </table>
            <div class="text">
                <strong><?= __('Incompatibility') ?></strong>
                <blockquote>
                    <?= $this->Text->autoParagraph(h($chemical->incompatibility)); ?>
                </blockquote>
            </div>
            <div class="text">
                <strong><?= __('Observation') ?></strong>
                <blockquote>
                    <?= $this->Text->autoParagraph(h($chemical->observation)); ?>
                </blockquote>
            </div>
        </div>
    </section>
</div>

<div class="col-lg-12">
    <section class="panel panel-collapsed">
        <header class="panel-heading">
            <div class="panel-actions">
                <a href="#" id="view-audit-log" class="panel-action panel-action-toggle" data-panel-toggle="" data-target-url="<?= Cake\Routing\Router::url(["controller"=>"AuditLogs","action"=>"get-timeline-data", $chemical->id, 'chemicals']); ?>"></a>
            </div>

            <h2 class="panel-title">Histórico de Alterações</h2>
        </header>
        <div id="audit-timeline" class="panel-body loading-overlay-showing" style="display: none; min-height: 150px;" data-loading-overlay="" data-loading-overlay-options="{ &quot;startShowing&quot;: true }">
        </div>
    </section>
</div>