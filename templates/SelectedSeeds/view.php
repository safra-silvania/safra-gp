<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\SelectedSeed $selectedSeed
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
                        <th class="col-lg-3"><?= __('Seed') ?></th>
                        <td class="col-lg-9"><?= $selectedSeed->has('seed') ? ($userAuthenticated->can('view', $selectedSeed->seed) ? $this->Html->link($selectedSeed->seed->id, ['controller' => 'Seeds', 'action' => 'view', $selectedSeed->seed->id]) : $selectedSeed->seed->id) : '' ?></td>
                    </tr>
                    <tr>
                        <th class="col-lg-3"><?= __('Plan') ?></th>
                        <td class="col-lg-9"><?= $selectedSeed->has('plan') ? ($userAuthenticated->can('view', $selectedSeed->plan) ? $this->Html->link($selectedSeed->plan->id, ['controller' => 'Plans', 'action' => 'view', $selectedSeed->plan->id]) : $selectedSeed->plan->id) : '' ?></td>
                    </tr>
                    <tr>
                        <th class="col-lg-3"><?= __('Id') ?></th>
                        <td class="col-lg-9"><?= $this->Number->format($selectedSeed->id) ?></td>
                    </tr>
                    <tr>
                        <th class="col-lg-3"><?= __('Created') ?></th>
                        <td class="col-lg-9"><?= h($selectedSeed->created) ?></td>
                    </tr>
                    <tr>
                        <th class="col-lg-3"><?= __('Modified') ?></th>
                        <td class="col-lg-9"><?= h($selectedSeed->modified) ?></td>
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
                <a href="#" id="view-audit-log" class="panel-action panel-action-toggle" data-panel-toggle="" data-target-url="<?= Cake\Routing\Router::url(["controller"=>"AuditLogs","action"=>"get-timeline-data", $selectedSeed->id, 'selectedSeeds']); ?>"></a>
            </div>

            <h2 class="panel-title">Hist??rico de Altera????es</h2>
        </header>
        <div id="audit-timeline" class="panel-body loading-overlay-showing" style="display: none; min-height: 150px;" data-loading-overlay="" data-loading-overlay-options="{ &quot;startShowing&quot;: true }">
        </div>
    </section>
</div>