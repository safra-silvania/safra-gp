<?php
declare(strict_types=1);

namespace App\Controller;

/**
 * @property \App\Model\Table\FertilitiesTable $Fertilities
 * @method \App\Model\Entity\Fertility[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class FertilitiesController extends AppController
{
    public function beforeFilter(\Cake\Event\EventInterface $event)
    {
        parent::beforeFilter($event);

        $this->viewBuilder()->setLayout('admin');

        $this->set('crumbs', ['Cadastro', __('Seeds'), __('Fertilities')]);

        $this->set('canCreate', $this->userAuthenticated && $this->userAuthenticated->can('create', $this->Fertilities->newEmptyEntity()));
    }
    
    /**
     * @return \Cake\Http\Response|null|void Renders view
     */
    public function index()
    {
        if (!$this->userAuthenticated->can('access', $this->Fertilities->newEmptyEntity())) {
            $this->Flash->error('Permissão negada!');
            return $this->redirect(['controller' => 'dashboard', 'action' => 'index']);
        }

        $fertilities = $this->paginate($this->Fertilities);

        $this->set(compact('fertilities'));
    }

    /**
     * @param string|null $id Fertility id.
     * @return \Cake\Http\Response|null|void Renders view
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $fertility = $this->Fertilities->get($id, [
            'contain' => ['Seeds', 'FieldDetails', 'Fields'],
        ]);

        if (!$this->userAuthenticated->can('view', $fertility)) {
            $this->Flash->error('Permissão negada!');
            return $this->redirect($this->referer());
        }

        $this->set('fertility', $fertility);
    }

    /**
     * @return \Cake\Http\Response|null|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $fertility = $this->Fertilities->newEmptyEntity();

        if (!$this->userAuthenticated->can('create', $fertility)) {
            $this->Flash->error('Permissão negada!');
            return $this->redirect(['action' => 'index']);
        }
        
        if ($this->request->is('post')) {
            $fertility = $this->Fertilities->patchEntity($fertility, $this->request->getData());
            
            if ($this->Fertilities->save($fertility)) {
                $this->Flash->success('Inclusão realizada com sucesso');

                return $this->redirect(['action' => 'index']);
            }

            if (count($fertility->getErrors()) > 0) {
                foreach ($fertility->getErrors() as $error) {
                    foreach ($error as $message) {
                        $this->Flash->error($message);
                    }
                }
            } else {
                $this->Flash->error('Erro na inclusão de ' . __('Fertility') . '. Por favor, tente novamente');
            }
        }

        $seeds = $this->Fertilities->Seeds->find('list', ['limit' => 200]);
        $this->set(compact('fertility', 'seeds'));
    }

    /**
     * @param string|null $id Fertility id.
     * @return \Cake\Http\Response|null|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $fertility = $this->Fertilities->get($id, [
            'contain' => ['Seeds'],
        ]);

        if (!$this->userAuthenticated->can('update', $fertility)) {
            $this->Flash->error('Permissão negada!');
            return $this->redirect(['action' => 'index']);
        }

        if ($this->request->is(['patch', 'post', 'put'])) {
            $fertility = $this->Fertilities->patchEntity($fertility, $this->request->getData());
            
            if ($this->Fertilities->save($fertility)) {
                $this->Flash->success('Edição realizada com sucesso');

                return $this->redirect(['action' => 'index']);
            }

            if (count($fertility->getErrors()) > 0) {
                foreach ($fertility->getErrors() as $error) {
                    foreach ($error as $message) {
                        $this->Flash->error($message);
                    }
                }
            } else {
                $this->Flash->error('Erro na edição de ' . __('Fertility') . '. Por favor, tente novamente');
            }
        }
        
        $seeds = $this->Fertilities->Seeds->find('list', ['limit' => 200]);
        $this->set(compact('fertility', 'seeds'));
    }

    /**
     * @param string|null $id Fertility id.
     * @return \Cake\Http\Response|null|void Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $fertility = $this->Fertilities->get($id);

        if (!$this->userAuthenticated->can('delete', $fertility)) {
            $this->Flash->error('Permissão negada!');
            return $this->redirect(['action' => 'index']);
        }

        if ($this->Fertilities->delete($fertility))
            $this->Flash->success('Exclusão realizada com sucesso');
        else {
            if (count($fertility->getErrors()) > 0) {
                foreach ($fertility->getErrors() as $error) {
                    foreach ($error as $message) {
                        $this->Flash->error($message);
                    }
                }
            } else {
                $this->Flash->error('Erro na exclusão de ' . __('Fertility') . '. Por favor, tente novamente');
            }
        }

        return $this->redirect(['action' => 'index']);
    }
}
