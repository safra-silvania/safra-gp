<section class="panel">
    <div class="panel-body">
        <div class="thumb-info mb-md">
            <h3 class="text-center"><strong><?= $immobile->producer->name ?></strong></h3>
            <h4 class="text-center"><strong><?= $immobile->name ?></strong></h4>
        </div>

        <div class="widget-toggle-expand mb-md">
            <div class="widget-header text-center">
                <h4><?= $immobile->harvest ?></h4>
            </div>

            <hr class="dotted short">

            <?php
            $sum = 0;
            foreach($totals as $total):
                $sum += $total->sum;
                ?>
                <div class="row">
                    <div class="col-xs-6 text-weight-semibold"><?=$total->cultivation_system?></div>
                    <div class="col-xs-6 text-weight-semibold text-right"><?=$total->sum?></div>
                </div>
                <?php
            endforeach;
            ?>
            <div class="row">
                <div class="col-xs-6 text-weight-semibold text-dark"><h5>Total</h5></div>
                <div class="col-xs-6 text-weight-semibold text-dark text-right"><h5><?=$sum?></h5></div>
            </div>
            
            <?php if ($immobile->observations): ?>
            <hr class="dotted short">
            <h6 class="text-muted">Observações</h6>
            <p><?= $immobile->observations ?></p>
            <?php endif; ?>

            <hr class="dotted short">

            <div class="row text-center">
                <?php
                if (!$isCompletedArea) {
                    ?>
                    <button type='button' class='mb-xs mt-xs mr-xs btn btn-primary disabled' title="Existem talhões incompletos" style="text-decoration: line-through">Iniciar Planejamento</button>
                    <?php
                } else {
                    if (count($immobile->plans) > 0) {
                        $last = end($immobile->plans);
                        echo $this->Html->link(
                            "<button type='button' class='mb-xs mt-xs mr-xs btn btn-primary'>Planejamento</button>",
                            ['controller' => 'Plans', 'action' => 'planning-order', $last->id],
                            ['escape' => false, 'title' => 'Planejamento']
                        );
                    } else {
                        echo $this->Html->link(
                            "<button type='button' class='mb-xs mt-xs mr-xs btn btn-primary'>Iniciar Planejamento</button>",
                            ['controller' => 'Plans', 'action' => 'start-planning', $immobile->id],
                            ['escape' => false, 'title' => 'Iniciar']
                        );
                    }
                }
                ?>
            </div>

        </div>

    </div>
</section>