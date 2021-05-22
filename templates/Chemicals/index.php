<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Chemical[]|\Cake\Collection\CollectionInterface $chemicals
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
                            <th class="text-center"><?= $this->Paginator->sort('id', __('Id')) ?></th>
                            <th class="text-center"><?= $this->Paginator->sort('chemical_note_id', __('Chemical_note_id')) ?></th>
                            <th class="text-left"><?= $this->Paginator->sort('name', __('Name')) ?></th>
                            <th class="text-left"><?= $this->Paginator->sort('chemical_class_id', __('Chemical_class_id')) ?></th>
                            <th class="text-left"><?= __('ChemicalGroup') ?></th>
                            <th class="text-left"><?= $this->Paginator->sort('supplier_id', __('Supplier_id')) ?></th>
                            <th class="text-center"><?= $this->Paginator->sort('dose', __('Dose')) ?></th>
                            <th class="text-left"><?= $this->Paginator->sort('chemical_target_id', __('Chemical_target_id')) ?></th>
                            <th class="text-left"><?= $this->Paginator->sort('incompatibility', __('Incompatibility')) ?></th>
                            <th class="text-center"><?= $this->Paginator->sort('created', __('Created')) ?></th>
                            <th class="text-center"><?= $this->Paginator->sort('modified', __('Modified')) ?></th>
                            <th class="actions">&nbsp;</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($chemicals as $chemical): 
                            ?>
                            <tr>
                                <td class="text-center"><?= $this->Number->format($chemical->id) ?></td>
                                <td class="text-center note-text <?=$chemical->chemical_note->class?>"><?= $chemical->chemical_note->name ?></td>
                                <td class="text-left"><?= h($chemical->name) ?></td>
                                <td class="text-left"><?= $chemical->has('chemical_class') ? ($userAuthenticated->can('view', $chemical->chemical_class) ? $this->Html->link($chemical->chemical_class->name, ['controller' => 'ChemicalClasses', 'action' => 'view', $chemical->chemical_class->id]) : $chemical->chemical_class->name) : '' ?></td>
                                <td class="text-left"> <?php foreach ($chemical->chemical_groups as $group) echo $group->name . "<br>"; ?> </td>
                                <td class="text-left"><?= $chemical->has('supplier') ? ($userAuthenticated->can('view', $chemical->supplier) ? $this->Html->link($chemical->supplier->name, ['controller' => 'Suppliers', 'action' => 'view', $chemical->supplier->id]) : $chemical->supplier->name) : '' ?></td>
                                <td class="text-center"><?= $this->Number->format($chemical->dose).' '.$chemical->chemical_measure_unit->initial ?></td>
                                <td class="text-left"><?= $chemical->has('chemical_target') ? ($userAuthenticated->can('view', $chemical->chemical_target) ? $this->Html->link($chemical->chemical_target->name, ['controller' => 'ChemicalTargets', 'action' => 'view', $chemical->chemical_target->id]) : $chemical->chemical_target->name) : '' ?></td>
                                <td class="text-left"><?= h($chemical->incompatibility) ?></td>
                                <td class="text-center"><?= h($chemical->created) ?></td>
                                <td class="text-center"><?= h($chemical->modified) ?></td>
                                <td class="actions">
                                    <?php
                                    if ($userAuthenticated && $userAuthenticated->can('view', $chemical)) {
                                        echo $this->Html->link(
                                            '<button type="button" class="mr-xs mb-xs btn btn-xs btn-info"><i class="fa fa-search"></i></button>',
                                            ['action' => 'view', $chemical->id],
                                            ['escape' => false, 'title' => 'Visualizar']
                                        );
                                    }

                                    if ($userAuthenticated && $userAuthenticated->can('update', $chemical)) {
                                        echo $this->Html->link(
                                            '<button type="button" class="mr-xs mb-xs btn btn-xs btn-warning"><i class="fa fa-pencil"></i></button>',
                                            ['action' => 'edit', $chemical->id],
                                            ['escape' => false, 'title' => 'Editar']
                                        );
                                    }
                                        
                                    if ($userAuthenticated && $userAuthenticated->can('delete', $chemical)) {
                                        echo $this->Form->postLink(
                                            '<button type="button" class="mr-xs mb-xs btn btn-xs btn-danger"><i class="fa fa-trash-o"></i></button>',
                                            ['action' => 'delete', $chemical->id],
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
