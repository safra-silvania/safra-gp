<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Immobile[]|\Cake\Collection\CollectionInterface $immobiles
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
                            <th><?= $this->Paginator->sort('producer_id', __('Producer_id')) ?></th>
                            <th><?= $this->Paginator->sort('name', __('Name')) ?></th>
                            <th class="not-ordenable-column text-center">Talhões</th>
                            <th><?= $this->Paginator->sort('harvest', __('Harvest')) ?></th>
                            <th><?= $this->Paginator->sort('city_id', __('City_id')) ?></th>
                            <th class="actions">&nbsp;</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($immobiles as $immobile): ?>
                            <?php
                            $qtd = count($immobile['fields']);
                            $class = "";
                            $text = "";
                            $button = "";
                            
                            if ($qtd == 0) {
                                $class = "danger";
                                $text = "nenhum";
                            } elseif ($qtd == 1) {
                                $class = "success";
                                $text = "1 talhão";
                            } else {
                                $class = "success";
                                $text = "{$qtd} talhões";
                            }
                            
                            $button = "<button type='button' class='mb-xs mt-xs mr-xs btn btn-xs btn-{$class}'>{$text}</button>";

                            $fieldsLink = $this->Html->link(
                                $button,
                                ['controller' => 'fields', 'action' => 'index', $immobile->id],
                                ['escape' => false, 'title' => 'Incluir']
                            );
                            ?>

                            <tr>
                                <td><?= $this->Number->format($immobile->id) ?></td>
                                <td><?= $immobile->has('producer') ? ($userAuthenticated->can('view', $immobile->producer) ? $this->Html->link($immobile->producer->name, ['controller' => 'Producers', 'action' => 'view', $immobile->producer->id]) : $immobile->producer->name) : '' ?></td>
                                <td><?= h($immobile->name) ?></td>
                                <td class="text-center"><?= $fieldsLink ?></td>
                                <td><?= h($immobile->harvest) ?></td>
                                <td><?= $immobile->has('city') ? ($userAuthenticated->can('view', $immobile->city) ? $this->Html->link($immobile->city->name, ['controller' => 'Cities', 'action' => 'view', $immobile->city->id]) : $immobile->city->name) : '' ?></td>
                                <td class="actions">
                                    <?php
                                    if ($userAuthenticated && $userAuthenticated->can('view', $immobile)) {
                                        echo $this->Html->link(
                                            '<button type="button" class="mr-xs mb-xs btn btn-xs btn-info"><i class="fa fa-search"></i></button>',
                                            ['action' => 'view', $immobile->id],
                                            ['escape' => false, 'title' => 'Visualizar']
                                        );
                                    }

                                    if ($userAuthenticated && $userAuthenticated->can('update', $immobile)) {
                                        echo $this->Html->link(
                                            '<button type="button" class="mr-xs mb-xs btn btn-xs btn-warning"><i class="fa fa-pencil"></i></button>',
                                            ['action' => 'edit', $immobile->id],
                                            ['escape' => false, 'title' => 'Editar']
                                        );
                                    }
                                        
                                    if ($userAuthenticated && $userAuthenticated->can('delete', $immobile)) {
                                        echo $this->Form->postLink(
                                            '<button type="button" class="mr-xs mb-xs btn btn-xs btn-danger"><i class="fa fa-trash-o"></i></button>',
                                            ['action' => 'delete', $immobile->id],
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
