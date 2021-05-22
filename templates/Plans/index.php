<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Plan[]|\Cake\Collection\CollectionInterface $plans
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
                            <th><?= __('Producer') ?></th>
                            <th><?= $this->Paginator->sort('immobile_id', __('Immobile_id')) ?></th>
                            <th class="not-ordenable-column text-center"><?=__('SelectedSeeds')?></th>
                            <th class="not-ordenable-column text-center"><?=__('SelectedChemicals')?></th>
                            <th class="not-ordenable-column text-center"><?=__('SelectedFertilizers')?></th>
                            <th><?= $this->Paginator->sort('created', __('Created')) ?></th>
                            <th><?= $this->Paginator->sort('modified', __('Modified')) ?></th>
                            <th class="actions">&nbsp;</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($plans as $plan): ?>
                            
                            <?php
                            $qtd = count($plan->selected_seeds);
                            $class = "";
                            $button = "";
                            
                            if ($qtd == 0)
                                $class = "danger";
                            else
                                $class = "success";
                            
                            $button = "<button type='button' class='mb-xs mt-xs mr-xs btn btn-sm btn-{$class}'>{$qtd}&nbsp;<i class='fa fa-tags'></i></button>";

                            $selectedSeedsLink = $this->Html->link(
                                $button,
                                ['controller' => 'selected-seeds', 'action' => 'index', $plan->id],
                                ['escape' => false, 'title' => 'Selecionar Sementes']
                            );



                            $qtd = count($plan->selected_chemicals);
                            if ($qtd == 0)
                                $class = "danger";
                            else
                                $class = "success";
                            
                            $button = "<button type='button' class='mb-xs mt-xs mr-xs btn btn-sm btn-{$class}'>{$qtd}&nbsp;<i class='fa fa-flask'></i></button>";
                            $selectedChemicalsLink = $this->Html->link(
                                $button,
                                ['controller' => 'selected-chemicals', 'action' => 'index', $plan->id],
                                ['escape' => false, 'title' => 'Selecionar Químicos']
                            );
                            ?>

                            <tr >
                                <td class="text-middle"><?= $this->Number->format($plan->id) ?></td>
                                <td class="text-middle"><?= h($plan->immobile->producer->name) ?></td>
                                <td class="text-middle"><?= h($plan->immobile->name) ?></td>
                                <td class="text-middle text-center"><?= $selectedSeedsLink ?></td>
                                <td class="text-middle text-center"><?= $selectedChemicalsLink ?></td>
                                <!-- <td class="text-middle text-center"><button title="Em Desenvolvimento" type='button' class='mb-xs mt-xs mr-xs btn btn-sm btn-danger disabled'>0&nbsp;<i class='fa fa-flask'></i></button></td> -->
                                <td class="text-middle text-center"><button title="Em Desenvolvimento" type='button' class='mb-xs mt-xs mr-xs btn btn-sm btn-danger disabled'>0&nbsp;<i class='fa fa-eyedropper'></i></button></td>
                                <td class="text-middle"><?= h($plan->created) ?></td>
                                <td class="text-middle"><?= h($plan->modified) ?></td>
                                <td class="actions text-center">
                                    <?php
                                    
                                    echo $this->Html->link(
                                        '<button type="button" class="mr-xs mb-xs btn btn-sm btn-primary"><i class="fa fa-arrows-v"></i>&nbsp;Ordem Plantio</button>',
                                        ['action' => 'planning-order', $plan->id],
                                        ['escape' => false, 'title' => 'Alterar Ordem']
                                    );

                                    if ($userAuthenticated && $userAuthenticated->can('view', $plan)) {
                                        echo $this->Html->link(
                                            '<button type="button" class="mr-xs mb-xs btn btn-sm btn-info"><i class="fa fa-search"></i></button>',
                                            ['action' => 'view', $plan->id],
                                            ['escape' => false, 'title' => 'Visualizar']
                                        );
                                    }

                                    if ($userAuthenticated && $userAuthenticated->can('update', $plan)) {
                                        echo $this->Html->link(
                                            '<button type="button" class="mr-xs mb-xs btn btn-sm btn-warning"><i class="fa fa-pencil"></i></button>',
                                            ['action' => 'edit', $plan->id],
                                            ['escape' => false, 'title' => 'Editar']
                                        );
                                    }
                                        
                                    if ($userAuthenticated && $userAuthenticated->can('delete', $plan)) {
                                        echo $this->Form->postLink(
                                            '<button type="button" class="mr-xs mb-xs btn btn-sm btn-danger"><i class="fa fa-trash-o"></i></button>',
                                            ['action' => 'delete', $plan->id],
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
