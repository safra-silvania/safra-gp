<div class="col-md-4 col-lg-3">
    <?php echo $this->cell('ImmobilePlanning', [$plan->immobile_id]);?>
</div>

<div class="col-md-8 col-lg-9">
    <section class="panel">
        <header class="panel-heading">
            <div class="panel-actions pull-right">
                <?php
                echo $this->Html->link(
                    '<button type="button" class="btn btn-default mr-sm"><i class="fa fa-arrow-left mr-xs"></i>Voltar</button>',
                    ['action' => 'index'],
                    ['escape' => false, 'title' => 'Voltar']
                );
                ?>
                
                <a href="#" class="panel-action panel-action-toggle" data-panel-toggle=""></a>
            </div>

            <h2 class="panel-title">Sequência de Plantio</h2>
        </header>

        <div class="panel-body">
            <div class="panel-group" id="accordion2">
                <div class="panel panel-accordion panel-accordion-primary">
                    <div class="panel-heading">
                        <h4 class="panel-title">
                            <a class="accordion-toggle collapsed" data-toggle="collapse" data-parent="#accordion2" href="#collapse2Two" aria-expanded="false">
                                <i class="fa fa-tags"></i> Sementes Selecionadas
                            </a>
                        </h4>
                    </div>
                    <div id="collapse2Two" class="accordion-body collapse" aria-expanded="false">
                        <div class="panel-body">
                            <table class="table mb-none">
                                <thead>
                                    <tr>
                                        <th class="text-center"><strong>Cód.</strong></th>
                                        <th class="text-center">Nota</th>
                                        <th class="">Cultura</th>
                                        <th class="">Variedade</th>
                                        <th class="text-center">Tecnologia</th>
                                        <th class="text-center">Grupo Maturação</th>
                                        <th class="text-center">Ciclo</th>
                                        <th class="">Fertilidade</th>
                                        <th class="">Resistência</th>
                                        <th class="">População</th>
                                        <th class="">Município</th>
                                        <th class="text-center">Zoneamento Região</th>
                                        <th class="">Fornecedor</th>
                                        <!-- <th class="">Observações</th> -->
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $i = 0;
                                    foreach ($selectedSeeds as $selectedSeed):
                                        $i++;
                                        
                                        $seed = $selectedSeed->seed;
                                        $culture = $seed->culture;
                                        $variety = $seed->variety;
                                        $technology = $seed->technology;
                                        $cycle = $seed->cycle;
                                        $city = $seed->city;
                                        $supplier = $seed->supplier;
                                        
                                        $fertilities = "";
                                        foreach ($seed->fertilities as $fertility)
                                            $fertilities .= $fertility->name.", ";

                                        echo "<input type='hidden'
                                            id='selected-seed-{$selectedSeed->id}'
                                            class='hdd-selected-seed'
                                            data-label='#{$seed->id}'
                                            data-class='{$seed->seed_note->class}'
                                            value='{$selectedSeed->id}'
                                        />";

                                        ?>

                                        <tr>
                                            <td class="text-center"><strong>#<?=$seed->id?></strong></td>
                                            <td class="note-text <?=$seed->seed_note->class?>" title="<?=$seed->seed_note->name?>"></td>
                                            <td class=""><?=$culture->name?></td>
                                            <td class=""><?=$variety->name?></td>
                                            <td class="text-center"><?=$technology->name?></td>
                                            <td class="text-center"><?=$seed->maturation_group?></td>
                                            <td class="text-center"><?=$seed->cycle_days.' '.$cycle->name?></td>
                                            <td class="text-center"><?=trim(trim($fertilities), ",")?></td>
                                            <td class=""><?=$seed->resistency?></td>
                                            <td class=""><?=$seed->population?></td>
                                            <td class=""><?=$city->name?></td>
                                            <td class="text-center"><?=$seed->zoning_region->name?></td>
                                            <td class=""><?=$supplier ? $supplier->name : ""?></td>
                                            <!-- <td class=""><blockquote><?=$seed->observations?></blockquote></td> -->
                                        </tr>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>

            <hr />
            
            <input type="hidden" id="planId" value="<?=$plan->id?>" />

            <div class="table-responsive" id="planning-table" data-loading-overlay>
            </div>

        </div>

    </section>
</div>

<?= $this->Html->script("/bundle/planning_order.bundle.js") ?>