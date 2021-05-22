<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\FieldDetail[]|\Cake\Collection\CollectionInterface $fieldDetails
 */
?>

<div class="col-md-4 col-lg-3">
    <?php echo $this->cell('FieldCard', [$field->id]);?>
</div>

<div class="col-md-8 col-lg-9">
    <section class="panel">
        <header class="panel-heading">
            <div class="panel-actions pull-right">
                <?php
                if ($canCreate) {
                    echo $this->Html->link(
                        '<button type="button" class="btn btn-default mr-sm"><i class="fa fa-plus mr-xs"></i>Incluir</button>',
                        ['action' => 'add', $field->id],
                        ['escape' => false, 'title' => 'Incluir']
                    );
                }

                echo $this->Html->link(
                    '<button type="button" class="btn btn-default mr-sm"><i class="fa fa-arrow-left mr-xs"></i>Voltar</button>',
                    ['controller' => 'fields', 'action' => 'index', $field->immobile_id],
                    ['escape' => false, 'title' => 'Voltar']
                );

                ?>

                <a href="#" class="panel-action panel-action-toggle" data-panel-toggle=""></a>
            </div>

            <h2 class="panel-title">
                <?= $field->name ?>
                &nbsp;-&nbsp;
                <?=$this->Number->format($field->total_area)?> <?=$field->measure_unit->initial?>
            </h2>
        </header>

        <div class="panel-body">
            <div class="table-responsive">
                <table class="table mb-none">
                    <thead>
                        <tr>
                            <th class="text-center"><?= __('Culture_id') ?></th>
                            <th class="text-center"><?= __('Fertility_id') ?></th>
                            <th class="text-right"><?= __('Area') ?></th>
                            <th class="actions">&nbsp;</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $sumArea = 0;
                        foreach ($fieldDetails as $fieldDetail):
                            $sumArea += $fieldDetail->area;
                            ?>
                            <tr>
                                <td class="text-center"><?= $fieldDetail->culture->name ?></td>
                                <td class="text-center"><?= $fieldDetail->fertility->name ?></td>
                                <td class="text-right"><?= $this->Number->format($fieldDetail->area) . " " . $fieldDetail->measure_unit->initial ?></td>
                                <td class="actions">
                                    <?php
                                    if ($userAuthenticated && $userAuthenticated->can('view', $fieldDetail)) {
                                        echo $this->Html->link(
                                            '<button type="button" class="mr-xs mb-xs btn btn-xs btn-info"><i class="fa fa-search"></i></button>',
                                            ['action' => 'view', $field->id, $fieldDetail->id],
                                            ['escape' => false, 'title' => 'Visualizar']
                                        );
                                    }

                                    if ($userAuthenticated && $userAuthenticated->can('update', $fieldDetail)) {
                                        echo $this->Html->link(
                                            '<button type="button" class="mr-xs mb-xs btn btn-xs btn-warning"><i class="fa fa-pencil"></i></button>',
                                            ['action' => 'edit', $field->id, $fieldDetail->id],
                                            ['escape' => false, 'title' => 'Editar']
                                        );
                                    }
                                        
                                    if ($userAuthenticated && $userAuthenticated->can('delete', $fieldDetail)) {
                                        echo $this->Form->postLink(
                                            '<button type="button" class="mr-xs mb-xs btn btn-xs btn-danger"><i class="fa fa-trash-o"></i></button>',
                                            ['action' => 'delete', $field->id, $fieldDetail->id],
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

            <br />
            <div class="progress light m-md">
                <?php
                $percentual = ($sumArea * 100) / $field->total_area;

                if ($percentual > 100) {
                    $percentualCss =  100;
                    $class = 'danger';
                } elseif ($percentual < 100) {
                    $percentualCss = $percentual;
                    $class = 'warning';
                } else {
                    $percentualCss = 100;
                    $class = 'success';
                }
                ?>
                <div class="progress-bar progress-bar-<?=$class?>" role="progressbar" aria-valuenow="<?=$percentual?>" aria-valuemin="0" aria-valuemax="100" style="width: <?=$percentualCss?>%;">
                    <?=$this->Number->format($percentual)?>% completo
                </div>
            </div>
        </div>
    </section>
</div>
