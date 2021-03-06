<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\AuditLog $auditLog
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
                        <th class="col-lg-3"><?= __('Transaction') ?></th>
                        <td class="col-lg-9"><?= h($auditLog->transaction) ?></td>
                    </tr>
                    <tr>
                        <th class="col-lg-3"><?= __('Type') ?></th>
                        <td class="col-lg-9"><?= h($auditLog->type) ?></td>
                    </tr>
                    <tr>
                        <th class="col-lg-3"><?= __('Source') ?></th>
                        <td class="col-lg-9"><?= h($auditLog->source) ?></td>
                    </tr>
                    <tr>
                        <th class="col-lg-3"><?= __('Parent Source') ?></th>
                        <td class="col-lg-9"><?= h($auditLog->parent_source) ?></td>
                    </tr>
                    <tr>
                        <th class="col-lg-3"><?= __('Id') ?></th>
                        <td class="col-lg-9"><?= $this->Number->format($auditLog->id) ?></td>
                    </tr>
                    <tr>
                        <th class="col-lg-3"><?= __('Primary Key') ?></th>
                        <td class="col-lg-9"><?= $this->Number->format($auditLog->primary_key) ?></td>
                    </tr>
                    <tr>
                        <th class="col-lg-3"><?= __('Created') ?></th>
                        <td class="col-lg-9"><?= h($auditLog->created) ?></td>
                    </tr>
                </tbody>
            </table>
            <div class="text">
                <strong><?= __('Original') ?></strong>
                <blockquote>
                    <?= $this->Text->autoParagraph(h($auditLog->original)); ?>
                </blockquote>
            </div>
            <div class="text">
                <strong><?= __('Changed') ?></strong>
                <blockquote>
                    <?= $this->Text->autoParagraph(h($auditLog->changed)); ?>
                </blockquote>
            </div>
            <div class="text">
                <strong><?= __('Meta') ?></strong>
                <blockquote>
                    <?= $this->Text->autoParagraph(h($auditLog->meta)); ?>
                </blockquote>
            </div>
        </div>
    </section>
</div>

<div class="col-lg-12">
    <section class="panel panel-collapsed">
        <header class="panel-heading">
            <div class="panel-actions">
                <a href="#" id="view-audit-log" class="panel-action panel-action-toggle" data-panel-toggle="" data-target-url="<?= Cake\Routing\Router::url(["controller"=>"AuditLogs","action"=>"get-timeline-data", $auditLog->id, 'auditLogs']); ?>"></a>
            </div>

            <h2 class="panel-title">Hist??rico de Altera????es</h2>
        </header>
        <div id="audit-timeline" class="panel-body loading-overlay-showing" style="display: none; min-height: 150px;" data-loading-overlay="" data-loading-overlay-options="{ &quot;startShowing&quot;: true }">
        </div>
    </section>
</div>