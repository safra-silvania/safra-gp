<?php
declare(strict_types=1);

namespace App\Controller;

/**
 * @property \App\Model\Table\TechnologiesTable $Technologies
 * @method \App\Model\Entity\Technology[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class TechnologiesController extends AppController
{
    public function beforeFilter(\Cake\Event\EventInterface $event)
    {
        parent::beforeFilter($event);

        $this->viewBuilder()->setLayout('admin');

        $this->set('crumbs', ['Cadastro', __('Seeds'), __('Technologies')]);

        $this->set('canCreate', $this->userAuthenticated && $this->userAuthenticated->can('create', $this->Technologies->newEmptyEntity()));
    }
    
    /**
     * @return \Cake\Http\Response|null|void Renders view
     */
    public function index()
    {
        if (!$this->userAuthenticated->can('access', $this->Technologies->newEmptyEntity())) {
            $this->Flash->error('Permissão negada!');
            return $this->redirect(['controller' => 'dashboard', 'action' => 'index']);
        }

        $technologies = $this->paginate($this->Technologies);

        $this->set(compact('technologies'));
    }

    /**
     * @param string|null $id Technology id.
     * @return \Cake\Http\Response|null|void Renders view
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $technology = $this->Technologies->get($id, [
            'contain' => ['Seeds'],
        ]);

        if (!$this->userAuthenticated->can('view', $technology)) {
            $this->Flash->error('Permissão negada!');
            return $this->redirect($this->referer());
        }

        $this->set('technology', $technology);
    }

    /**
     * @return \Cake\Http\Response|null|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $technology = $this->Technologies->newEmptyEntity();

        if (!$this->userAuthenticated->can('create', $technology)) {
            $this->Flash->error('Permissão negada!');
            return $this->redirect(['action' => 'index']);
        }
        
        if ($this->request->is('post')) {
            $technology = $this->Technologies->patchEntity($technology, $this->request->getData());
            
            if ($this->Technologies->save($technology)) {
                $this->Flash->success('Inclusão realizada com sucesso');

                return $this->redirect(['action' => 'index']);
            }

            if (count($technology->getErrors()) > 0) {
                foreach ($technology->getErrors() as $error) {
                    foreach ($error as $message) {
                        $this->Flash->error($message);
                    }
                }
            } else {
                $this->Flash->error('Erro na inclusão de ' . __('Technology') . '. Por favor, tente novamente');
            }
        }

        $this->set(compact('technology'));
    }

    /**
     * @param string|null $id Technology id.
     * @return \Cake\Http\Response|null|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $technology = $this->Technologies->get($id, [
            'contain' => [],
        ]);

        if (!$this->userAuthenticated->can('update', $technology)) {
            $this->Flash->error('Permissão negada!');
            return $this->redirect(['action' => 'index']);
        }

        if ($this->request->is(['patch', 'post', 'put'])) {
            $technology = $this->Technologies->patchEntity($technology, $this->request->getData());
            
            if ($this->Technologies->save($technology)) {
                $this->Flash->success('Edição realizada com sucesso');

                return $this->redirect(['action' => 'index']);
            }

            if (count($technology->getErrors()) > 0) {
                foreach ($technology->getErrors() as $error) {
                    foreach ($error as $message) {
                        $this->Flash->error($message);
                    }
                }
            } else {
                $this->Flash->error('Erro na edição de ' . __('Technology') . '. Por favor, tente novamente');
            }
        }
        
        $this->set(compact('technology'));
    }

    /**
     * @param string|null $id Technology id.
     * @return \Cake\Http\Response|null|void Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $technology = $this->Technologies->get($id);

        if (!$this->userAuthenticated->can('delete', $technology)) {
            $this->Flash->error('Permissão negada!');
            return $this->redirect(['action' => 'index']);
        }

        if ($this->Technologies->delete($technology))
            $this->Flash->success('Exclusão realizada com sucesso');
        else {
            if (count($technology->getErrors()) > 0) {
                foreach ($technology->getErrors() as $error) {
                    foreach ($error as $message) {
                        $this->Flash->error($message);
                    }
                }
            } else {
                $this->Flash->error('Erro na exclusão de ' . __('Technology') . '. Por favor, tente novamente');
            }
        }

        return $this->redirect(['action' => 'index']);
    }
}
