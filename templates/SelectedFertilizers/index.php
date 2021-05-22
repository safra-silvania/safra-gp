<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\SelectedFertilizer[]|\Cake\Collection\CollectionInterface $selectedFertilizers
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
                            <th><?= $this->Paginator->sort('fertilizer_id', __('Fertilizer_id')) ?></th>
                            <th><?= $this->Paginator->sort('plan_id', __('Plan_id')) ?></th>
                            <th><?= $this->Paginator->sort('created', __('Created')) ?></th>
                            <th><?= $this->Paginator->sort('modified', __('Modified')) ?></th>
                            <th class="actions">&nbsp;</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($selectedFertilizers as $selectedFertilizer): ?>
                            <tr>
                                <td><?= $this->Number->format($selectedFertilizer->id) ?></td>
                                <td><?= $selectedFertilizer->has('fertilizer') ? ($userAuthenticated->can('view', $selectedFertilizer->fertilizer) ? $this->Html->link($selectedFertilizer->fertilizer->name, ['controller' => 'Fertilizers', 'action' => 'view', $selectedFertilizer->fertilizer->id]) : $selectedFertilizer->fertilizer->name) : '' ?></td>
                                <td><?= $selectedFertilizer->has('plan') ? ($userAuthenticated->can('view', $selectedFertilizer->plan) ? $this->Html->link($selectedFertilizer->plan->id, ['controller' => 'Plans', 'action' => 'view', $selectedFertilizer->plan->id]) : $selectedFertilizer->plan->id) : '' ?></td>
                                <td><?= h($selectedFertilizer->created) ?></td>
                                <td><?= h($selectedFertilizer->modified) ?></td>
                                <td class="actions">
                                    <?php
                                    if ($userAuthenticated && $userAuthenticated->can('view', $selectedFertilizer)) {
                                        echo $this->Html->link(
                                            '<button type="button" class="mr-xs mb-xs btn btn-xs btn-info"><i class="fa fa-search"></i></button>',
                                            ['action' => 'view', $selectedFertilizer->id],
                                            ['escape' => false, 'title' => 'Visualizar']
                                        );
                                    }

                                    if ($userAuthenticated && $userAuthenticated->can('update', $selectedFertilizer)) {
                                        echo $this->Html->link(
                                            '<button type="button" class="mr-xs mb-xs btn btn-xs btn-warning"><i class="fa fa-pencil"></i></button>',
                                            ['action' => 'edit', $selectedFertilizer->id],
                                            ['escape' => false, 'title' => 'Editar']
                                        );
                                    }
                                        
                                    if ($userAuthenticated && $userAuthenticated->can('delete', $selectedFertilizer)) {
                                        echo $this->Form->postLink(
                                            '<button type="button" class="mr-xs mb-xs btn btn-xs btn-danger"><i class="fa fa-trash-o"></i></button>',
                                            ['action' => 'delete', $selectedFertilizer->id],
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
