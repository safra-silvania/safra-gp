<?php
declare(strict_types=1);

namespace App\Controller;

/**
 * @property \App\Model\Table\RolesTable $Roles
 * @method \App\Model\Entity\Role[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class RolesController extends AppController
{
    public function beforeFilter(\Cake\Event\EventInterface $event)
    {
        parent::beforeFilter($event);

        $this->viewBuilder()->setLayout('admin');

        $this->set('crumbs', ['Cadastro', 'Outros', __('Roles')]);

        $this->set('canCreate', $this->userAuthenticated && $this->userAuthenticated->can('create', $this->Roles->newEmptyEntity()));
    }
    
    /**
     * @return \Cake\Http\Response|null|void Renders view
     */
    public function index()
    {
        if (!$this->userAuthenticated->can('access', $this->Roles->newEmptyEntity())) {
            $this->Flash->error('Permissão negada!');
            return $this->redirect(['controller' => 'dashboard', 'action' => 'index']);
        }

        $roles = $this->paginate($this->Roles);

        $this->set(compact('roles'));
    }

    /**
     * @param string|null $id Role id.
     * @return \Cake\Http\Response|null|void Renders view
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $role = $this->Roles->get($id, [
            'contain' => ['Users'],
        ]);

        if (!$this->userAuthenticated->can('view', $role)) {
            $this->Flash->error('Permissão negada!');
            return $this->redirect($this->referer());
        }

        $this->set('role', $role);
    }

    /**
     * @return \Cake\Http\Response|null|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $role = $this->Roles->newEmptyEntity();

        if (!$this->userAuthenticated->can('create', $role)) {
            $this->Flash->error('Permissão negada!');
            return $this->redirect(['action' => 'index']);
        }
        
        if ($this->request->is('post')) {
            $role = $this->Roles->patchEntity($role, $this->request->getData());
            
            if ($this->Roles->save($role)) {
                $this->Flash->success('Inclusão realizada com sucesso');

                return $this->redirect(['action' => 'index']);
            }

            if (count($role->getErrors()) > 0) {
                foreach ($role->getErrors() as $error) {
                    foreach ($error as $message) {
                        $this->Flash->error($message);
                    }
                }
            } else {
                $this->Flash->error('Erro na inclusão de ' . __('Role') . '. Por favor, tente novamente');
            }
        }

        $this->set(compact('role'));
    }

    /**
     * @param string|null $id Role id.
     * @return \Cake\Http\Response|null|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $role = $this->Roles->get($id, [
            'contain' => [],
        ]);

        if (!$this->userAuthenticated->can('update', $role)) {
            $this->Flash->error('Permissão negada!');
            return $this->redirect(['action' => 'index']);
        }

        if ($this->request->is(['patch', 'post', 'put'])) {
            $role = $this->Roles->patchEntity($role, $this->request->getData());
            
            if ($this->Roles->save($role)) {
                $this->Flash->success('Edição realizada com sucesso');

                return $this->redirect(['action' => 'index']);
            }

            if (count($role->getErrors()) > 0) {
                foreach ($role->getErrors() as $error) {
                    foreach ($error as $message) {
                        $this->Flash->error($message);
                    }
                }
            } else {
                $this->Flash->error('Erro na edição de ' . __('Role') . '. Por favor, tente novamente');
            }
        }
        
        $this->set(compact('role'));
    }

    /**
     * @param string|null $id Role id.
     * @return \Cake\Http\Response|null|void Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $role = $this->Roles->get($id);

        if (!$this->userAuthenticated->can('delete', $role)) {
            $this->Flash->error('Permissão negada!');
            return $this->redirect(['action' => 'index']);
        }

        if ($this->Roles->delete($role))
            $this->Flash->success('Exclusão realizada com sucesso');
        else {
            if (count($role->getErrors()) > 0) {
                foreach ($role->getErrors() as $error) {
                    foreach ($error as $message) {
                        $this->Flash->error($message);
                    }
                }
            } else {
                $this->Flash->error('Erro na exclusão de ' . __('Role') . '. Por favor, tente novamente');
            }
        }

        return $this->redirect(['action' => 'index']);
    }
}
