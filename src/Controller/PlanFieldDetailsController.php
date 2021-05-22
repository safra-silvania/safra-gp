<?php
declare(strict_types=1);

namespace App\Controller;

/**
 * @property \App\Model\Table\PlanFieldDetailsTable $PlanFieldDetails
 * @method \App\Model\Entity\PlanFieldDetail[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class PlanFieldDetailsController extends AppController
{
    public function beforeFilter(\Cake\Event\EventInterface $event)
    {
        parent::beforeFilter($event);

        $this->viewBuilder()->setLayout('admin');

        $this->set('crumbs', ['Cadastro', __('PlanFieldDetails')]);

        $this->set('canCreate', $this->userAuthenticated && $this->userAuthenticated->can('create', $this->PlanFieldDetails->newEmptyEntity()));
    }
    
    /**
     * @return \Cake\Http\Response|null|void Renders view
     */
    public function index()
    {
        if (!$this->userAuthenticated->can('access', $this->PlanFieldDetails->newEmptyEntity())) {
            $this->Flash->error('Permissão negada!');
            return $this->redirect(['controller' => 'dashboard', 'action' => 'index']);
        }

        $this->paginate = [
            'contain' => ['FieldDetails', 'Plans', 'SelectedSeeds'],
        ];
        $planFieldDetails = $this->paginate($this->PlanFieldDetails);

        $this->set(compact('planFieldDetails'));
    }

    /**
     * @param string|null $id Plan Field Detail id.
     * @return \Cake\Http\Response|null|void Renders view
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $planFieldDetail = $this->PlanFieldDetails->get($id, [
            'contain' => ['FieldDetails', 'Plans', 'SelectedSeeds'],
        ]);

        if (!$this->userAuthenticated->can('view', $planFieldDetail)) {
            $this->Flash->error('Permissão negada!');
            return $this->redirect($this->referer());
        }

        $this->set('planFieldDetail', $planFieldDetail);
    }

    /**
     * @return \Cake\Http\Response|null|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $planFieldDetail = $this->PlanFieldDetails->newEmptyEntity();

        if (!$this->userAuthenticated->can('create', $planFieldDetail)) {
            $this->Flash->error('Permissão negada!');
            return $this->redirect(['action' => 'index']);
        }
        
        if ($this->request->is('post')) {
            $planFieldDetail = $this->PlanFieldDetails->patchEntity($planFieldDetail, $this->request->getData());
            
            if ($this->PlanFieldDetails->save($planFieldDetail)) {
                $this->Flash->success('Inclusão realizada com sucesso');

                return $this->redirect(['action' => 'index']);
            }

            if (count($planFieldDetail->getErrors()) > 0) {
                foreach ($planFieldDetail->getErrors() as $error) {
                    foreach ($error as $message) {
                        $this->Flash->error($message);
                    }
                }
            } else {
                $this->Flash->error('Erro na inclusão de ' . __('Plan Field Detail') . '. Por favor, tente novamente');
            }
        }

        $fieldDetails = $this->PlanFieldDetails->FieldDetails->find('list', ['limit' => 200]);
        $plans = $this->PlanFieldDetails->Plans->find('list', ['limit' => 200]);
        $selectedSeeds = $this->PlanFieldDetails->SelectedSeeds->find('list', ['limit' => 200]);
        $this->set(compact('planFieldDetail', 'fieldDetails', 'plans', 'selectedSeeds'));
    }

    /**
     * @param string|null $id Plan Field Detail id.
     * @return \Cake\Http\Response|null|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $planFieldDetail = $this->PlanFieldDetails->get($id, [
            'contain' => [],
        ]);

        if (!$this->userAuthenticated->can('update', $planFieldDetail)) {
            $this->Flash->error('Permissão negada!');
            return $this->redirect(['action' => 'index']);
        }

        if ($this->request->is(['patch', 'post', 'put'])) {
            $planFieldDetail = $this->PlanFieldDetails->patchEntity($planFieldDetail, $this->request->getData());
            
            if ($this->PlanFieldDetails->save($planFieldDetail)) {
                $this->Flash->success('Edição realizada com sucesso');

                return $this->redirect(['action' => 'index']);
            }

            if (count($planFieldDetail->getErrors()) > 0) {
                foreach ($planFieldDetail->getErrors() as $error) {
                    foreach ($error as $message) {
                        $this->Flash->error($message);
                    }
                }
            } else {
                $this->Flash->error('Erro na edição de ' . __('Plan Field Detail') . '. Por favor, tente novamente');
            }
        }
        
        $fieldDetails = $this->PlanFieldDetails->FieldDetails->find('list', ['limit' => 200]);
        $plans = $this->PlanFieldDetails->Plans->find('list', ['limit' => 200]);
        $selectedSeeds = $this->PlanFieldDetails->SelectedSeeds->find('list', ['limit' => 200]);
        $this->set(compact('planFieldDetail', 'fieldDetails', 'plans', 'selectedSeeds'));
    }

    /**
     * @param string|null $id Plan Field Detail id.
     * @return \Cake\Http\Response|null|void Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $planFieldDetail = $this->PlanFieldDetails->get($id);

        if (!$this->userAuthenticated->can('delete', $planFieldDetail)) {
            $this->Flash->error('Permissão negada!');
            return $this->redirect(['action' => 'index']);
        }

        if ($this->PlanFieldDetails->delete($planFieldDetail))
            $this->Flash->success('Exclusão realizada com sucesso');
        else {
            if (count($planFieldDetail->getErrors()) > 0) {
                foreach ($planFieldDetail->getErrors() as $error) {
                    foreach ($error as $message) {
                        $this->Flash->error($message);
                    }
                }
            } else {
                $this->Flash->error('Erro na exclusão de ' . __('Plan Field Detail') . '. Por favor, tente novamente');
            }
        }

        return $this->redirect(['action' => 'index']);
    }
}
