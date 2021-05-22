<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\FieldDetail $fieldDetail
 */
?>

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
            <h2 class="panel-title">Visualizar</h2>
        </header>

        <div class="panel-body">
            <table class="table table-hover">
                <tbody>
                    <tr>
                        <th class="col-lg-3"><?= __('Field') ?></th>
                        <td class="col-lg-9"><?= $fieldDetail->has('field') ? ($userAuthenticated->can('view', $fieldDetail->field) ? $this->Html->link($fieldDetail->field->name, ['controller' => 'Fields', 'action' => 'view', $fieldDetail->field->id]) : $fieldDetail->field->name) : '' ?></td>
                    </tr>
                    <tr>
                        <th class="col-lg-3"><?= __('Culture') ?></th>
                        <td class="col-lg-9"><?= $fieldDetail->has('culture') ? ($userAuthenticated->can('view', $fieldDetail->culture) ? $this->Html->link($fieldDetail->culture->name, ['controller' => 'Cultures', 'action' => 'view', $fieldDetail->culture->id]) : $fieldDetail->culture->name) : '' ?></td>
                    </tr>
                    <tr>
                        <th class="col-lg-3"><?= __('Fertility') ?></th>
                        <td class="col-lg-9"><?= $fieldDetail->has('fertility') ? ($userAuthenticated->can('view', $fieldDetail->fertility) ? $this->Html->link($fieldDetail->fertility->name, ['controller' => 'Fertilities', 'action' => 'view', $fieldDetail->fertility->id]) : $fieldDetail->fertility->name) : '' ?></td>
                    </tr>
                    <tr>
                        <th class="col-lg-3"><?= __('Measure Unit') ?></th>
                        <td class="col-lg-9"><?= $fieldDetail->has('measure_unit') ? ($userAuthenticated->can('view', $fieldDetail->measure_unit) ? $this->Html->link($fieldDetail->measure_unit->name, ['controller' => 'MeasureUnits', 'action' => 'view', $fieldDetail->measure_unit->id]) : $fieldDetail->measure_unit->name) : '' ?></td>
                    </tr>
                    <tr>
                        <th class="col-lg-3"><?= __('Id') ?></th>
                        <td class="col-lg-9"><?= $this->Number->format($fieldDetail->id) ?></td>
                    </tr>
                    <tr>
                        <th class="col-lg-3"><?= __('Area') ?></th>
                        <td class="col-lg-9"><?= $this->Number->format($fieldDetail->area) ?></td>
                    </tr>
                    <tr>
                        <th class="col-lg-3"><?= __('Created') ?></th>
                        <td class="col-lg-9"><?= h($fieldDetail->created) ?></td>
                    </tr>
                    <tr>
                        <th class="col-lg-3"><?= __('Modified') ?></th>
                        <td class="col-lg-9"><?= h($fieldDetail->modified) ?></td>
                    </tr>
                </tbody>
            </table>
            <div class="text">
                <strong><?= __('Observations') ?></strong>
                <blockquote>
                    <?= $this->Text->autoParagraph(h($fieldDetail->observations)); ?>
                </blockquote>
            </div>
        </div>
    </section>
</div>

<div class="col-lg-12">
    <section class="panel panel-collapsed">
        <header class="panel-heading">
            <div class="panel-actions">
                <a href="#" id="view-audit-log" class="panel-action panel-action-toggle" data-panel-toggle="" data-target-url="<?= Cake\Routing\Router::url(["controller"=>"AuditLogs","action"=>"get-timeline-data", $fieldDetail->id, 'fieldDetails']); ?>"></a>
            </div>

            <h2 class="panel-title">Histórico de Alterações</h2>
        </header>
        <div id="audit-timeline" class="panel-body loading-overlay-showing" style="display: none; min-height: 150px;" data-loading-overlay="" data-loading-overlay-options="{ &quot;startShowing&quot;: true }">
        </div>
    </section>
</div>