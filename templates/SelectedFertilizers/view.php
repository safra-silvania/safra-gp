<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\SelectedFertilizer $selectedFertilizer
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
                        <th class="col-lg-3"><?= __('Fertilizer') ?></th>
                        <td class="col-lg-9"><?= $selectedFertilizer->has('fertilizer') ? ($userAuthenticated->can('view', $selectedFertilizer->fertilizer) ? $this->Html->link($selectedFertilizer->fertilizer->name, ['controller' => 'Fertilizers', 'action' => 'view', $selectedFertilizer->fertilizer->id]) : $selectedFertilizer->fertilizer->name) : '' ?></td>
                    </tr>
                    <tr>
                        <th class="col-lg-3"><?= __('Plan') ?></th>
                        <td class="col-lg-9"><?= $selectedFertilizer->has('plan') ? ($userAuthenticated->can('view', $selectedFertilizer->plan) ? $this->Html->link($selectedFertilizer->plan->id, ['controller' => 'Plans', 'action' => 'view', $selectedFertilizer->plan->id]) : $selectedFertilizer->plan->id) : '' ?></td>
                    </tr>
                    <tr>
                        <th class="col-lg-3"><?= __('Id') ?></th>
                        <td class="col-lg-9"><?= $this->Number->format($selectedFertilizer->id) ?></td>
                    </tr>
                    <tr>
                        <th class="col-lg-3"><?= __('Created') ?></th>
                        <td class="col-lg-9"><?= h($selectedFertilizer->created) ?></td>
                    </tr>
                    <tr>
                        <th class="col-lg-3"><?= __('Modified') ?></th>
                        <td class="col-lg-9"><?= h($selectedFertilizer->modified) ?></td>
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
                <a href="#" id="view-audit-log" class="panel-action panel-action-toggle" data-panel-toggle="" data-target-url="<?= Cake\Routing\Router::url(["controller"=>"AuditLogs","action"=>"get-timeline-data", $selectedFertilizer->id, 'selectedFertilizers']); ?>"></a>
            </div>

            <h2 class="panel-title">Histórico de Alterações</h2>
        </header>
        <div id="audit-timeline" class="panel-body loading-overlay-showing" style="display: none; min-height: 150px;" data-loading-overlay="" data-loading-overlay-options="{ &quot;startShowing&quot;: true }">
        </div>
    </section>
</div>