<aside id="sidebar-left" class="sidebar-left">

    <div class="sidebar-header">
        <div class="sidebar-title">
            Menu
        </div>
        <div class="sidebar-toggle hidden-xs" data-toggle-class="sidebar-left-collapsed" data-target="html" data-fire-event="sidebar-left-toggle" id="sidebar-left-toggle" data-target-url="<?= Cake\Routing\Router::url(["controller"=>"users","action"=>"toggleSidebar"]); ?>">
            <i class="fa fa-bars" aria-label="Toggle sidebar"></i>
        </div>
    </div>

    <div class="nano">
        <div class="nano-content">
            <nav id="menu" class="nav-main" role="navigation">
            
                <ul class="nav nav-main">
                <li class="<?= $controller == 'Dashboard' ? 'nav-active' : '' ?>">
                        <?php
                        echo $this->Html->link(
                            '<i class="fa fa-home" aria-hidden="true"></i><span>Dashboard</span>',
                            ['controller' => 'Dashboard', 'action' => 'index'],
                            ['escape' => false]
                        );
                        ?>
                    </li>

                    <?php
                    $childrenCadastro = ['Producers', 'Immobiles', 'Fields', 'Seeds', 'Suppliers', 'FieldDetails', 'Sketches'];
                    
                    $childrenSeeds = ['Seeds', 'Cultures', 'Fertilities', 'Varieties', 'Cycles', 'Technologies',
                                      'ProductivePotencials', 'SeedNotes'];

                    $childrenQuimicos = ['Chemicals', 'ChemicalTargets', 'ChemicalMeasureUnits', 'ChemicalGroups',
                                         'ChemicalClasses', 'ChemicalActionModes', 'ApplicationSeasons',
                                         'ChemicalNotes'];

                    $childrenAdubos = ['Fertilizers', 'FertilizerMeasureUnits'];

                    $childrenOutros = ['Roles', 'Users', 'States', 'Cities', 'CultivationSystems',
                                       'MeasureUnits', 'SupplierTypes'];
                    ?>

                    <li class="nav-parent <?=in_array($controller, $childrenCadastro) || in_array($controller, $childrenSeeds) || in_array($controller, $childrenQuimicos) || in_array($controller, $childrenAdubos) || in_array($controller, $childrenOutros) ? 'nav-expanded' : ''?>">
                        <a href="#">
                            <i class="fa fa-columns" aria-hidden="true"></i>
                            <span>Cadastro</span>
                        </a>
                        <ul class="nav nav-children" style="">
                            <?php if ($canAccessProducers): ?>
                            <li class="<?= $controller == 'Producers' ? 'nav-active' : '' ?>">
                                <?php
                                echo $this->Html->link(__('Producers'), ['controller' => 'Producers', 'action' => 'index']);
                                ?>
                            </li>
                            <?php endif; ?>

                            <?php if ($canAccessImmobiles): ?>
                            <li class="<?= $controller == 'Immobiles' || $controller == 'Fields' || $controller == 'FieldDetails' || $controller == 'Sketches' ? 'nav-active' : '' ?>">
                                <?php
                                echo $this->Html->link(__('Immobiles'), ['controller' => 'Immobiles', 'action' => 'index']);
                                ?>
                            </li>
                            <?php endif; ?>

                            <?php if ($canAccessSuppliers): ?>
                            <li class="<?= $controller == 'Suppliers' ? 'nav-active' : '' ?>">
                                <?php
                                echo $this->Html->link(__('Suppliers'), ['controller' => 'Suppliers', 'action' => 'index']);
                                ?>
                            </li>
                            <?php endif; ?>

                            <li class="nav-parent <?=in_array($controller, $childrenSeeds) ? 'nav-expanded' : ''?>">
                                <a href="#">
                                    Sementes
                                </a>
                                <ul class="nav nav-children">
                                    <?php if ($canAccessCultures): ?>
                                    <li class="<?= $controller == 'Cultures' ? 'nav-active' : '' ?>">
                                        <?php
                                        echo $this->Html->link(__('Cultures'), ['controller' => 'Cultures', 'action' => 'index']);
                                        ?>
                                    </li>
                                    <?php endif; ?>

                                    <?php if ($canAccessSeeds): ?>
                                    <li class="<?= $controller == 'Seeds' ? 'nav-active' : '' ?>">
                                        <?php
                                        echo $this->Html->link(__('Seeds'), ['controller' => 'Seeds', 'action' => 'index']);
                                        ?>
                                    </li>
                                    <?php endif; ?>

                                    <?php if ($canAccessFertilities): ?>
                                    <li class="<?= $controller == 'Fertilities' ? 'nav-active' : '' ?>">
                                        <?php
                                        echo $this->Html->link(__('Fertilities'), ['controller' => 'Fertilities', 'action' => 'index']);
                                        ?>
                                    </li>
                                    <?php endif; ?>

                                    <?php if ($canAccessCycles): ?>
                                    <li class="<?= $controller == 'Cycles' ? 'nav-active' : '' ?>">
                                        <?php
                                        echo $this->Html->link(__('Cycles'), ['controller' => 'Cycles', 'action' => 'index']);
                                        ?>
                                    </li>
                                    <?php endif; ?>

                                    <?php if ($canAccessVarieties): ?>
                                    <li class="<?= $controller == 'Varieties' ? 'nav-active' : '' ?>">
                                        <?php
                                        echo $this->Html->link(__('Varieties'), ['controller' => 'Varieties', 'action' => 'index']);
                                        ?>
                                    </li>
                                    <?php endif; ?>

                                    <?php if ($canAccessTechnologies): ?>
                                    <li class="<?= $controller == 'Technologies' ? 'nav-active' : '' ?>">
                                        <?php
                                        echo $this->Html->link(__('Technologies'), ['controller' => 'Technologies', 'action' => 'index']);
                                        ?>
                                    </li>
                                    <?php endif; ?>

                                    <?php if ($canAccessProductivePotencials): ?>
                                    <li class="<?= $controller == 'ProductivePotencials' ? 'nav-active' : '' ?>">
                                        <?php
                                        echo $this->Html->link(__('ProductivePotencials'), ['controller' => 'ProductivePotencials', 'action' => 'index']);
                                        ?>
                                    </li>
                                    <?php endif; ?>

                                    <?php if ($canAccessSeedNotes): ?>
                                    <li class="<?= $controller == 'SeedNotes' ? 'nav-active' : '' ?>">
                                        <?php
                                        echo $this->Html->link(__('SeedNotes'), ['controller' => 'SeedNotes', 'action' => 'index']);
                                        ?>
                                    </li>
                                    <?php endif; ?>
                                </ul>
                            </li>

                            <li class="nav-parent <?=in_array($controller, $childrenQuimicos) ? 'nav-expanded' : ''?>">
                                <a href="#">
                                    Químicos
                                </a>
                                <ul class="nav nav-children">
                                    <?php if ($canAccessChemicalGroups): ?>
                                    <li class="<?= $controller == 'ChemicalGroups' ? 'nav-active' : '' ?>">
                                        <?php
                                        echo $this->Html->link(__('ChemicalGroups'), ['controller' => 'ChemicalGroups', 'action' => 'index']);
                                        ?>
                                    </li>
                                    <?php endif; ?>

                                    <?php if ($canAccessChemicals): ?>
                                    <li class="<?= $controller == 'Chemicals' ? 'nav-active' : '' ?>">
                                        <?php
                                        echo $this->Html->link(__('Chemicals'), ['controller' => 'Chemicals', 'action' => 'index']);
                                        ?>
                                    </li>
                                    <?php endif; ?>

                                    <?php if ($canAccessChemicalTargets): ?>
                                    <li class="<?= $controller == 'ChemicalTargets' ? 'nav-active' : '' ?>">
                                        <?php
                                        echo $this->Html->link(__('ChemicalTargets'), ['controller' => 'ChemicalTargets', 'action' => 'index']);
                                        ?>
                                    </li>
                                    <?php endif; ?>

                                    <?php if ($canAccessChemicalMeasureUnits): ?>
                                    <li class="<?= $controller == 'ChemicalMeasureUnits' ? 'nav-active' : '' ?>">
                                        <?php
                                        echo $this->Html->link(__('ChemicalMeasureUnits'), ['controller' => 'ChemicalMeasureUnits', 'action' => 'index']);
                                        ?>
                                    </li>
                                    <?php endif; ?>

                                    <?php if ($canAccessChemicalClasses): ?>
                                    <li class="<?= $controller == 'ChemicalClasses' ? 'nav-active' : '' ?>">
                                        <?php
                                        echo $this->Html->link(__('ChemicalClasses'), ['controller' => 'ChemicalClasses', 'action' => 'index']);
                                        ?>
                                    </li>
                                    <?php endif; ?>

                                    <?php if ($canAccessChemicalActionModes): ?>
                                    <li class="<?= $controller == 'ChemicalActionModes' ? 'nav-active' : '' ?>">
                                        <?php
                                        echo $this->Html->link(__('ChemicalActionModes'), ['controller' => 'ChemicalActionModes', 'action' => 'index']);
                                        ?>
                                    </li>
                                    <?php endif; ?>

                                    <?php if ($canAccessApplicationSeasons): ?>
                                    <li class="<?= $controller == 'ApplicationSeasons' ? 'nav-active' : '' ?>">
                                        <?php
                                        echo $this->Html->link(__('ApplicationSeasons'), ['controller' => 'ApplicationSeasons', 'action' => 'index']);
                                        ?>
                                    </li>
                                    <?php endif; ?>

                                    <?php if ($canAccessChemicalNotes): ?>
                                    <li class="<?= $controller == 'ChemicalNotes' ? 'nav-active' : '' ?>">
                                        <?php
                                        echo $this->Html->link(__('ChemicalNotes'), ['controller' => 'ChemicalNotes', 'action' => 'index']);
                                        ?>
                                    </li>
                                    <?php endif; ?>
                                </ul>
                            </li>

                            <li class="nav-parent <?=in_array($controller, $childrenAdubos) ? 'nav-expanded' : ''?>">
                                <a href="#">
                                    Adubos
                                </a>
                                <ul class="nav nav-children">
                                
                                    <?php if ($canAccessFertilizerMeasureUnits): ?>
                                    <li class="<?= $controller == 'FertilizerMeasureUnits' ? 'nav-active' : '' ?>">
                                        <?php
                                        echo $this->Html->link(__('FertilizerMeasureUnits'), ['controller' => 'FertilizerMeasureUnits', 'action' => 'index']);
                                        ?>
                                    </li>
                                    <?php endif; ?>

                                    <?php if ($canAccessFertilizers): ?>
                                    <li class="<?= $controller == 'Fertilizers' ? 'nav-active' : '' ?>">
                                        <?php
                                        echo $this->Html->link(__('Fertilizers'), ['controller' => 'Fertilizers', 'action' => 'index']);
                                        ?>
                                    </li>
                                    <?php endif; ?>

                                </ul>
                            </li>

                            <li class="nav-parent <?=in_array($controller, $childrenOutros) ? 'nav-expanded' : ''?>">
                                <a href="#">
                                    Outros
                                </a>
                                <ul class="nav nav-children">
                                    <?php if ($canAccessRoles): ?>
                                    <li class="<?= $controller == 'Roles' ? 'nav-active' : '' ?>">
                                        <?php
                                        echo $this->Html->link(__('Roles'), ['controller' => 'Roles', 'action' => 'index']);
                                        ?>
                                    </li>
                                    <?php endif; ?>

                                    <?php if ($canAccessUsers): ?>
                                    <li class="<?= $controller == 'Users' ? 'nav-active' : '' ?>">
                                        <?php
                                        echo $this->Html->link(__('Users'), ['controller' => 'Users', 'action' => 'index']);
                                        ?>
                                    </li>
                                    <?php endif; ?>

                                    <?php if ($canAccessStates): ?>
                                    <li class="<?= $controller == 'States' ? 'nav-active' : '' ?>">
                                        <?php
                                        echo $this->Html->link(__('States'), ['controller' => 'States', 'action' => 'index']);
                                        ?>
                                    </li>
                                    <?php endif; ?>

                                    <?php if ($canAccessCities): ?>
                                    <li class="<?= $controller == 'Cities' ? 'nav-active' : '' ?>">
                                        <?php
                                        echo $this->Html->link(__('Cities'), ['controller' => 'Cities', 'action' => 'index']);
                                        ?>
                                    </li>
                                    <?php endif; ?>

                                    <?php if ($canAccessCultivationSystems): ?>
                                    <li class="<?= $controller == 'CultivationSystems' ? 'nav-active' : '' ?>">
                                        <?php
                                        echo $this->Html->link(__('CultivationSystems'), ['controller' => 'CultivationSystems', 'action' => 'index']);
                                        ?>
                                    </li>
                                    <?php endif; ?>

                                    <?php if ($canAccessMeasureUnits): ?>
                                    <li class="<?= $controller == 'MeasureUnits' ? 'nav-active' : '' ?>">
                                        <?php
                                        echo $this->Html->link(__('MeasureUnits'), ['controller' => 'MeasureUnits', 'action' => 'index']);
                                        ?>
                                    </li>
                                    <?php endif; ?>

                                    <?php if ($canAccessSupplierTypes): ?>
                                    <li class="<?= $controller == 'SupplierTypes' ? 'nav-active' : '' ?>">
                                        <?php
                                        echo $this->Html->link(__('Supplier Types'), ['controller' => 'SupplierTypes', 'action' => 'index']);
                                        ?>
                                    </li>
                                    <?php endif; ?>
                                </ul>
                            </li>
                        </ul>
                    </li>
                    
                    <?php
                    $childrenPlanejamento = ['Plans', 'SelectedSeeds', 'SelectedChemicals', 'SelectedFertilizers'];
                    ?>
                    <li class="nav-parent <?=in_array($controller, $childrenPlanejamento) ? 'nav-expanded' : ''?>">
                        <a href="#">
                            <i class="fa fa-tasks" aria-hidden="true"></i>
                            <span>Planejamento</span>
                        </a>
                        <ul class="nav nav-children">
                            <?php if ($canAccessPlans): ?>
                            <li class="<?= $controller == 'Plans' || $controller == 'SelectedSeeds' || $controller == 'SelectedChemicals' || $controller == 'SelectedFertilizers' ? 'nav-active' : '' ?>">
                                <?php
                                echo $this->Html->link(__('Plans'), ['controller' => 'Plans', 'action' => 'index']);
                                ?>
                            </li>
                            <?php endif; ?>

                            <li>
                                <?php
                                echo $this->Html->link(__('PlanFieldDetails'), ['controller' => 'PlanFieldDetails', 'action' => 'index']);
                                ?>
                            </li>
                        </ul>
                    </li>

                    <!--
                    <li class="nav-parent">
                        <a href="#">
                            <i class="fa fa-list-alt" aria-hidden="true"></i>
                            <span>Acompanhamento</span>
                        </a>
                        <ul class="nav nav-children">
                            <li>
                                <a href="#">
                                    Receita
                                </a>
                            </li>
                            <li>
                                <a href="#">
                                    Relatório
                                </a>
                            </li>
                        </ul>
                    </li>
                    -->
                </ul>
            </nav>
        </div>

        <script type="text/javascript">
            // Maintain Scroll Position
            if (typeof localStorage !== 'undefined') {
                if (localStorage.getItem('sidebar-left-position') !== null) {
                    var initialPosition = localStorage.getItem('sidebar-left-position'),
                        sidebarLeft = document.querySelector('#sidebar-left .nano-content');
                    
                    sidebarLeft.scrollTop = initialPosition;
                }
            }
        </script>
        

    </div>

</aside>