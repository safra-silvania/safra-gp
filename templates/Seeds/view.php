<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Seed $seed
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
                        <td class="col-lg-9"><?= $this->Number->format($seed->id) ?></td>
                    </tr>
                    <tr>
                        <th class="col-lg-3"><?= __('Seed Note') ?></th>
                        <td class="col-lg-9 <?=$seed->seed_note->class?>"><?= $seed->seed_note->name ?></td>
                    </tr>
                    <tr>
                        <th class="col-lg-3"><?= __('Culture') ?></th>
                        <td class="col-lg-9"><?= $seed->has('culture') ? ($userAuthenticated->can('view', $seed->culture) ? $this->Html->link($seed->culture->name, ['controller' => 'Cultures', 'action' => 'view', $seed->culture->id]) : $seed->culture->name) : '' ?></td>
                    </tr>
                    <tr>
                        <th class="col-lg-3"><?= __('Variety') ?></th>
                        <td class="col-lg-9"><?= $seed->has('variety') ? ($userAuthenticated->can('view', $seed->variety) ? $this->Html->link($seed->variety->name, ['controller' => 'Varieties', 'action' => 'view', $seed->variety->id]) : $seed->variety->name) : '' ?></td>
                    </tr>
                    <tr>
                        <th class="col-lg-3"><?= __('Technology') ?></th>
                        <td class="col-lg-9"><?= $seed->has('technology') ? ($userAuthenticated->can('view', $seed->technology) ? $this->Html->link($seed->technology->name, ['controller' => 'Technologies', 'action' => 'view', $seed->technology->id]) : $seed->technology->name) : '' ?></td>
                    </tr>
                    <tr>
                        <th class="col-lg-3"><?= __('Cycle') ?></th>
                        <td class="col-lg-9"><?= $this->Number->format($seed->cycle_days).' - '.$seed->cycle->name ?></td>
                    </tr>
                    <tr>
                        <th class="col-lg-3"><?= __('Zoning Region') ?></th>
                        <td class="col-lg-9"><?= $seed->has('zoning_region') ? ($userAuthenticated->can('view', $seed->zoning_region) ? $this->Html->link($seed->zoning_region->name, ['controller' => 'ZoningRegions', 'action' => 'view', $seed->zoning_region->id]) : $seed->zoning_region->name) : '' ?></td>
                    </tr>
                    <tr>
                        <th class="col-lg-3"><?= __('Productive Potencial') ?></th>
                        <td class="col-lg-9"><?= $seed->has('productive_potencial') ? ($userAuthenticated->can('view', $seed->productive_potencial) ? $this->Html->link($seed->productive_potencial->name, ['controller' => 'ProductivePotencials', 'action' => 'view', $seed->productive_potencial->id]) : $seed->productive_potencial->name) : '' ?></td>
                    </tr>
                    <tr>
                        <th class="col-lg-3"><?= __('Resistency') ?></th>
                        <td class="col-lg-9"><?= h($seed->resistency) ?></td>
                    </tr>
                    <tr>
                        <th class="col-lg-3"><?= __('Population') ?></th>
                        <td class="col-lg-9"><?= h($seed->population) ?></td>
                    </tr>
                    <tr>
                        <th class="col-lg-3"><?= __('City') ?></th>
                        <td class="col-lg-9"><?= $seed->has('city') ? ($userAuthenticated->can('view', $seed->city) ? $this->Html->link($seed->city->name, ['controller' => 'Cities', 'action' => 'view', $seed->city->id]) : $seed->city->name) : '' ?></td>
                    </tr>
                    <tr>
                        <th class="col-lg-3"><?= __('Supplier') ?></th>
                        <td class="col-lg-9"><?= $seed->has('supplier') ? ($userAuthenticated->can('view', $seed->supplier) ? $this->Html->link($seed->supplier->name, ['controller' => 'Suppliers', 'action' => 'view', $seed->supplier->id]) : $seed->supplier->name) : '' ?></td>
                    </tr>
                    <tr>
                        <th class="col-lg-3"><?= __('Maturation Group') ?></th>
                        <td class="col-lg-9"><?= $this->Number->format($seed->maturation_group) ?></td>
                    </tr>
                    <tr>
                        <th class="col-lg-3"><?= __('Created') ?></th>
                        <td class="col-lg-9"><?= h($seed->created) ?></td>
                    </tr>
                    <tr>
                        <th class="col-lg-3"><?= __('Modified') ?></th>
                        <td class="col-lg-9"><?= h($seed->modified) ?></td>
                    </tr>
                </tbody>
            </table>
            <div class="text">
                <strong><?= __('Observations') ?></strong>
                <blockquote>
                    <?= $this->Text->autoParagraph(h($seed->observations)); ?>
                </blockquote>
            </div>
        </div>
    </section>
</div>

<div class="col-lg-12">
    <section class="panel panel-collapsed">
        <header class="panel-heading">
            <div class="panel-actions">
                <a href="#" id="view-audit-log" class="panel-action panel-action-toggle" data-panel-toggle="" data-target-url="<?= Cake\Routing\Router::url(["controller"=>"AuditLogs","action"=>"get-timeline-data", $seed->id, 'seeds']); ?>"></a>
            </div>

            <h2 class="panel-title">Histórico de Alterações</h2>
        </header>
        <div id="audit-timeline" class="panel-body loading-overlay-showing" style="display: none; min-height: 150px;" data-loading-overlay="" data-loading-overlay-options="{ &quot;startShowing&quot;: true }">
        </div>
    </section>
</div>