<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\City[]|\Cake\Collection\CollectionInterface $cities
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
                            <th><?= $this->Paginator->sort('state_id', __('State_id')) ?></th>
                            <th><?= $this->Paginator->sort('name', __('Name')) ?></th>
                            <th><?= $this->Paginator->sort('created', __('Created')) ?></th>
                            <th><?= $this->Paginator->sort('modified', __('Modified')) ?></th>
                            <th class="actions">&nbsp;</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($cities as $city): ?>
                            <tr>
                                <td><?= $this->Number->format($city->id) ?></td>
                                <td><?= $city->has('state') ? ($userAuthenticated->can('view', $city->state) ? $this->Html->link($city->state->name, ['controller' => 'States', 'action' => 'view', $city->state->id]) : $city->state->name) : '' ?></td>
                                <td><?= h($city->name) ?></td>
                                <td><?= h($city->created) ?></td>
                                <td><?= h($city->modified) ?></td>
                                <td class="actions">
                                    <?php
                                    if ($userAuthenticated && $userAuthenticated->can('view', $city)) {
                                        echo $this->Html->link(
                                            '<button type="button" class="mr-xs mb-xs btn btn-xs btn-info"><i class="fa fa-search"></i></button>',
                                            ['action' => 'view', $city->id],
                                            ['escape' => false, 'title' => 'Visualizar']
                                        );
                                    }

                                    if ($userAuthenticated && $userAuthenticated->can('update', $city)) {
                                        echo $this->Html->link(
                                            '<button type="button" class="mr-xs mb-xs btn btn-xs btn-warning"><i class="fa fa-pencil"></i></button>',
                                            ['action' => 'edit', $city->id],
                                            ['escape' => false, 'title' => 'Editar']
                                        );
                                    }
                                        
                                    if ($userAuthenticated && $userAuthenticated->can('delete', $city)) {
                                        echo $this->Form->postLink(
                                            '<button type="button" class="mr-xs mb-xs btn btn-xs btn-danger"><i class="fa fa-trash-o"></i></button>',
                                            ['action' => 'delete', $city->id],
                                            ['escape' => false, 'title' => 'Excluir', 'confirm' => 'Confirma a exclus??o deste registro?']
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
                    <?= $this->Paginator->next('Pr??xima >') ?>
                    <?= $this->Paginator->last('??ltima >>') ?>
                </ul>
                <p><?= $this->Paginator->counter('P??gina {{page}} de {{pages}}, exibindo {{current}} registro(s) de {{count}}') ?></p>
            </div>
        </div>
    </section>
</div>
