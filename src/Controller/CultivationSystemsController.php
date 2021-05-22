<?php
declare(strict_types=1);

namespace App\Controller;

/**
 * @property \App\Model\Table\CultivationSystemsTable $CultivationSystems
 * @method \App\Model\Entity\CultivationSystem[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class CultivationSystemsController extends AppController
{
    public function beforeFilter(\Cake\Event\EventInterface $event)
    {
        parent::beforeFilter($event);

        $this->viewBuilder()->setLayout('admin');

        $this->set('crumbs', ['Cadastro', 'Outros', __('CultivationSystems')]);

        $this->set('canCreate', $this->userAuthenticated && $this->userAuthenticated->can('create', $this->CultivationSystems->newEmptyEntity()));
    }
    
    /**
     * @return \Cake\Http\Response|null|void Renders view
     */
    public function index()
    {
        if (!$this->userAuthenticated->can('access', $this->CultivationSystems->newEmptyEntity())) {
            $this->Flash->error('Permissão negada!');
            return $this->redirect(['controller' => 'dashboard', 'action' => 'index']);
        }

        $cultivationSystems = $this->paginate($this->CultivationSystems);

        $this->set(compact('cultivationSystems'));
    }

    /**
     * @param string|null $id Cultivation System id.
     * @return \Cake\Http\Response|null|void Renders view
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $cultivationSystem = $this->CultivationSystems->get($id, [
            'contain' => ['Fields'],
        ]);

        if (!$this->userAuthenticated->can('view', $cultivationSystem)) {
            $this->Flash->error('Permissão negada!');
            return $this->redirect($this->referer());
        }

        $this->set('cultivationSystem', $cultivationSystem);
    }

    /**
     * @return \Cake\Http\Response|null|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $cultivationSystem = $this->CultivationSystems->newEmptyEntity();

        if (!$this->userAuthenticated->can('create', $cultivationSystem)) {
            $this->Flash->error('Permissão negada!');
            return $this->redirect(['action' => 'index']);
        }
        
        if ($this->request->is('post')) {
            $cultivationSystem = $this->CultivationSystems->patchEntity($cultivationSystem, $this->request->getData());
            
            if ($this->CultivationSystems->save($cultivationSystem)) {
                $this->Flash->success('Inclusão realizada com sucesso');

                return $this->redirect(['action' => 'index']);
            }

            if (count($cultivationSystem->getErrors()) > 0) {
                foreach ($cultivationSystem->getErrors() as $error) {
                    foreach ($error as $message) {
                        $this->Flash->error($message);
                    }
                }
            } else {
                $this->Flash->error('Erro na inclusão de ' . __('Cultivation System') . '. Por favor, tente novamente');
            }
        }

        $this->set(compact('cultivationSystem'));
    }

    /**
     * @param string|null $id Cultivation System id.
     * @return \Cake\Http\Response|null|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $cultivationSystem = $this->CultivationSystems->get($id, [
            'contain' => [],
        ]);

        if (!$this->userAuthenticated->can('update', $cultivationSystem)) {
            $this->Flash->error('Permissão negada!');
            return $this->redirect(['action' => 'index']);
        }

        if ($this->request->is(['patch', 'post', 'put'])) {
            $cultivationSystem = $this->CultivationSystems->patchEntity($cultivationSystem, $this->request->getData());
            
            if ($this->CultivationSystems->save($cultivationSystem)) {
                $this->Flash->success('Edição realizada com sucesso');

                return $this->redirect(['action' => 'index']);
            }

            if (count($cultivationSystem->getErrors()) > 0) {
                foreach ($cultivationSystem->getErrors() as $error) {
                    foreach ($error as $message) {
                        $this->Flash->error($message);
                    }
                }
            } else {
                $this->Flash->error('Erro na edição de ' . __('Cultivation System') . '. Por favor, tente novamente');
            }
        }
        
        $this->set(compact('cultivationSystem'));
    }

    /**
     * @param string|null $id Cultivation System id.
     * @return \Cake\Http\Response|null|void Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $cultivationSystem = $this->CultivationSystems->get($id);

        if (!$this->userAuthenticated->can('delete', $cultivationSystem)) {
            $this->Flash->error('Permissão negada!');
            return $this->redirect(['action' => 'index']);
        }

        if ($this->CultivationSystems->delete($cultivationSystem))
            $this->Flash->success('Exclusão realizada com sucesso');
        else {
            if (count($cultivationSystem->getErrors()) > 0) {
                foreach ($cultivationSystem->getErrors() as $error) {
                    foreach ($error as $message) {
                        $this->Flash->error($message);
                    }
                }
            } else {
                $this->Flash->error('Erro na exclusão de ' . __('Cultivation System') . '. Por favor, tente novamente');
            }
        }

        return $this->redirect(['action' => 'index']);
    }
}
