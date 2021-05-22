<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Field[]|\Cake\Collection\CollectionInterface $fields
 */
?>

<div class="col-md-4 col-lg-3">
    <?php echo $this->cell('ImmobileCard', [$immobileId]);?>
</div>

<div class="col-md-8 col-lg-9">
    <section class="panel">
        <header class="panel-heading">
            <div class="panel-actions pull-right">
                <?php
                if ($canCreate) {
                    echo $this->Html->link(
                        '<button type="button" class="btn btn-default mr-sm"><i class="fa fa-plus mr-xs"></i>Incluir</button>',
                        ['action' => 'add', $immobileId],
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
                            <th><?= __('Name') ?></th>
                            <th class="text-right"><?= __('Area') ?></th>
                            <th class="text-center"><?= __('Cultivation_system_id') ?></th>
                            <th class="text-center"><?= __('Fertility_id') ?></th>
                            <th class="text-center"><?= __('City_id') ?></th>
                            <th class="text-center"><?= __('Cultures') ?></th>
                            <th class="actions">&nbsp;</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($fields as $field): ?>
                            <tr class="">
                                <td><?= h($field->name) ?></td>
                                <td class="text-right"><?= $this->Number->format($field->total_area) . " " . $field->measure_unit->initial ?></td>
                                <td class="text-center"><?= $field->cultivation_system->name ?></td>
                                <td class="text-center"><?= $field->fertility->name ?></td>
                                <td class="text-center"><?= $field->city->name ?></td>
                                <td class="text-left">
                                    <blockquote>
                                    <?php
                                    if (count($field->field_details) > 0) {
                                        $sumArea = 0;
                                        foreach($field->field_details as $detail) {
                                            $sumArea += $detail->area;
                                            echo "<p>-&nbsp;{$detail->culture->name}: {$detail->area} {$detail->measure_unit->initial}</p>";
                                            ?>
                                            <?php
                                        }

                                        $icon = $sumArea == $field->total_area ? 'check' : 'times';

                                        echo "<p style='border-top: 2px #eee solid'>-&nbsp;Total: {$sumArea} {$detail->measure_unit->initial}&nbsp;<i class='fa fa-{$icon}' aria-hidden='true'></i></p>";
                                    }
                                    ?>
                                    </blockquote>
                                </td>
                                <td class="actions text-center">
                                    <?php

                                    echo $this->Html->link(
                                        '<button type="button" class="mr-xs mb-xs btn btn-xs btn-primary"><i class="fa fa-leaf"></i>&nbsp;Culturas</button>',
                                        ['controller' => 'FieldDetails', 'action' => 'index', $field->id],
                                        ['escape' => false, 'title' => 'Culturas']
                                    );

                                    echo $this->Html->link(
                                        '<button type="button" class="mr-xs mb-xs btn btn-xs btn-primary"><i class="fa fa-window-restore "></i>&nbspCroquis</button>',
                                        ['controller' => 'Sketches', 'action' => 'index', $field->id],
                                        ['escape' => false, 'title' => 'Croqui']
                                    );
                                    echo "<br />";

                                    if ($userAuthenticated && $userAuthenticated->can('view', $field)) {
                                        echo $this->Html->link(
                                            '<button type="button" class="mr-xs mt-xs btn btn-xs btn-info"><i class="fa fa-search"></i></button>',
                                            ['action' => 'view', $immobileId, $field->id],
                                            ['escape' => false, 'title' => 'Visualizar']
                                        );
                                    }

                                    if ($userAuthenticated && $userAuthenticated->can('update', $field)) {
                                        echo $this->Html->link(
                                            '<button type="button" class="mr-xs mt-xs btn btn-xs btn-warning"><i class="fa fa-pencil"></i></button>',
                                            ['action' => 'edit', $immobileId, $field->id],
                                            ['escape' => false, 'title' => 'Editar']
                                        );
                                    }
                                        
                                    if ($userAuthenticated && $userAuthenticated->can('delete', $field)) {
                                        echo $this->Form->postLink(
                                            '<button type="button" class="mr-xs mt-xs btn btn-xs btn-danger"><i class="fa fa-trash-o"></i></button>',
                                            ['action' => 'delete', $immobileId, $field->id],
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
        </div>
    </section>
</div>
