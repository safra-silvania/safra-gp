<?php
declare(strict_types=1);

namespace App\Controller;

/**
 * @property \App\Model\Table\SelectedFertilizersTable $SelectedFertilizers
 * @method \App\Model\Entity\SelectedFertilizer[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class SelectedFertilizersController extends AppController
{
    public function beforeFilter(\Cake\Event\EventInterface $event)
    {
        parent::beforeFilter($event);

        $this->viewBuilder()->setLayout('admin');

        $this->set('crumbs', ['Cadastro', __('SelectedFertilizers')]);

        $this->set('canCreate', $this->userAuthenticated && $this->userAuthenticated->can('create', $this->SelectedFertilizers->newEmptyEntity()));
    }
    
    /**
     * @return \Cake\Http\Response|null|void Renders view
     */
    public function index()
    {
        if (!$this->userAuthenticated->can('access', $this->SelectedFertilizers->newEmptyEntity())) {
            $this->Flash->error('Permissão negada!');
            return $this->redirect(['controller' => 'dashboard', 'action' => 'index']);
        }

        $this->paginate = [
            'contain' => ['Fertilizers', 'Plans'],
        ];
        $selectedFertilizers = $this->paginate($this->SelectedFertilizers);

        $this->set(compact('selectedFertilizers'));
    }

    /**
     * @param string|null $id Selected Fertilizer id.
     * @return \Cake\Http\Response|null|void Renders view
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $selectedFertilizer = $this->SelectedFertilizers->get($id, [
            'contain' => ['Fertilizers', 'Plans'],
        ]);

        if (!$this->userAuthenticated->can('view', $selectedFertilizer)) {
            $this->Flash->error('Permissão negada!');
            return $this->redirect($this->referer());
        }

        $this->set('selectedFertilizer', $selectedFertilizer);
    }

    /**
     * @return \Cake\Http\Response|null|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $selectedFertilizer = $this->SelectedFertilizers->newEmptyEntity();

        if (!$this->userAuthenticated->can('create', $selectedFertilizer)) {
            $this->Flash->error('Permissão negada!');
            return $this->redirect(['action' => 'index']);
        }
        
        if ($this->request->is('post')) {
            $selectedFertilizer = $this->SelectedFertilizers->patchEntity($selectedFertilizer, $this->request->getData());
            
            if ($this->SelectedFertilizers->save($selectedFertilizer)) {
                $this->Flash->success('Inclusão realizada com sucesso');

                return $this->redirect(['action' => 'index']);
            }

            if (count($selectedFertilizer->getErrors()) > 0) {
                foreach ($selectedFertilizer->getErrors() as $error) {
                    foreach ($error as $message) {
                        $this->Flash->error($message);
                    }
                }
            } else {
                $this->Flash->error('Erro na inclusão de ' . __('Selected Fertilizer') . '. Por favor, tente novamente');
            }
        }

        $fertilizers = $this->SelectedFertilizers->Fertilizers->find('list', ['limit' => 200]);
        $plans = $this->SelectedFertilizers->Plans->find('list', ['limit' => 200]);
        $this->set(compact('selectedFertilizer', 'fertilizers', 'plans'));
    }

    /**
     * @param string|null $id Selected Fertilizer id.
     * @return \Cake\Http\Response|null|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $selectedFertilizer = $this->SelectedFertilizers->get($id, [
            'contain' => [],
        ]);

        if (!$this->userAuthenticated->can('update', $selectedFertilizer)) {
            $this->Flash->error('Permissão negada!');
            return $this->redirect(['action' => 'index']);
        }

        if ($this->request->is(['patch', 'post', 'put'])) {
            $selectedFertilizer = $this->SelectedFertilizers->patchEntity($selectedFertilizer, $this->request->getData());
            
            if ($this->SelectedFertilizers->save($selectedFertilizer)) {
                $this->Flash->success('Edição realizada com sucesso');

                return $this->redirect(['action' => 'index']);
            }

            if (count($selectedFertilizer->getErrors()) > 0) {
                foreach ($selectedFertilizer->getErrors() as $error) {
                    foreach ($error as $message) {
                        $this->Flash->error($message);
                    }
                }
            } else {
                $this->Flash->error('Erro na edição de ' . __('Selected Fertilizer') . '. Por favor, tente novamente');
            }
        }
        
        $fertilizers = $this->SelectedFertilizers->Fertilizers->find('list', ['limit' => 200]);
        $plans = $this->SelectedFertilizers->Plans->find('list', ['limit' => 200]);
        $this->set(compact('selectedFertilizer', 'fertilizers', 'plans'));
    }

    /**
     * @param string|null $id Selected Fertilizer id.
     * @return \Cake\Http\Response|null|void Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $selectedFertilizer = $this->SelectedFertilizers->get($id);

        if (!$this->userAuthenticated->can('delete', $selectedFertilizer)) {
            $this->Flash->error('Permissão negada!');
            return $this->redirect(['action' => 'index']);
        }

        if ($this->SelectedFertilizers->delete($selectedFertilizer))
            $this->Flash->success('Exclusão realizada com sucesso');
        else {
            if (count($selectedFertilizer->getErrors()) > 0) {
                foreach ($selectedFertilizer->getErrors() as $error) {
                    foreach ($error as $message) {
                        $this->Flash->error($message);
                    }
                }
            } else {
                $this->Flash->error('Erro na exclusão de ' . __('Selected Fertilizer') . '. Por favor, tente novamente');
            }
        }

        return $this->redirect(['action' => 'index']);
    }
}
