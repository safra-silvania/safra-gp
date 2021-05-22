<?php
declare(strict_types=1);

namespace App\Controller;

use App\Model\Enum;

/**
 * @property \App\Model\Table\PlansTable $Plans
 * @method \App\Model\Entity\Plan[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class PlansController extends AppController
{
    public function beforeFilter(\Cake\Event\EventInterface $event)
    {
        parent::beforeFilter($event);

        $this->viewBuilder()->setLayout('admin');

        $this->set('crumbs', ['Planejamento']);

        $this->set('canCreate', $this->userAuthenticated && $this->userAuthenticated->can('create', $this->Plans->newEmptyEntity()));
        
        $this->loadModel('PlanFieldDetails');
        $this->loadModel('SelectedSeeds');
    }
    
    /**
     * @return \Cake\Http\Response|null|void Renders view
     */
    public function index()
    {
        if (!$this->userAuthenticated->can('access', $this->Plans->newEmptyEntity())) {
            $this->Flash->error('Permissão negada!');
            return $this->redirect(['controller' => 'dashboard', 'action' => 'index']);
        }

        $this->paginate = [
            'contain' => ['Immobiles' => ['Producers'], 'PlanStatuses', 'SelectedSeeds', 'SelectedChemicals', 'SelectedFertilizers'],
        ];
        $plans = $this->paginate($this->Plans);

        $this->set(compact('plans'));
    }

    public function startPlanning($immobileId = null)
    {
        if (!$immobileId) {
            $this->Flash->error('Imóvel não encontrado');
            return $this->redirect(['action' => 'index']);
        }

        $plan = $this->Plans->find()
            ->where([
                'immobile_id' => $immobileId,
                'plan_status_id' => Enum\PlanStatusEnum::Vigente
            ])
            ->contain(['SelectedSeeds', 'SelectedChemicals', 'SelectedFertilizers'])
            ->order(['Plans.id' => 'ASC'])
            ->last();

        if ($plan) {
            return $this->redirect(['controller' => 'SelectedSeeds', 'action' => 'index', $plan->id]);
        } else {

            try {
                $plan = $this->Plans->startPlanning($immobileId);
            } catch (\Exception $e) {
                $this->Flash->error($e->getMessage());
                return $this->redirect($this->referer());
            }

            if ($plan) {
                return $this->redirect(['controller' => 'SelectedSeeds', 'action' => 'index', $plan->id]);
            } else {
                if (count($plan->getErrors()) > 0) {
                    foreach ($plan->getErrors() as $error) {
                        foreach ($error as $message) {
                            $this->Flash->error($message);
                        }
                    }
                } else {
                    $this->Flash->error('Erro na iniciação do Planejamento. Por favor, tente novamente');
                    return $this->redirect($this->referer());
                }
            }
        }
    }

    public function getSelectedSeeds($planId)
    {
        $data = $this->Seeds->find('all')
            ->contain([
                'SeedNotes', 'Cultures', 'Varieties', 'Technologies', 'Cycles', 'Fertilities',
                'Cities', 'ZoningRegions', 'Suppliers',
                'SelectedSeeds' => function ($q) use ($planId) {
                    return $q->where(['SelectedSeeds.plan_id' => $planId]);
                }
            ]);

        // Set the view vars that have to be serialized.
        $this->set(compact('data'));

        // Specify which view vars JsonView should serialize.
        $this->viewBuilder()->setOption('serialize', ['data']);
    }

    public function getSelectedChemicals($planId)
    {
        $data = $this->Chemicals->find('all')
            ->contain([
                'ChemicalNotes', 'ChemicalClasses', 'ChemicalTargets', 'ChemicalMeasureUnits',
                'ChemicalGroups', 'ChemicalActionModes', 'Cultures', 'ApplicationSeasons', 'Suppliers',
                'SelectedChemicals' => function ($q) use ($planId) {
                    return $q->where(['SelectedChemicals.plan_id' => $planId]);
                }
            ]);

        // Set the view vars that have to be serialized.
        $this->set(compact('data'));

        // Specify which view vars JsonView should serialize.
        $this->viewBuilder()->setOption('serialize', ['data']);
    }

    /**
     * @return \Cake\Http\Response|null|void Redirects on successful add, renders view otherwise.
     */
    public function planningOrder($planId = null)
    {
        $this->set('crumbs', ['Planejamento', 'Sequência de Plantio']);

        $plan = $this->Plans->get($planId);

        $seedsContain = [
            'SeedNotes', 'Cultures', 'Varieties', 'Technologies', 'Cycles', 'Fertilities',
            'Cities', 'ZoningRegions', 'Suppliers'
        ];

        $selectedSeeds = $this->SelectedSeeds->find('all')
            ->where(['plan_id' => $planId])
            ->contain(['Seeds' => $seedsContain])
            ->order(['Seeds.id' => "ASC"]);

        $this->set(compact('plan', 'selectedSeeds'));
    }

    public function getPlanningData($planId)
    {
        $this->viewBuilder()->setLayout('ajax');
        $this->request->allowMethod(['get']);

        $data = $this->Plans->PlanFieldDetails->find('all')
            ->leftJoinWith('SelectedSeeds')
            ->where(['PlanFieldDetails.plan_id' => $planId])
            ->contain([
                'SelectedSeeds' => ['Seeds' => ['Varieties', 'Technologies', 'Cycles']],
                'FieldDetails' => [
                    'Cultures',
                    'MeasureUnits',
                    'Fertilities',
                    'Fields' => [
                        'MeasureUnits'
                    ]
                ]
            ])
            ->order(['PlanFieldDetails.sequence' => 'ASC']);

        // Set the view vars that have to be serialized.
        $this->set(compact('data'));

        // Specify which view vars JsonView should serialize.
        $this->viewBuilder()->setOption('serialize', ['data']);
    }

    public function reorder($id)
    {
        $this->viewBuilder()->setLayout('ajax');
        $this->request->allowMethod(['post']);

        $operation = $this->request->getData('operation');
        $index = $this->request->getData('index');
        
        $detail = $this->PlanFieldDetails->get($id);

        if ($operation == "up") {
            
            $prev = $this->PlanFieldDetails->find()
                ->where([
                    'PlanFieldDetails.plan_id' => $detail->plan_id,
                    'PlanFieldDetails.sequence' => $detail->sequence - 1
                ])->first();

            if ($prev) {
                $prev->sequence++;
                $this->PlanFieldDetails->id = $prev->id;
                $this->PlanFieldDetails->save($prev);
            }

            $detail->sequence--;

        } else if ($operation == "down") {
            
            $next = $this->PlanFieldDetails->find()
                ->where([
                    'PlanFieldDetails.plan_id' => $detail->plan_id,
                    'PlanFieldDetails.sequence' => $detail->sequence + 1
                ])->first();

            if ($next) {
                $next->sequence--;
                $this->PlanFieldDetails->id = $next->id;
                $this->PlanFieldDetails->save($next);
            }

            $detail->sequence++;
        }

        $this->PlanFieldDetails->id = $detail->id;
        $this->PlanFieldDetails->save($detail);

        $data = [];

        // Set the view vars that have to be serialized.
        $this->set(compact('data'));

        // Specify which view vars JsonView should serialize.
        $this->viewBuilder()->setOption('serialize', ['data']);
    }

    public function updateDetailPopulation($id)
    {
        $this->viewBuilder()->setLayout('ajax');
        $this->request->allowMethod(['post']);

        $detailId = $this->request->getData('detailId');
        $population = $this->request->getData('population');
        
        $detail = $this->PlanFieldDetails->get($detailId);
        $detail->population = $population;
        
        $this->PlanFieldDetails->save($detail);

        $data = [];
        $this->set(compact('data'));
        $this->viewBuilder()->setOption('serialize', ['data']);
    }

    public function bindDetailToSelectedSeed($id)
    {
        $this->viewBuilder()->setLayout('ajax');
        $this->request->allowMethod(['post']);

        $detailId = $this->request->getData('detailId');
        $selectedSeedId = $this->request->getData('selectedSeedId');
        
        $plan = $this->Plans->get($id);
        $detail = $this->PlanFieldDetails->get($detailId);

        if ($selectedSeedId) {
            $selectedSeed = $this->SelectedSeeds->get($selectedSeedId, ['contain' => 'Seeds']);
            
            $detail->selected_seed_id = $selectedSeedId;
            $detail->population = $selectedSeed->seed->population;
        } else {
            $detail->selected_seed_id = null;
            $detail->population = "";
        }
        
        $this->PlanFieldDetails->save($detail);

        $data = [];

        $this->set(compact('data'));
        $this->viewBuilder()->setOption('serialize', ['data']);
    }

    /**
     * @param string|null $id Plan id.
     * @return \Cake\Http\Response|null|void Renders view
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $plan = $this->Plans->get($id, [
            'contain' => ['Immobiles', 'PlanStatuses', 'PlanFieldDetails', 'SelectedChemicals', 'SelectedFertilizers', 'SelectedSeeds'],
        ]);

        if (!$this->userAuthenticated->can('view', $plan)) {
            $this->Flash->error('Permissão negada!');
            return $this->redirect($this->referer());
        }

        $this->set('plan', $plan);
    }

    /**
     * @return \Cake\Http\Response|null|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $plan = $this->Plans->newEmptyEntity();

        if (!$this->userAuthenticated->can('create', $plan)) {
            $this->Flash->error('Permissão negada!');
            return $this->redirect(['action' => 'index']);
        }
        
        if ($this->request->is('post')) {
            $plan = $this->Plans->patchEntity($plan, $this->request->getData());
            
            if ($this->Plans->save($plan)) {
                $this->Flash->success('Inclusão realizada com sucesso');

                return $this->redirect(['action' => 'index']);
            }

            if (count($plan->getErrors()) > 0) {
                foreach ($plan->getErrors() as $error) {
                    foreach ($error as $message) {
                        $this->Flash->error($message);
                    }
                }
            } else {
                $this->Flash->error('Erro na inclusão de ' . __('Plan') . '. Por favor, tente novamente');
            }
        }

        $immobiles = $this->Plans->Immobiles->find('list', ['limit' => 200]);
        $planStatuses = $this->Plans->PlanStatuses->find('list', ['limit' => 200]);
        $this->set(compact('plan', 'immobiles', 'planStatuses'));
    }

    /**
     * @param string|null $id Plan id.
     * @return \Cake\Http\Response|null|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $plan = $this->Plans->get($id, [
            'contain' => [],
        ]);

        if (!$this->userAuthenticated->can('update', $plan)) {
            $this->Flash->error('Permissão negada!');
            return $this->redirect(['action' => 'index']);
        }

        if ($this->request->is(['patch', 'post', 'put'])) {
            $plan = $this->Plans->patchEntity($plan, $this->request->getData());
            
            if ($this->Plans->save($plan)) {
                $this->Flash->success('Edição realizada com sucesso');

                return $this->redirect(['action' => 'index']);
            }

            if (count($plan->getErrors()) > 0) {
                foreach ($plan->getErrors() as $error) {
                    foreach ($error as $message) {
                        $this->Flash->error($message);
                    }
                }
            } else {
                $this->Flash->error('Erro na edição de ' . __('Plan') . '. Por favor, tente novamente');
            }
        }
        
        $immobiles = $this->Plans->Immobiles->find('list', ['limit' => 200]);
        $planStatuses = $this->Plans->PlanStatuses->find('list', ['limit' => 200]);
        $this->set(compact('plan', 'immobiles', 'planStatuses'));
    }

    /**
     * @param string|null $id Plan id.
     * @return \Cake\Http\Response|null|void Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $plan = $this->Plans->get($id);

        if (!$this->userAuthenticated->can('delete', $plan)) {
            $this->Flash->error('Permissão negada!');
            return $this->redirect(['action' => 'index']);
        }

        if ($this->Plans->delete($plan))
            $this->Flash->success('Exclusão realizada com sucesso');
        else {
            if (count($plan->getErrors()) > 0) {
                foreach ($plan->getErrors() as $error) {
                    foreach ($error as $message) {
                        $this->Flash->error($message);
                    }
                }
            } else {
                $this->Flash->error('Erro na exclusão de ' . __('Plan') . '. Por favor, tente novamente');
            }
        }

        return $this->redirect(['action' => 'index']);
    }
}
