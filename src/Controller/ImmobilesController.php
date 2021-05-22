<?php
declare(strict_types=1);

namespace App\Controller;

/**
 * @property \App\Model\Table\ImmobilesTable $Immobiles
 * @method \App\Model\Entity\Immobile[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class ImmobilesController extends AppController
{
    public function beforeFilter(\Cake\Event\EventInterface $event)
    {
        parent::beforeFilter($event);

        $this->viewBuilder()->setLayout('admin');

        $this->set('crumbs', ['Cadastro', __('Immobiles')]);

        $this->set('canCreate', $this->userAuthenticated && $this->userAuthenticated->can('create', $this->Immobiles->newEmptyEntity()));
    }
    
    /**
     * @return \Cake\Http\Response|null|void Renders view
     */
    public function index()
    {
        if (!$this->userAuthenticated->can('access', $this->Immobiles->newEmptyEntity())) {
            $this->Flash->error('Permissão negada!');
            return $this->redirect(['controller' => 'dashboard', 'action' => 'index']);
        }

        $this->paginate = [
            'contain' => ['Producers', 'Cities', 'Fields'],
        ];
        $immobiles = $this->paginate($this->Immobiles);

        $this->set(compact('immobiles'));
    }

    /**
     * @param string|null $id Immobile id.
     * @return \Cake\Http\Response|null|void Renders view
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $immobile = $this->Immobiles->get($id, [
            'contain' => ['Producers', 'Cities', 'Fields', 'Plans'],
        ]);

        if (!$this->userAuthenticated->can('view', $immobile)) {
            $this->Flash->error('Permissão negada!');
            return $this->redirect($this->referer());
        }

        $this->set('immobile', $immobile);
    }

    /**
     * @return \Cake\Http\Response|null|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $immobile = $this->Immobiles->newEmptyEntity();

        if (!$this->userAuthenticated->can('create', $immobile)) {
            $this->Flash->error('Permissão negada!');
            return $this->redirect(['action' => 'index']);
        }
        
        if ($this->request->is('post')) {
            $immobile = $this->Immobiles->patchEntity($immobile, $this->request->getData());
            
            if ($this->Immobiles->save($immobile)) {
                $this->Flash->success('Inclusão realizada com sucesso');

                return $this->redirect(['action' => 'index']);
            }

            if (count($immobile->getErrors()) > 0) {
                foreach ($immobile->getErrors() as $error) {
                    foreach ($error as $message) {
                        $this->Flash->error($message);
                    }
                }
            } else {
                $this->Flash->error('Erro na inclusão de ' . __('Immobile') . '. Por favor, tente novamente');
            }
        }

        $producers = $this->Immobiles->Producers->find('list', ['limit' => 200]);
        $cities = $this->Immobiles->Cities->find('list', ['limit' => 200]);
        $this->set(compact('immobile', 'producers', 'cities'));
    }

    /**
     * @param string|null $id Immobile id.
     * @return \Cake\Http\Response|null|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $immobile = $this->Immobiles->get($id, [
            'contain' => [],
        ]);

        if (!$this->userAuthenticated->can('update', $immobile)) {
            $this->Flash->error('Permissão negada!');
            return $this->redirect(['action' => 'index']);
        }

        if ($this->request->is(['patch', 'post', 'put'])) {
            $immobile = $this->Immobiles->patchEntity($immobile, $this->request->getData());
            
            if ($this->Immobiles->save($immobile)) {
                $this->Flash->success('Edição realizada com sucesso');

                return $this->redirect(['action' => 'index']);
            }

            if (count($immobile->getErrors()) > 0) {
                foreach ($immobile->getErrors() as $error) {
                    foreach ($error as $message) {
                        $this->Flash->error($message);
                    }
                }
            } else {
                $this->Flash->error('Erro na edição de ' . __('Immobile') . '. Por favor, tente novamente');
            }
        }
        
        $producers = $this->Immobiles->Producers->find('list', ['limit' => 200]);
        $cities = $this->Immobiles->Cities->find('list', ['limit' => 200]);
        $this->set(compact('immobile', 'producers', 'cities'));
    }

    /**
     * @param string|null $id Immobile id.
     * @return \Cake\Http\Response|null|void Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $immobile = $this->Immobiles->get($id);

        if (!$this->userAuthenticated->can('delete', $immobile)) {
            $this->Flash->error('Permissão negada!');
            return $this->redirect(['action' => 'index']);
        }

        if ($this->Immobiles->delete($immobile))
            $this->Flash->success('Exclusão realizada com sucesso');
        else {
            if (count($immobile->getErrors()) > 0) {
                foreach ($immobile->getErrors() as $error) {
                    foreach ($error as $message) {
                        $this->Flash->error($message);
                    }
                }
            } else {
                $this->Flash->error('Erro na exclusão de ' . __('Immobile') . '. Por favor, tente novamente');
            }
        }

        return $this->redirect(['action' => 'index']);
    }
}
