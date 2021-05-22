<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Supplier $supplier
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
                        <td class="col-lg-9"><?= h($supplier->name) ?></td>
                    </tr>
                    <tr>
                        <th class="col-lg-3"><?= __('Resale') ?></th>
                        <td class="col-lg-9"><?= h($supplier->resale) ?></td>
                    </tr>
                    <tr>
                        <th class="col-lg-3"><?= __('City') ?></th>
                        <td class="col-lg-9"><?= $supplier->has('city') ? ($userAuthenticated->can('view', $supplier->city) ? $this->Html->link($supplier->city->name, ['controller' => 'Cities', 'action' => 'view', $supplier->city->id]) : $supplier->city->name) : '' ?></td>
                    </tr>
                    <tr>
                        <th class="col-lg-3"><?= __('Representative') ?></th>
                        <td class="col-lg-9"><?= h($supplier->representative) ?></td>
                    </tr>
                    <tr>
                        <th class="col-lg-3"><?= __('Representative Phone') ?></th>
                        <td class="col-lg-9"><?= h($supplier->representative_phone) ?></td>
                    </tr>
                    <tr>
                        <th class="col-lg-3"><?= __('Resale Phone') ?></th>
                        <td class="col-lg-9"><?= h($supplier->resale_phone) ?></td>
                    </tr>
                    <tr>
                        <th class="col-lg-3"><?= __('Id') ?></th>
                        <td class="col-lg-9"><?= $this->Number->format($supplier->id) ?></td>
                    </tr>
                    <tr>
                        <th class="col-lg-3"><?= __('Created') ?></th>
                        <td class="col-lg-9"><?= h($supplier->created) ?></td>
                    </tr>
                    <tr>
                        <th class="col-lg-3"><?= __('Modified') ?></th>
                        <td class="col-lg-9"><?= h($supplier->modified) ?></td>
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
                <a href="#" id="view-audit-log" class="panel-action panel-action-toggle" data-panel-toggle="" data-target-url="<?= Cake\Routing\Router::url(["controller"=>"AuditLogs","action"=>"get-timeline-data", $supplier->id, 'suppliers']); ?>"></a>
            </div>

            <h2 class="panel-title">Histórico de Alterações</h2>
        </header>
        <div id="audit-timeline" class="panel-body loading-overlay-showing" style="display: none; min-height: 150px;" data-loading-overlay="" data-loading-overlay-options="{ &quot;startShowing&quot;: true }">
        </div>
    </section>
</div>