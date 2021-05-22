<?php
declare(strict_types=1);

namespace App\Controller;

/**
 * @property \App\Model\Table\ProducersTable $Producers
 * @method \App\Model\Entity\Producer[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class ProducersController extends AppController
{
    public function beforeFilter(\Cake\Event\EventInterface $event)
    {
        parent::beforeFilter($event);

        $this->viewBuilder()->setLayout('admin');

        $this->set('crumbs', ['Cadastro', __('Producers')]);

        $this->set('canCreate', $this->userAuthenticated && $this->userAuthenticated->can('create', $this->Producers->newEmptyEntity()));
    }
    
    /**
     * @return \Cake\Http\Response|null|void Renders view
     */
    public function index()
    {
        if (!$this->userAuthenticated->can('access', $this->Producers->newEmptyEntity())) {
            $this->Flash->error('Permissão negada!');
            return $this->redirect(['controller' => 'dashboard', 'action' => 'index']);
        }

        $this->paginate = [
            'contain' => ['Cities'],
        ];
        $producers = $this->paginate($this->Producers);

        $this->set(compact('producers'));
    }

    /**
     * @param string|null $id Producer id.
     * @return \Cake\Http\Response|null|void Renders view
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $producer = $this->Producers->get($id, [
            'contain' => ['Cities', 'Immobiles'],
        ]);

        if (!$this->userAuthenticated->can('view', $producer)) {
            $this->Flash->error('Permissão negada!');
            return $this->redirect($this->referer());
        }

        $this->set('producer', $producer);
    }

    /**
     * @return \Cake\Http\Response|null|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $producer = $this->Producers->newEmptyEntity();

        if (!$this->userAuthenticated->can('create', $producer)) {
            $this->Flash->error('Permissão negada!');
            return $this->redirect(['action' => 'index']);
        }
        
        if ($this->request->is('post')) {
            $producer = $this->Producers->patchEntity($producer, $this->request->getData());
            
            if ($this->Producers->save($producer)) {
                $this->Flash->success('Inclusão realizada com sucesso');

                return $this->redirect(['action' => 'index']);
            }

            if (count($producer->getErrors()) > 0) {
                foreach ($producer->getErrors() as $error) {
                    foreach ($error as $message) {
                        $this->Flash->error($message);
                    }
                }
            } else {
                $this->Flash->error('Erro na inclusão de ' . __('Producer') . '. Por favor, tente novamente');
            }
        }

        $cities = $this->Producers->Cities->find('list', ['limit' => 200]);
        $this->set(compact('producer', 'cities'));
    }

    /**
     * @param string|null $id Producer id.
     * @return \Cake\Http\Response|null|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $producer = $this->Producers->get($id, [
            'contain' => [],
        ]);

        if (!$this->userAuthenticated->can('update', $producer)) {
            $this->Flash->error('Permissão negada!');
            return $this->redirect(['action' => 'index']);
        }

        if ($this->request->is(['patch', 'post', 'put'])) {
            $producer = $this->Producers->patchEntity($producer, $this->request->getData());
            
            if ($this->Producers->save($producer)) {
                $this->Flash->success('Edição realizada com sucesso');

                return $this->redirect(['action' => 'index']);
            }

            if (count($producer->getErrors()) > 0) {
                foreach ($producer->getErrors() as $error) {
                    foreach ($error as $message) {
                        $this->Flash->error($message);
                    }
                }
            } else {
                $this->Flash->error('Erro na edição de ' . __('Producer') . '. Por favor, tente novamente');
            }
        }
        
        $cities = $this->Producers->Cities->find('list', ['limit' => 200]);
        $this->set(compact('producer', 'cities'));
    }

    /**
     * @param string|null $id Producer id.
     * @return \Cake\Http\Response|null|void Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $producer = $this->Producers->get($id);

        if (!$this->userAuthenticated->can('delete', $producer)) {
            $this->Flash->error('Permissão negada!');
            return $this->redirect(['action' => 'index']);
        }

        if ($this->Producers->delete($producer))
            $this->Flash->success('Exclusão realizada com sucesso');
        else {
            if (count($producer->getErrors()) > 0) {
                foreach ($producer->getErrors() as $error) {
                    foreach ($error as $message) {
                        $this->Flash->error($message);
                    }
                }
            } else {
                $this->Flash->error('Erro na exclusão de ' . __('Producer') . '. Por favor, tente novamente');
            }
        }

        return $this->redirect(['action' => 'index']);
    }
}
