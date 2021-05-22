<?php
declare(strict_types=1);

namespace App\Controller;

/**
 * @property \App\Model\Table\PlanStatusesTable $PlanStatuses
 * @method \App\Model\Entity\PlanStatus[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class PlanStatusesController extends AppController
{
    public function beforeFilter(\Cake\Event\EventInterface $event)
    {
        parent::beforeFilter($event);

        $this->viewBuilder()->setLayout('admin');

        $this->set('crumbs', ['Cadastro', __('PlanStatuses')]);

        $this->set('canCreate', $this->userAuthenticated && $this->userAuthenticated->can('create', $this->PlanStatuses->newEmptyEntity()));
    }
    
    /**
     * @return \Cake\Http\Response|null|void Renders view
     */
    public function index()
    {
        if (!$this->userAuthenticated->can('access', $this->PlanStatuses->newEmptyEntity())) {
            $this->Flash->error('Permissão negada!');
            return $this->redirect(['controller' => 'dashboard', 'action' => 'index']);
        }

        $planStatuses = $this->paginate($this->PlanStatuses);

        $this->set(compact('planStatuses'));
    }

    /**
     * @param string|null $id Plan Status id.
     * @return \Cake\Http\Response|null|void Renders view
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $planStatus = $this->PlanStatuses->get($id, [
            'contain' => ['Plans'],
        ]);

        if (!$this->userAuthenticated->can('view', $planStatus)) {
            $this->Flash->error('Permissão negada!');
            return $this->redirect($this->referer());
        }

        $this->set('planStatus', $planStatus);
    }

    /**
     * @return \Cake\Http\Response|null|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $planStatus = $this->PlanStatuses->newEmptyEntity();

        if (!$this->userAuthenticated->can('create', $planStatus)) {
            $this->Flash->error('Permissão negada!');
            return $this->redirect(['action' => 'index']);
        }
        
        if ($this->request->is('post')) {
            $planStatus = $this->PlanStatuses->patchEntity($planStatus, $this->request->getData());
            
            if ($this->PlanStatuses->save($planStatus)) {
                $this->Flash->success('Inclusão realizada com sucesso');

                return $this->redirect(['action' => 'index']);
            }

            if (count($planStatus->getErrors()) > 0) {
                foreach ($planStatus->getErrors() as $error) {
                    foreach ($error as $message) {
                        $this->Flash->error($message);
                    }
                }
            } else {
                $this->Flash->error('Erro na inclusão de ' . __('Plan Status') . '. Por favor, tente novamente');
            }
        }

        $this->set(compact('planStatus'));
    }

    /**
     * @param string|null $id Plan Status id.
     * @return \Cake\Http\Response|null|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $planStatus = $this->PlanStatuses->get($id, [
            'contain' => [],
        ]);

        if (!$this->userAuthenticated->can('update', $planStatus)) {
            $this->Flash->error('Permissão negada!');
            return $this->redirect(['action' => 'index']);
        }

        if ($this->request->is(['patch', 'post', 'put'])) {
            $planStatus = $this->PlanStatuses->patchEntity($planStatus, $this->request->getData());
            
            if ($this->PlanStatuses->save($planStatus)) {
                $this->Flash->success('Edição realizada com sucesso');

                return $this->redirect(['action' => 'index']);
            }

            if (count($planStatus->getErrors()) > 0) {
                foreach ($planStatus->getErrors() as $error) {
                    foreach ($error as $message) {
                        $this->Flash->error($message);
                    }
                }
            } else {
                $this->Flash->error('Erro na edição de ' . __('Plan Status') . '. Por favor, tente novamente');
            }
        }
        
        $this->set(compact('planStatus'));
    }

    /**
     * @param string|null $id Plan Status id.
     * @return \Cake\Http\Response|null|void Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $planStatus = $this->PlanStatuses->get($id);

        if (!$this->userAuthenticated->can('delete', $planStatus)) {
            $this->Flash->error('Permissão negada!');
            return $this->redirect(['action' => 'index']);
        }

        if ($this->PlanStatuses->delete($planStatus))
            $this->Flash->success('Exclusão realizada com sucesso');
        else {
            if (count($planStatus->getErrors()) > 0) {
                foreach ($planStatus->getErrors() as $error) {
                    foreach ($error as $message) {
                        $this->Flash->error($message);
                    }
                }
            } else {
                $this->Flash->error('Erro na exclusão de ' . __('Plan Status') . '. Por favor, tente novamente');
            }
        }

        return $this->redirect(['action' => 'index']);
    }
}
