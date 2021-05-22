<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Field $field
 */
?>

<div class="col-lg-12">
    <section class="panel">
        <header class="panel-heading">
            <div class="panel-actions pull-right">
                <?php
                echo $this->Html->link(
                    '<button type="button" class="btn btn-default mr-sm"><i class="fa fa-arrow-left mr-xs"></i>Voltar</button>',
                    ['action' => 'index', $immobile->id],
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
                        <th class="col-lg-3"><?= __('Immobile') ?></th>
                        <td class="col-lg-9"><?= $field->has('immobile') ? ($userAuthenticated->can('view', $field->immobile) ? $this->Html->link($field->immobile->name, ['controller' => 'Immobiles', 'action' => 'view', $field->immobile->id]) : $field->immobile->name) : '' ?></td>
                    </tr>
                    <tr>
                        <th class="col-lg-3"><?= __('Name') ?></th>
                        <td class="col-lg-9"><?= h($field->name) ?></td>
                    </tr>
                    <tr>
                        <th class="col-lg-3"><?= __('Measure Unit') ?></th>
                        <td class="col-lg-9"><?= $field->has('measure_unit') ? ($userAuthenticated->can('view', $field->measure_unit) ? $this->Html->link($field->measure_unit->name, ['controller' => 'MeasureUnits', 'action' => 'view', $field->measure_unit->id]) : $field->measure_unit->name) : '' ?></td>
                    </tr>
                    <tr>
                        <th class="col-lg-3"><?= __('Cultivation System') ?></th>
                        <td class="col-lg-9"><?= $field->has('cultivation_system') ? ($userAuthenticated->can('view', $field->cultivation_system) ? $this->Html->link($field->cultivation_system->name, ['controller' => 'CultivationSystems', 'action' => 'view', $field->cultivation_system->id]) : $field->cultivation_system->name) : '' ?></td>
                    </tr>
                    <tr>
                        <th class="col-lg-3"><?= __('Fertility') ?></th>
                        <td class="col-lg-9"><?= $field->has('fertility') ? ($userAuthenticated->can('view', $field->fertility) ? $this->Html->link($field->fertility->name, ['controller' => 'Fertilities', 'action' => 'view', $field->fertility->id]) : $field->fertility->name) : '' ?></td>
                    </tr>
                    <tr>
                        <th class="col-lg-3"><?= __('City') ?></th>
                        <td class="col-lg-9"><?= $field->has('city') ? ($userAuthenticated->can('view', $field->city) ? $this->Html->link($field->city->name, ['controller' => 'Cities', 'action' => 'view', $field->city->id]) : $field->city->name) : '' ?></td>
                    </tr>
                    <tr>
                        <th class="col-lg-3"><?= __('Id') ?></th>
                        <td class="col-lg-9"><?= $this->Number->format($field->id) ?></td>
                    </tr>
                    <tr>
                        <th class="col-lg-3"><?= __('Total Area') ?></th>
                        <td class="col-lg-9"><?= $this->Number->format($field->total_area) ?></td>
                    </tr>
                    <tr>
                        <th class="col-lg-3"><?= __('Created') ?></th>
                        <td class="col-lg-9"><?= h($field->created) ?></td>
                    </tr>
                    <tr>
                        <th class="col-lg-3"><?= __('Modified') ?></th>
                        <td class="col-lg-9"><?= h($field->modified) ?></td>
                    </tr>
                </tbody>
            </table>
            <div class="text">
                <strong><?= __('Observations') ?></strong>
                <blockquote>
                    <?= $this->Text->autoParagraph(h($field->observations)); ?>
                </blockquote>
            </div>
        </div>
    </section>
</div>

<div class="col-lg-12">
    <section class="panel panel-collapsed">
        <header class="panel-heading">
            <div class="panel-actions">
                <a href="#" id="view-audit-log" class="panel-action panel-action-toggle" data-panel-toggle="" data-target-url="<?= Cake\Routing\Router::url(["controller"=>"AuditLogs","action"=>"get-timeline-data", $field->id, 'fields']); ?>"></a>
            </div>

            <h2 class="panel-title">Histórico de Alterações</h2>
        </header>
        <div id="audit-timeline" class="panel-body loading-overlay-showing" style="display: none; min-height: 150px;" data-loading-overlay="" data-loading-overlay-options="{ &quot;startShowing&quot;: true }">
        </div>
    </section>
</div>