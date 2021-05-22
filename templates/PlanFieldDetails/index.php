<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\PlanFieldDetail[]|\Cake\Collection\CollectionInterface $planFieldDetails
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
                            <th><?= $this->Paginator->sort('field_detail_id', __('Field_detail_id')) ?></th>
                            <th><?= $this->Paginator->sort('plan_id', __('Plan_id')) ?></th>
                            <th><?= $this->Paginator->sort('selected_seed_id', __('Selected_seed_id')) ?></th>
                            <th><?= $this->Paginator->sort('sequence', __('Sequence')) ?></th>
                            <th><?= $this->Paginator->sort('created', __('Created')) ?></th>
                            <th><?= $this->Paginator->sort('modified', __('Modified')) ?></th>
                            <th class="actions">&nbsp;</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($planFieldDetails as $planFieldDetail): ?>
                            <tr>
                                <td><?= $this->Number->format($planFieldDetail->id) ?></td>
                                <td><?= $planFieldDetail->has('field_detail') ? ($userAuthenticated->can('view', $planFieldDetail->field_detail) ? $this->Html->link($planFieldDetail->field_detail->id, ['controller' => 'FieldDetails', 'action' => 'view', $planFieldDetail->field_detail->id]) : $planFieldDetail->field_detail->id) : '' ?></td>
                                <td><?= $planFieldDetail->has('plan') ? ($userAuthenticated->can('view', $planFieldDetail->plan) ? $this->Html->link($planFieldDetail->plan->id, ['controller' => 'Plans', 'action' => 'view', $planFieldDetail->plan->id]) : $planFieldDetail->plan->id) : '' ?></td>
                                <td><?= $planFieldDetail->has('selected_seed') ? ($userAuthenticated->can('view', $planFieldDetail->selected_seed) ? $this->Html->link($planFieldDetail->selected_seed->id, ['controller' => 'SelectedSeeds', 'action' => 'view', $planFieldDetail->selected_seed->id]) : $planFieldDetail->selected_seed->id) : '' ?></td>
                                <td><?= $this->Number->format($planFieldDetail->sequence) ?></td>
                                <td><?= h($planFieldDetail->created) ?></td>
                                <td><?= h($planFieldDetail->modified) ?></td>
                                <td class="actions">
                                    <?php
                                    if ($userAuthenticated && $userAuthenticated->can('view', $planFieldDetail)) {
                                        echo $this->Html->link(
                                            '<button type="button" class="mr-xs mb-xs btn btn-xs btn-info"><i class="fa fa-search"></i></button>',
                                            ['action' => 'view', $planFieldDetail->id],
                                            ['escape' => false, 'title' => 'Visualizar']
                                        );
                                    }

                                    if ($userAuthenticated && $userAuthenticated->can('update', $planFieldDetail)) {
                                        echo $this->Html->link(
                                            '<button type="button" class="mr-xs mb-xs btn btn-xs btn-warning"><i class="fa fa-pencil"></i></button>',
                                            ['action' => 'edit', $planFieldDetail->id],
                                            ['escape' => false, 'title' => 'Editar']
                                        );
                                    }
                                        
                                    if ($userAuthenticated && $userAuthenticated->can('delete', $planFieldDetail)) {
                                        echo $this->Form->postLink(
                                            '<button type="button" class="mr-xs mb-xs btn btn-xs btn-danger"><i class="fa fa-trash-o"></i></button>',
                                            ['action' => 'delete', $planFieldDetail->id],
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
