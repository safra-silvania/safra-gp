<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Fertilizer[]|\Cake\Collection\CollectionInterface $fertilizers
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
                            <th><?= $this->Paginator->sort('name', __('Name')) ?></th>
                            <th><?= $this->Paginator->sort('supplier_id', __('Supplier_id')) ?></th>
                            <th><?= $this->Paginator->sort('formula', __('Formula')) ?></th>
                            <th><?= $this->Paginator->sort('increment', __('Increment')) ?></th>
                            <th><?= $this->Paginator->sort('fertilizer_measure_unit_id', __('Fertilizer_measure_unit_id')) ?></th>
                            <th><?= $this->Paginator->sort('created', __('Created')) ?></th>
                            <th><?= $this->Paginator->sort('modified', __('Modified')) ?></th>
                            <th class="actions">&nbsp;</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($fertilizers as $fertilizer): ?>
                            <tr>
                                <td><?= $this->Number->format($fertilizer->id) ?></td>
                                <td><?= h($fertilizer->name) ?></td>
                                <td><?= $fertilizer->has('supplier') ? ($userAuthenticated->can('view', $fertilizer->supplier) ? $this->Html->link($fertilizer->supplier->name, ['controller' => 'Suppliers', 'action' => 'view', $fertilizer->supplier->id]) : $fertilizer->supplier->name) : '' ?></td>
                                <td><?= h($fertilizer->formula) ?></td>
                                <td><?= h($fertilizer->increment) ?></td>
                                <td><?= $fertilizer->has('fertilizer_measure_unit') ? ($userAuthenticated->can('view', $fertilizer->fertilizer_measure_unit) ? $this->Html->link($fertilizer->fertilizer_measure_unit->name, ['controller' => 'FertilizerMeasureUnits', 'action' => 'view', $fertilizer->fertilizer_measure_unit->id]) : $fertilizer->fertilizer_measure_unit->name) : '' ?></td>
                                <td><?= h($fertilizer->created) ?></td>
                                <td><?= h($fertilizer->modified) ?></td>
                                <td class="actions">
                                    <?php
                                    if ($userAuthenticated && $userAuthenticated->can('view', $fertilizer)) {
                                        echo $this->Html->link(
                                            '<button type="button" class="mr-xs mb-xs btn btn-xs btn-info"><i class="fa fa-search"></i></button>',
                                            ['action' => 'view', $fertilizer->id],
                                            ['escape' => false, 'title' => 'Visualizar']
                                        );
                                    }

                                    if ($userAuthenticated && $userAuthenticated->can('update', $fertilizer)) {
                                        echo $this->Html->link(
                                            '<button type="button" class="mr-xs mb-xs btn btn-xs btn-warning"><i class="fa fa-pencil"></i></button>',
                                            ['action' => 'edit', $fertilizer->id],
                                            ['escape' => false, 'title' => 'Editar']
                                        );
                                    }
                                        
                                    if ($userAuthenticated && $userAuthenticated->can('delete', $fertilizer)) {
                                        echo $this->Form->postLink(
                                            '<button type="button" class="mr-xs mb-xs btn btn-xs btn-danger"><i class="fa fa-trash-o"></i></button>',
                                            ['action' => 'delete', $fertilizer->id],
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
