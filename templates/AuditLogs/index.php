<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\AuditLog[]|\Cake\Collection\CollectionInterface $auditLogs
 */
?>

<div class="col-lg-12">
    <section class="panel">
        <header class="panel-heading">
            <div class="panel-actions pull-right">
                <?php
                if ($canCreate) {
                    echo $this->Html->link(
                        '<button type="button" class="btn btn-default mr-sm"><i class="fa fa-plus mr-xs"></i>Incluir</button>',
                        ['action' => 'add'],
                        ['escape' => false, 'title' => 'Incluir']
                    );
                }
                ?>

                <a href="#" class="panel-action panel-action-toggle" data-panel-toggle=""></a>
            </div>

            <h2 class="panel-title">Listagem</h2>
        </header>

        <div class="panel-body">
            <div class="table-responsive">
                <table class="table mb-none">
                    <thead>
                        <tr>
                            <th><?= $this->Paginator->sort('id', __('Id')) ?></th>
                            <th><?= $this->Paginator->sort('transaction', __('Transaction')) ?></th>
                            <th><?= $this->Paginator->sort('type', __('Type')) ?></th>
                            <th><?= $this->Paginator->sort('primary_key', __('Primary_key')) ?></th>
                            <th><?= $this->Paginator->sort('source', __('Source')) ?></th>
                            <th><?= $this->Paginator->sort('parent_source', __('Parent_source')) ?></th>
                            <th><?= $this->Paginator->sort('original', __('Original')) ?></th>
                            <th><?= $this->Paginator->sort('changed', __('Changed')) ?></th>
                            <th><?= $this->Paginator->sort('meta', __('Meta')) ?></th>
                            <th><?= $this->Paginator->sort('created', __('Created')) ?></th>
                            <th class="actions">&nbsp;</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($auditLogs as $auditLog): ?>
                            <tr>
                                <td><?= $this->Number->format($auditLog->id) ?></td>
                                <td><?= h($auditLog->transaction) ?></td>
                                <td><?= h($auditLog->type) ?></td>
                                <td><?= $this->Number->format($auditLog->primary_key) ?></td>
                                <td><?= h($auditLog->source) ?></td>
                                <td><?= h($auditLog->parent_source) ?></td>
                                <td><?= h($auditLog->original) ?></td>
                                <td><?= h($auditLog->changed) ?></td>
                                <td><?= h($auditLog->meta) ?></td>
                                <td><?= h($auditLog->created) ?></td>
                                <td class="actions">
                                    <?php
                                    if ($userAuthenticated && $userAuthenticated->can('view', $auditLog)) {
                                        echo $this->Html->link(
                                            '<button type="button" class="mr-xs mb-xs btn btn-xs btn-info"><i class="fa fa-search"></i></button>',
                                            ['action' => 'view', $auditLog->id],
                                            ['escape' => false, 'title' => 'Visualizar']
                                        );
                                    }

                                    if ($userAuthenticated && $userAuthenticated->can('update', $auditLog)) {
                                        echo $this->Html->link(
                                            '<button type="button" class="mr-xs mb-xs btn btn-xs btn-warning"><i class="fa fa-pencil"></i></button>',
                                            ['action' => 'edit', $auditLog->id],
                                            ['escape' => false, 'title' => 'Editar']
                                        );
                                    }
                                        
                                    if ($userAuthenticated && $userAuthenticated->can('delete', $auditLog)) {
                                        echo $this->Form->postLink(
                                            '<button type="button" class="mr-xs mb-xs btn btn-xs btn-danger"><i class="fa fa-trash-o"></i></button>',
                                            ['action' => 'delete', $auditLog->id],
                                            ['escape' => false, 'title' => 'Excluir', 'confirm' => 'Confirma a exclusão deste registro?']
                                        );
                                    }
                                    ?>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>

            <div class="paginator">
                <ul class="pagination">
                    <?= $this->Paginator->first('<< Primeira') ?>
                    <?= $this->Paginator->prev('< Anterior') ?>
                    <?= $this->Paginator->numbers() ?>
                    <?= $this->Paginator->next('Próxima >') ?>
                    <?= $this->Paginator->last('Última >>') ?>
                </ul>
                <p><?= $this->Paginator->counter('Página {{page}} de {{pages}}, exibindo {{current}} registro(s) de {{count}}') ?></p>
            </div>
        </div>
    </section>
</div>
