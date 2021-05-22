<?php
declare(strict_types=1);

namespace App\Controller;

use Cake\ORM\TableRegistry;
use Cake\Cache\Cache;

/**
 * @property \App\Model\Table\UsersTable $Users
 * @method \App\Model\Entity\User[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class UsersController extends AppController
{
    public function beforeFilter(\Cake\Event\EventInterface $event)
    {
        parent::beforeFilter($event);

        $this->viewBuilder()->setLayout('admin');

        $this->set('crumbs', ['Cadastro', 'Outros', __('Users')]);

        // Configure the login action to not require authentication, preventing
        // the infinite redirect loop issue
        $this->Authentication->addUnauthenticatedActions(['login', 'logout', 'tryLogin']);

        $empty = $this->Users->newEmptyEntity();
        $this->set('canCreate', $this->userAuthenticated && $this->userAuthenticated->can('create', $empty));
        $this->set('canChangeRole', $this->userAuthenticated && $this->userAuthenticated->can('changeRole', $empty));
    }

    public function toggleSidebar($toggle = false)
    {
        $this->viewBuilder()->setLayout('ajax');
        $this->request->allowMethod(['get']);

        $collapsedSidebar = $toggle == 'false';
        if ($this->request->is('ajax')) {
            Cache::write('collapsedSidebar', !$collapsedSidebar);
        }

        die();
    }
    
    public function login()
    {
        $this->viewBuilder()->setLayout('login');

        $this->request->allowMethod(['get', 'post']);

        $result = $this->Authentication->getResult();

        if ($this->request->is('post') && !$result->isValid())
        return $this->Flash->error("Senha incorreta!");

        if ($result->isValid()) {

            $target = $this->Authentication->getLoginRedirect();
            if ($target)
                $target = str_replace("/safra", "", $target);
            else 
                $target = ['controller' => 'dashboard', 'action' => 'index'];

            return $this->redirect($target);
        }
    }
    
    public function logout()
    {
        $result = $this->Authentication->getResult();
        if ($result->isValid()) {
            $this->Authentication->logout();
        }

        return $this->redirect(['controller' => 'Users', 'action' => 'login']);
    }
    
    /**
     * @return \Cake\Http\Response|null|void Renders view
     */
    public function index()
    {
        if (!$this->userAuthenticated->can('access', $this->Users->newEmptyEntity())) {
            $this->Flash->error('Permissão negada!');
            return $this->redirect(['controller' => 'dashboard', 'action' => 'index']);
        }

        $this->paginate = [
            'contain' => ['Roles', 'UserStatuses'],
        ];

        $users = $this->paginate($this->Users);

        $this->set(compact('users'));
    }

    /**
     * @param string|null $id User id.
     * @return \Cake\Http\Response|null|void Renders view
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $user = $this->Users->get($id, [
            'contain' => ['Roles', 'UserStatuses', 'Notifications'],
        ]);

        if (!$this->userAuthenticated->can('view', $user)) {
            $this->Flash->error('Permissão negada!');
            return $this->redirect($this->referer());
        }

        $this->set('user', $user);
    }

    /**
     * @return \Cake\Http\Response|null|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $user = $this->Users->newEmptyEntity();

        if (isset($this->userAuthenticated) && !$this->userAuthenticated->can('create', $user)) {
            $this->Flash->error('Permissão negada!');
            return $this->redirect(['action' => 'index']);
        }
        
        if ($this->request->is('post')) {
            $user = $this->Users->patchEntity($user, $this->request->getData(), ['validate' => 'passwords']);
            if ($this->Users->save($user)) {
                $this->Flash->success('Inclusão realizada com sucesso');

                return $this->redirect(['action' => 'index']);
            }

            if (count($user->getErrors()) > 0) {
                foreach ($user->getErrors() as $error) {
                    foreach ($error as $message) {
                        $this->Flash->error($message);
                    }
                }
            } else {
                $this->Flash->error('Erro na inclusão de ' . __('User') . '. Por favor, tente novamente');
            }
        }

        $roles = $this->Users->Roles->find('list', ['limit' => 200]);
        $userStatuses = $this->Users->UserStatuses->find('list', ['limit' => 200]);
        $this->set(compact('user', 'roles', 'userStatuses'));
    }

    /**
     * @param string|null $id User id.
     * @return \Cake\Http\Response|null|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $user = $this->Users->get($id, [
            'contain' => [],
        ]);

        if (!$this->userAuthenticated->can('update', $user)) {
            $this->Flash->error('Permissão negada!');
            return $this->redirect(['action' => 'index']);
        }

        if ($this->request->is(['patch', 'post', 'put'])) {
            $user = $this->Users->patchEntity($user, $this->request->getData(), ['validate' => 'passwords']);
            
            if (empty($user->password))
                unset($user->password);
            
            if ($this->Users->save($user)) {
                $this->Flash->success('Edição realizada com sucesso');

                return $this->redirect(['action' => 'index']);
            }

            if (count($user->getErrors()) > 0) {
                foreach ($user->getErrors() as $error) {
                    foreach ($error as $message) {
                        $this->Flash->error($message);
                    }
                }
            } else {
                $this->Flash->error('Erro na edição de ' . __('User') . '. Por favor, tente novamente');
            }
        }
        
        $roles = $this->Users->Roles->find('list', ['limit' => 200]);
        $userStatuses = $this->Users->UserStatuses->find('list', ['limit' => 200]);
        $this->set(compact('user', 'roles', 'userStatuses'));
    }

    /**
     * @param string|null $id User id.
     * @return \Cake\Http\Response|null|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function changePassword()
    {
        $user = $this->Users->get($this->userAuthenticated->getIdentifier());

        if ($this->request->is(['patch', 'post', 'put'])) {
            $user = $this->Users->patchEntity($user, $this->request->getData(), ['validate' => 'passwords']);
            
            if ($this->Users->save($user)) {
                $this->Flash->success('Senha alterada com sucesso');

                return $this->redirect(['action' => 'index']);
            }

            $this->Flash->error('Erro na alteração de senha. Por favor, tente novamente');
        }
        
        $this->set(compact('user'));
    }

    /**
     * @param string|null $id User id.
     * @return \Cake\Http\Response|null|void Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $user = $this->Users->get($id);

        if (!$this->userAuthenticated->can('delete', $user)) {
            $this->Flash->error('Permissão negada!');
            return $this->redirect(['action' => 'index']);
        }

        if ($this->Users->delete($user))
            $this->Flash->success('Exclusão realizada com sucesso');
        else {
            if (count($user->getErrors()) > 0) {
                foreach ($user->getErrors() as $error) {
                    foreach ($error as $message) {
                        $this->Flash->error($message);
                    }
                }
            } else {
                $this->Flash->error('Erro na exclusão de ' . __('User') . '. Por favor, tente novamente');
            }
        }

        return $this->redirect(['action' => 'index']);
    }
}
