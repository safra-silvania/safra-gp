<?= $this->Form->hidden('planId', ['id' => 'planId', 'value' => $plan->id]) ?>

<div class="col-lg-12">
    <section class="panel">
        <header class="panel-heading">
            <div class="panel-actions pull-right">
                <?php
                echo $this->Html->link(
                    '<button type="button" class="btn btn-default mr-sm"><i class="fa fa-arrow-left mr-xs"></i>Voltar</button>',
                    ['controller' => 'plans', 'action' => 'index'],
                    ['escape' => false, 'title' => 'Voltar']
                );
                ?>

                <a href="#" class="panel-action panel-action-toggle" data-panel-toggle=""></a>
            </div>

            <h2 class="panel-title"><?=$plan->immobile->producer->name?> <small><?=$plan->immobile->name?></small> </h2>
        </header>

        <div class="panel-body">
          <div class="table-responsive">
            <table class="table table-bordered table-striped" id="selected-seeds" data-url="<?= Cake\Routing\Router::url(["controller"=>"plans", "action" => "get-selected-seeds", $plan->id]); ?>">
              <thead>
                <tr>
                  <th>&nbsp;</th>
                  <th>Cód</th>
                  <th>Nota</th>
                  <th>Cultura</th>
                  <th>Variedade</th>
                  <th>Tecnologia</th>
                  <th>Grupo Maturação</th>
                  <th>Ciclo</th>
                  <th>Fertilidade</th>
                  <th>Resistência</th>
                  <th>População</th>
                  <th>Município</th>
                  <th>Zoneamento Região</th>
                  <th>Fornecedor</th>
                  <th>Observações</th>
                </tr>
              </thead>
              <tbody></tbody>
            </table>
          </div>
        </div>
    </section>
</div>

<?= $this->Html->script("/bundle/selected_seeds_index.bundle.js") ?>
