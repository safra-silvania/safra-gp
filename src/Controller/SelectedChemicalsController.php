<?php
declare(strict_types=1);

namespace App\Controller;

/**
 * @property \App\Model\Table\SelectedChemicalsTable $SelectedChemicals
 * @method \App\Model\Entity\SelectedChemical[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class SelectedChemicalsController extends AppController
{
    public function beforeFilter(\Cake\Event\EventInterface $event)
    {
        parent::beforeFilter($event);

        $this->viewBuilder()->setLayout('admin');

        $this->set('crumbs', ['Cadastro', __('SelectedChemicals')]);

        $this->set('canCreate', $this->userAuthenticated && $this->userAuthenticated->can('create', $this->SelectedChemicals->newEmptyEntity()));
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

    public function selectChemical()
    {
        $this->viewBuilder()->setLayout('ajax');
        $this->request->allowMethod(['post']);

        $planId = $this->request->getData('planId');
        $chemicalId = $this->request->getData('chemicalId');

        $selectedChemical = $this->SelectedChemicals->find()
            ->where([
                'SelectedChemicals.plan_id' => $planId,
                'SelectedChemicals.chemical_id' => $chemicalId
            ])->first();

        $data = ['sucesso'];
        if (!$selectedChemical) {
            $selectedChemical = $this->SelectedChemicals->newEmptyEntity();
            $selectedChemical = $this->SelectedChemicals->patchEntity($selectedChemical, [
                'plan_id' => $planId,
                'chemical_id' => $chemicalId
            ]);

            if (!$this->SelectedChemicals->save($selectedChemical))
                $data = ['erro'];
        }
        
        $this->set(compact('data'));
        $this->viewBuilder()->setOption('serialize', ['data']);
    }

    public function unselectChemical()
    {
        $this->viewBuilder()->setLayout('ajax');
        $this->request->allowMethod(['post']);

        $planId = $this->request->getData('planId');
        $chemicalId = $this->request->getData('chemicalId');

        $selectedChemical = $this->SelectedChemicals->find()
            ->where([
                'SelectedChemicals.plan_id' => $planId,
                'SelectedChemicals.chemical_id' => $chemicalId
            ])->first();

        $data = ['sucesso'];
        if ($selectedChemical) {
            if (!$this->SelectedChemicals->delete($selectedChemical))
                $data = ['erro'];
        }
        
        $this->set(compact('data'));
        $this->viewBuilder()->setOption('serialize', ['data']);
    }

    /**
     * @param string|null $id Selected Chemical id.
     * @return \Cake\Http\Response|null|void Renders view
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $selectedChemical = $this->SelectedChemicals->get($id, [
            'contain' => ['Chemicals', 'Plans'],
        ]);

        if (!$this->userAuthenticated->can('view', $selectedChemical)) {
            $this->Flash->error('Permissão negada!');
            return $this->redirect($this->referer());
        }

        $this->set('selectedChemical', $selectedChemical);
    }

    /**
     * @return \Cake\Http\Response|null|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $selectedChemical = $this->SelectedChemicals->newEmptyEntity();

        if (!$this->userAuthenticated->can('create', $selectedChemical)) {
            $this->Flash->error('Permissão negada!');
            return $this->redirect(['action' => 'index']);
        }
        
        if ($this->request->is('post')) {
            $selectedChemical = $this->SelectedChemicals->patchEntity($selectedChemical, $this->request->getData());
            
            if ($this->SelectedChemicals->save($selectedChemical)) {
                $this->Flash->success('Inclusão realizada com sucesso');

                return $this->redirect(['action' => 'index']);
            }

            if (count($selectedChemical->getErrors()) > 0) {
                foreach ($selectedChemical->getErrors() as $error) {
                    foreach ($error as $message) {
                        $this->Flash->error($message);
                    }
                }
            } else {
                $this->Flash->error('Erro na inclusão de ' . __('Selected Chemical') . '. Por favor, tente novamente');
            }
        }

        $chemicals = $this->SelectedChemicals->Chemicals->find('list', ['limit' => 200]);
        $plans = $this->SelectedChemicals->Plans->find('list', ['limit' => 200]);
        $this->set(compact('selectedChemical', 'chemicals', 'plans'));
    }

    /**
     * @param string|null $id Selected Chemical id.
     * @return \Cake\Http\Response|null|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $selectedChemical = $this->SelectedChemicals->get($id, [
            'contain' => [],
        ]);

        if (!$this->userAuthenticated->can('update', $selectedChemical)) {
            $this->Flash->error('Permissão negada!');
            return $this->redirect(['action' => 'index']);
        }

        if ($this->request->is(['patch', 'post', 'put'])) {
            $selectedChemical = $this->SelectedChemicals->patchEntity($selectedChemical, $this->request->getData());
            
            if ($this->SelectedChemicals->save($selectedChemical)) {
                $this->Flash->success('Edição realizada com sucesso');

                return $this->redirect(['action' => 'index']);
            }

            if (count($selectedChemical->getErrors()) > 0) {
                foreach ($selectedChemical->getErrors() as $error) {
                    foreach ($error as $message) {
                        $this->Flash->error($message);
                    }
                }
            } else {
                $this->Flash->error('Erro na edição de ' . __('Selected Chemical') . '. Por favor, tente novamente');
            }
        }
        
        $chemicals = $this->SelectedChemicals->Chemicals->find('list', ['limit' => 200]);
        $plans = $this->SelectedChemicals->Plans->find('list', ['limit' => 200]);
        $this->set(compact('selectedChemical', 'chemicals', 'plans'));
    }

    /**
     * @param string|null $id Selected Chemical id.
     * @return \Cake\Http\Response|null|void Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $selectedChemical = $this->SelectedChemicals->get($id);

        if (!$this->userAuthenticated->can('delete', $selectedChemical)) {
            $this->Flash->error('Permissão negada!');
            return $this->redirect(['action' => 'index']);
        }

        if ($this->SelectedChemicals->delete($selectedChemical))
            $this->Flash->success('Exclusão realizada com sucesso');
        else {
            if (count($selectedChemical->getErrors()) > 0) {
                foreach ($selectedChemical->getErrors() as $error) {
                    foreach ($error as $message) {
                        $this->Flash->error($message);
                    }
                }
            } else {
                $this->Flash->error('Erro na exclusão de ' . __('Selected Chemical') . '. Por favor, tente novamente');
            }
        }

        return $this->redirect(['action' => 'index']);
    }
}
