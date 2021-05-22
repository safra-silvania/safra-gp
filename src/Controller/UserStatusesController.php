<?php
declare(strict_types=1);

namespace App\Controller;

/**
 * @property \App\Model\Table\UserStatusesTable $UserStatuses
 * @method \App\Model\Entity\UserStatus[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class UserStatusesController extends AppController
{
    public function beforeFilter(\Cake\Event\EventInterface $event)
    {
        parent::beforeFilter($event);

        $this->viewBuilder()->setLayout('admin');

        $this->set('crumbs', ['Cadastro', 'Outros', __('UserStatuses')]);

        $this->set('canCreate', $this->userAuthenticated && $this->userAuthenticated->can('create', $this->UserStatuses->newEmptyEntity()));
    }
    
    /**
     * @return \Cake\Http\Response|null|void Renders view
     */
    public function index()
    {
        if (!$this->userAuthenticated->can('access', $this->UserStatuses->newEmptyEntity())) {
            $this->Flash->error('Permissão negada!');
            return $this->redirect(['controller' => 'dashboard', 'action' => 'index']);
        }

        $userStatuses = $this->paginate($this->UserStatuses);

        $this->set(compact('userStatuses'));
    }

    /**
     * @param string|null $id User Status id.
     * @return \Cake\Http\Response|null|void Renders view
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $userStatus = $this->UserStatuses->get($id, [
            'contain' => ['Users'],
        ]);

        if (!$this->userAuthenticated->can('view', $userStatus)) {
            $this->Flash->error('Permissão negada!');
            return $this->redirect($this->referer());
        }

        $this->set('userStatus', $userStatus);
    }

    /**
     * @return \Cake\Http\Response|null|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $userStatus = $this->UserStatuses->newEmptyEntity();

        if (!$this->userAuthenticated->can('create', $userStatus)) {
            $this->Flash->error('Permissão negada!');
            return $this->redirect(['action' => 'index']);
        }
        
        if ($this->request->is('post')) {
            $userStatus = $this->UserStatuses->patchEntity($userStatus, $this->request->getData());
            
            if ($this->UserStatuses->save($userStatus)) {
                $this->Flash->success('Inclusão realizada com sucesso');

                return $this->redirect(['action' => 'index']);
            }

            if (count($userStatus->getErrors()) > 0) {
                foreach ($userStatus->getErrors() as $error) {
                    foreach ($error as $message) {
                        $this->Flash->error($message);
                    }
                }
            } else {
                $this->Flash->error('Erro na inclusão de ' . __('User Status') . '. Por favor, tente novamente');
            }
        }

        $this->set(compact('userStatus'));
    }

    /**
     * @param string|null $id User Status id.
     * @return \Cake\Http\Response|null|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $userStatus = $this->UserStatuses->get($id, [
            'contain' => [],
        ]);

        if (!$this->userAuthenticated->can('update', $userStatus)) {
            $this->Flash->error('Permissão negada!');
            return $this->redirect(['action' => 'index']);
        }

        if ($this->request->is(['patch', 'post', 'put'])) {
            $userStatus = $this->UserStatuses->patchEntity($userStatus, $this->request->getData());
            
            if ($this->UserStatuses->save($userStatus)) {
                $this->Flash->success('Edição realizada com sucesso');

                return $this->redirect(['action' => 'index']);
            }

            if (count($userStatus->getErrors()) > 0) {
                foreach ($userStatus->getErrors() as $error) {
                    foreach ($error as $message) {
                        $this->Flash->error($message);
                    }
                }
            } else {
                $this->Flash->error('Erro na edição de ' . __('User Status') . '. Por favor, tente novamente');
            }
        }
        
        $this->set(compact('userStatus'));
    }

    /**
     * @param string|null $id User Status id.
     * @return \Cake\Http\Response|null|void Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $userStatus = $this->UserStatuses->get($id);

        if (!$this->userAuthenticated->can('delete', $userStatus)) {
            $this->Flash->error('Permissão negada!');
            return $this->redirect(['action' => 'index']);
        }

        if ($this->UserStatuses->delete($userStatus))
            $this->Flash->success('Exclusão realizada com sucesso');
        else {
            if (count($userStatus->getErrors()) > 0) {
                foreach ($userStatus->getErrors() as $error) {
                    foreach ($error as $message) {
                        $this->Flash->error($message);
                    }
                }
            } else {
                $this->Flash->error('Erro na exclusão de ' . __('User Status') . '. Por favor, tente novamente');
            }
        }

        return $this->redirect(['action' => 'index']);
    }
}
