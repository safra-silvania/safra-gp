<?php
declare(strict_types=1);

namespace App\Controller;

/**
 * @property \App\Model\Table\SelectedSeedsTable $SelectedSeeds
 * @method \App\Model\Entity\SelectedSeed[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class SelectedSeedsController extends AppController
{
    public function beforeFilter(\Cake\Event\EventInterface $event)
    {
        parent::beforeFilter($event);

        $this->viewBuilder()->setLayout('admin');

        $this->set('crumbs', ['Planejamento', __('SelectedSeeds')]);

        $this->set('canCreate', $this->userAuthenticated && $this->userAuthenticated->can('create', $this->SelectedSeeds->newEmptyEntity()));
    }
    
    /**
     * @return \Cake\Http\Response|null|void Renders view
     */
    public function index($planId)
    {
        $plan = $this->Plans->get($planId, [
            'contain' => ['Immobiles' => ['Producers']],
        ]);

        $this->set(compact('plan'));
    }

    public function selectSeed()
    {
        $this->viewBuilder()->setLayout('ajax');
        $this->request->allowMethod(['post']);

        $planId = $this->request->getData('planId');
        $seedId = $this->request->getData('seedId');

        $selectedSeed = $this->SelectedSeeds->find()
            ->where([
                'SelectedSeeds.plan_id' => $planId,
                'SelectedSeeds.seed_id' => $seedId
            ])->first();

        $data = ['sucesso'];
        if (!$selectedSeed) {
            $selectedSeed = $this->SelectedSeeds->newEmptyEntity();
            $selectedSeed = $this->SelectedSeeds->patchEntity($selectedSeed, [
                'plan_id' => $planId,
                'seed_id' => $seedId
            ]);

            if (!$this->SelectedSeeds->save($selectedSeed))
                $data = ['erro'];
        }
        
        $this->set(compact('data'));
        $this->viewBuilder()->setOption('serialize', ['data']);
    }

    public function unselectSeed()
    {
        $this->viewBuilder()->setLayout('ajax');
        $this->request->allowMethod(['post']);

        $planId = $this->request->getData('planId');
        $seedId = $this->request->getData('seedId');

        $selectedSeed = $this->SelectedSeeds->find()
            ->where([
                'SelectedSeeds.plan_id' => $planId,
                'SelectedSeeds.seed_id' => $seedId
            ])->first();

        $data = ['sucesso'];
        if ($selectedSeed) {
            if (!$this->SelectedSeeds->delete($selectedSeed))
                $data = ['erro'];
        }
        
        $this->set(compact('data'));
        $this->viewBuilder()->setOption('serialize', ['data']);
    }

    /**
     * @param string|null $id Selected Seed id.
     * @return \Cake\Http\Response|null|void Renders view
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $selectedSeed = $this->SelectedSeeds->get($id, [
            'contain' => ['Seeds', 'Plans', 'PlanFieldDetails'],
        ]);

        if (!$this->userAuthenticated->can('view', $selectedSeed)) {
            $this->Flash->error('Permissão negada!');
            return $this->redirect($this->referer());
        }

        $this->set('selectedSeed', $selectedSeed);
    }

    /**
     * @return \Cake\Http\Response|null|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $selectedSeed = $this->SelectedSeeds->newEmptyEntity();

        if (!$this->userAuthenticated->can('create', $selectedSeed)) {
            $this->Flash->error('Permissão negada!');
            return $this->redirect(['action' => 'index']);
        }
        
        if ($this->request->is('post')) {
            $selectedSeed = $this->SelectedSeeds->patchEntity($selectedSeed, $this->request->getData());
            
            if ($this->SelectedSeeds->save($selectedSeed)) {
                $this->Flash->success('Inclusão realizada com sucesso');

                return $this->redirect(['action' => 'index']);
            }

            if (count($selectedSeed->getErrors()) > 0) {
                foreach ($selectedSeed->getErrors() as $error) {
                    foreach ($error as $message) {
                        $this->Flash->error($message);
                    }
                }
            } else {
                $this->Flash->error('Erro na inclusão de ' . __('Selected Seed') . '. Por favor, tente novamente');
            }
        }

        $seeds = $this->SelectedSeeds->Seeds->find('list', ['limit' => 200]);
        $plans = $this->SelectedSeeds->Plans->find('list', ['limit' => 200]);
        $this->set(compact('selectedSeed', 'seeds', 'plans'));
    }

    /**
     * @param string|null $id Selected Seed id.
     * @return \Cake\Http\Response|null|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $selectedSeed = $this->SelectedSeeds->get($id, [
            'contain' => [],
        ]);

        if (!$this->userAuthenticated->can('update', $selectedSeed)) {
            $this->Flash->error('Permissão negada!');
            return $this->redirect(['action' => 'index']);
        }

        if ($this->request->is(['patch', 'post', 'put'])) {
            $selectedSeed = $this->SelectedSeeds->patchEntity($selectedSeed, $this->request->getData());
            
            if ($this->SelectedSeeds->save($selectedSeed)) {
                $this->Flash->success('Edição realizada com sucesso');

                return $this->redirect(['action' => 'index']);
            }

            if (count($selectedSeed->getErrors()) > 0) {
                foreach ($selectedSeed->getErrors() as $error) {
                    foreach ($error as $message) {
                        $this->Flash->error($message);
                    }
                }
            } else {
                $this->Flash->error('Erro na edição de ' . __('Selected Seed') . '. Por favor, tente novamente');
            }
        }
        
        $seeds = $this->SelectedSeeds->Seeds->find('list', ['limit' => 200]);
        $plans = $this->SelectedSeeds->Plans->find('list', ['limit' => 200]);
        $this->set(compact('selectedSeed', 'seeds', 'plans'));
    }

    /**
     * @param string|null $id Selected Seed id.
     * @return \Cake\Http\Response|null|void Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $selectedSeed = $this->SelectedSeeds->get($id);

        if (!$this->userAuthenticated->can('delete', $selectedSeed)) {
            $this->Flash->error('Permissão negada!');
            return $this->redirect(['action' => 'index']);
        }

        if ($this->SelectedSeeds->delete($selectedSeed))
            $this->Flash->success('Exclusão realizada com sucesso');
        else {
            if (count($selectedSeed->getErrors()) > 0) {
                foreach ($selectedSeed->getErrors() as $error) {
                    foreach ($error as $message) {
                        $this->Flash->error($message);
                    }
                }
            } else {
                $this->Flash->error('Erro na exclusão de ' . __('Selected Seed') . '. Por favor, tente novamente');
            }
        }

        return $this->redirect(['action' => 'index']);
    }
}
