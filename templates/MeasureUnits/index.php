<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\MeasureUnit[]|\Cake\Collection\CollectionInterface $measureUnits
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
                            <th><?= $this->Paginator->sort('initial', __('Initial')) ?></th>
                            <th><?= $this->Paginator->sort('created', __('Created')) ?></th>
                            <th><?= $this->Paginator->sort('modified', __('Modified')) ?></th>
                            <th class="actions">&nbsp;</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($measureUnits as $measureUnit): ?>
                            <tr>
                                <td><?= $this->Number->format($measureUnit->id) ?></td>
                                <td><?= h($measureUnit->name) ?></td>
                                <td><?= h($measureUnit->initial) ?></td>
                                <td><?= h($measureUnit->created) ?></td>
                                <td><?= h($measureUnit->modified) ?></td>
                                <td class="actions">
                                    <?php
                                    if ($userAuthenticated && $userAuthenticated->can('view', $measureUnit)) {
                                        echo $this->Html->link(
                                            '<button type="button" class="mr-xs mb-xs btn btn-xs btn-info"><i class="fa fa-search"></i></button>',
                                            ['action' => 'view', $measureUnit->id],
                                            ['escape' => false, 'title' => 'Visualizar']
                                        );
                                    }

                                    if ($userAuthenticated && $userAuthenticated->can('update', $measureUnit)) {
                                        echo $this->Html->link(
                                            '<button type="button" class="mr-xs mb-xs btn btn-xs btn-warning"><i class="fa fa-pencil"></i></button>',
                                            ['action' => 'edit', $measureUnit->id],
                                            ['escape' => false, 'title' => 'Editar']
                                        );
                                    }
                                        
                                    if ($userAuthenticated && $userAuthenticated->can('delete', $measureUnit)) {
                                        echo $this->Form->postLink(
                                            '<button type="button" class="mr-xs mb-xs btn btn-xs btn-danger"><i class="fa fa-trash-o"></i></button>',
                                            ['action' => 'delete', $measureUnit->id],
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
