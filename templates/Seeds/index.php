<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Seed[]|\Cake\Collection\CollectionInterface $seeds
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

            <?php
            if (isset($lastestUpdate)):
                ?>
                <h2 class="panel-title">Última atualização: <?=$lastestUpdate?></h2>
                <?php
            else:
                ?>
                <h2 class="panel-title">Listagem</h2>
                <?php
            endif;
            ?>
        </header>

        <div class="panel-body">
            <div class="table-responsive">
                <table class="table mb-none">
                    <thead>
                        <tr>
                            <th class="text-center"><?= $this->Paginator->sort('id', __('Id')) ?></th>
                            <th class="text-center"><?= $this->Paginator->sort('seed_note_id', __('Seed_note_id')) ?></th>
                            <th class="text-left"><?= $this->Paginator->sort('culture_id', __('Culture_id')) ?></th>
                            <th class="text-left"><?= $this->Paginator->sort('variety_id', __('Variety_id')) ?></th>
                            <th class="text-left"><?= $this->Paginator->sort('technology_id', __('Technology_id')) ?></th>
                            <th class="text-right"><?= $this->Paginator->sort('maturation_group', __('Maturation_group')) ?></th>
                            <th class="text-center"><?= $this->Paginator->sort('cycle_days', __('Cycle')) ?></th>
                            <th class="text-center"><?= $this->Paginator->sort('zoning_region_id', __('Zoning_region_id')) ?></th>
                            <th class="text-center"><?= $this->Paginator->sort('productive_potencial_id', __('Productive_potencial_id')) ?></th>
                            <th class="text-left"><?= $this->Paginator->sort('resistency', __('Resistency')) ?></th>
                            <th class="text-left"><?= $this->Paginator->sort('population', __('Population')) ?></th>
                            <th class="text-left"><?= $this->Paginator->sort('city_id', __('City_id')) ?></th>
                            <th class="text-left"><?= $this->Paginator->sort('supplier_id', __('Supplier_id')) ?></th>
                            <th class="text-center"><?= $this->Paginator->sort('created', __('Created')) ?></th>
                            <th class="text-center"><?= $this->Paginator->sort('modified', __('Modified')) ?></th>
                            <th class="actions">&nbsp;</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($seeds as $seed): ?>
                            <tr>
                                <td class="text-center"><?= $this->Number->format($seed->id) ?></td>
                                <td class="text-center note-text <?=$seed->seed_note->class?>" title="<?= $seed->seed_note->name ?>"></td>
                                <td class="text-left"><?= $seed->has('culture') ? ($userAuthenticated->can('view', $seed->culture) ? $this->Html->link($seed->culture->name, ['controller' => 'Cultures', 'action' => 'view', $seed->culture->id]) : $seed->culture->name) : '' ?></td>
                                <td class="text-left"><?= $seed->has('variety') ? ($userAuthenticated->can('view', $seed->variety) ? $this->Html->link($seed->variety->name, ['controller' => 'Varieties', 'action' => 'view', $seed->variety->id]) : $seed->variety->name) : '' ?></td>
                                <td class="text-left"><?= $seed->has('technology') ? ($userAuthenticated->can('view', $seed->technology) ? $this->Html->link($seed->technology->name, ['controller' => 'Technologies', 'action' => 'view', $seed->technology->id]) : $seed->technology->name) : '' ?></td>
                                <td class="text-right"><?= $this->Number->format($seed->maturation_group) ?></td>
                                <td class="text-center"><?= $this->Number->format($seed->cycle_days)."<br>".$seed->cycle->name ?></td>
                                <td class="text-center"><?= $seed->has('zoning_region') ? ($userAuthenticated->can('view', $seed->zoning_region) ? $this->Html->link($seed->zoning_region->name, ['controller' => 'ZoningRegions', 'action' => 'view', $seed->zoning_region->id]) : $seed->zoning_region->name) : '' ?></td>
                                <td class="text-center"><?= $seed->has('productive_potencial') ? ($userAuthenticated->can('view', $seed->productive_potencial) ? $this->Html->link($seed->productive_potencial->name, ['controller' => 'ProductivePotencials', 'action' => 'view', $seed->productive_potencial->id]) : $seed->productive_potencial->name) : '' ?></td>
                                <td class="text-left"><?= h($seed->resistency) ?></td>
                                <td class="text-left"><?= h($seed->population) ?></td>
                                <td class="text-left"><?= $seed->has('city') ? ($userAuthenticated->can('view', $seed->city) ? $this->Html->link($seed->city->name, ['controller' => 'Cities', 'action' => 'view', $seed->city->id]) : $seed->city->name) : '' ?></td>
                                <td class="text-left"><?= $seed->has('supplier') ? ($userAuthenticated->can('view', $seed->supplier) ? $this->Html->link($seed->supplier->name, ['controller' => 'Suppliers', 'action' => 'view', $seed->supplier->id]) : $seed->supplier->name) : '' ?></td>
                                <td class="text-center"><?= h($seed->created) ?></td>
                                <td class="text-center"><?= h($seed->modified) ?></td>
                                <td class="actions">
                                    <?php
                                    if ($userAuthenticated && $userAuthenticated->can('view', $seed)) {
                                        echo $this->Html->link(
                                            '<button type="button" class="mr-xs mb-xs btn btn-xs btn-info"><i class="fa fa-search"></i></button>',
                                            ['action' => 'view', $seed->id],
                                            ['escape' => false, 'title' => 'Visualizar']
                                        );
                                    }

                                    if ($userAuthenticated && $userAuthenticated->can('update', $seed)) {
                                        echo $this->Html->link(
                                            '<button type="button" class="mr-xs mb-xs btn btn-xs btn-warning"><i class="fa fa-pencil"></i></button>',
                                            ['action' => 'edit', $seed->id],
                                            ['escape' => false, 'title' => 'Editar']
                                        );
                                    }
                                        
                                    if ($userAuthenticated && $userAuthenticated->can('delete', $seed)) {
                                        echo $this->Form->postLink(
                                            '<button type="button" class="mr-xs mb-xs btn btn-xs btn-danger"><i class="fa fa-trash-o"></i></button>',
                                            ['action' => 'delete', $seed->id],
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

<?= $this->Html->script("/bundle/seeds_index.bundle.js") ?>