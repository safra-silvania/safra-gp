<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\PlanFieldDetail $planFieldDetail
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
                        <th class="col-lg-3"><?= __('Field Detail') ?></th>
                        <td class="col-lg-9"><?= $planFieldDetail->has('field_detail') ? ($userAuthenticated->can('view', $planFieldDetail->field_detail) ? $this->Html->link($planFieldDetail->field_detail->id, ['controller' => 'FieldDetails', 'action' => 'view', $planFieldDetail->field_detail->id]) : $planFieldDetail->field_detail->id) : '' ?></td>
                    </tr>
                    <tr>
                        <th class="col-lg-3"><?= __('Plan') ?></th>
                        <td class="col-lg-9"><?= $planFieldDetail->has('plan') ? ($userAuthenticated->can('view', $planFieldDetail->plan) ? $this->Html->link($planFieldDetail->plan->id, ['controller' => 'Plans', 'action' => 'view', $planFieldDetail->plan->id]) : $planFieldDetail->plan->id) : '' ?></td>
                    </tr>
                    <tr>
                        <th class="col-lg-3"><?= __('Selected Seed') ?></th>
                        <td class="col-lg-9"><?= $planFieldDetail->has('selected_seed') ? ($userAuthenticated->can('view', $planFieldDetail->selected_seed) ? $this->Html->link($planFieldDetail->selected_seed->id, ['controller' => 'SelectedSeeds', 'action' => 'view', $planFieldDetail->selected_seed->id]) : $planFieldDetail->selected_seed->id) : '' ?></td>
                    </tr>
                    <tr>
                        <th class="col-lg-3"><?= __('Id') ?></th>
                        <td class="col-lg-9"><?= $this->Number->format($planFieldDetail->id) ?></td>
                    </tr>
                    <tr>
                        <th class="col-lg-3"><?= __('Sequence') ?></th>
                        <td class="col-lg-9"><?= $this->Number->format($planFieldDetail->sequence) ?></td>
                    </tr>
                    <tr>
                        <th class="col-lg-3"><?= __('Created') ?></th>
                        <td class="col-lg-9"><?= h($planFieldDetail->created) ?></td>
                    </tr>
                    <tr>
                        <th class="col-lg-3"><?= __('Modified') ?></th>
                        <td class="col-lg-9"><?= h($planFieldDetail->modified) ?></td>
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
                <a href="#" id="view-audit-log" class="panel-action panel-action-toggle" data-panel-toggle="" data-target-url="<?= Cake\Routing\Router::url(["controller"=>"AuditLogs","action"=>"get-timeline-data", $planFieldDetail->id, 'planFieldDetails']); ?>"></a>
            </div>

            <h2 class="panel-title">Histórico de Alterações</h2>
        </header>
        <div id="audit-timeline" class="panel-body loading-overlay-showing" style="display: none; min-height: 150px;" data-loading-overlay="" data-loading-overlay-options="{ &quot;startShowing&quot;: true }">
        </div>
    </section>
</div>