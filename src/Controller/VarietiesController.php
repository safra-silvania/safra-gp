<?php
declare(strict_types=1);

namespace App\Controller;

/**
 * @property \App\Model\Table\VarietiesTable $Varieties
 * @method \App\Model\Entity\Variety[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class VarietiesController extends AppController
{
    public function beforeFilter(\Cake\Event\EventInterface $event)
    {
        parent::beforeFilter($event);

        $this->viewBuilder()->setLayout('admin');

        $this->set('crumbs', ['Cadastro', __('Seeds'), __('Varieties')]);

        $this->set('canCreate', $this->userAuthenticated && $this->userAuthenticated->can('create', $this->Varieties->newEmptyEntity()));
    }
    
    /**
     * @return \Cake\Http\Response|null|void Renders view
     */
    public function index()
    {
        if (!$this->userAuthenticated->can('access', $this->Varieties->newEmptyEntity())) {
            $this->Flash->error('Permissão negada!');
            return $this->redirect(['controller' => 'dashboard', 'action' => 'index']);
        }

        $varieties = $this->paginate($this->Varieties);

        $this->set(compact('varieties'));
    }

    /**
     * @param string|null $id Variety id.
     * @return \Cake\Http\Response|null|void Renders view
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $variety = $this->Varieties->get($id, [
            'contain' => ['Seeds'],
        ]);

        if (!$this->userAuthenticated->can('view', $variety)) {
            $this->Flash->error('Permissão negada!');
            return $this->redirect($this->referer());
        }

        $this->set('variety', $variety);
    }

    /**
     * @return \Cake\Http\Response|null|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $variety = $this->Varieties->newEmptyEntity();

        if (!$this->userAuthenticated->can('create', $variety)) {
            $this->Flash->error('Permissão negada!');
            return $this->redirect(['action' => 'index']);
        }
        
        if ($this->request->is('post')) {
            $variety = $this->Varieties->patchEntity($variety, $this->request->getData());
            
            if ($this->Varieties->save($variety)) {
                $this->Flash->success('Inclusão realizada com sucesso');

                return $this->redirect(['action' => 'index']);
            }

            if (count($variety->getErrors()) > 0) {
                foreach ($variety->getErrors() as $error) {
                    foreach ($error as $message) {
                        $this->Flash->error($message);
                    }
                }
            } else {
                $this->Flash->error('Erro na inclusão de ' . __('Variety') . '. Por favor, tente novamente');
            }
        }

        $this->set(compact('variety'));
    }

    /**
     * @param string|null $id Variety id.
     * @return \Cake\Http\Response|null|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $variety = $this->Varieties->get($id, [
            'contain' => [],
        ]);

        if (!$this->userAuthenticated->can('update', $variety)) {
            $this->Flash->error('Permissão negada!');
            return $this->redirect(['action' => 'index']);
        }

        if ($this->request->is(['patch', 'post', 'put'])) {
            $variety = $this->Varieties->patchEntity($variety, $this->request->getData());
            
            if ($this->Varieties->save($variety)) {
                $this->Flash->success('Edição realizada com sucesso');

                return $this->redirect(['action' => 'index']);
            }

            if (count($variety->getErrors()) > 0) {
                foreach ($variety->getErrors() as $error) {
                    foreach ($error as $message) {
                        $this->Flash->error($message);
                    }
                }
            } else {
                $this->Flash->error('Erro na edição de ' . __('Variety') . '. Por favor, tente novamente');
            }
        }
        
        $this->set(compact('variety'));
    }

    /**
     * @param string|null $id Variety id.
     * @return \Cake\Http\Response|null|void Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $variety = $this->Varieties->get($id);

        if (!$this->userAuthenticated->can('delete', $variety)) {
            $this->Flash->error('Permissão negada!');
            return $this->redirect(['action' => 'index']);
        }

        if ($this->Varieties->delete($variety))
            $this->Flash->success('Exclusão realizada com sucesso');
        else {
            if (count($variety->getErrors()) > 0) {
                foreach ($variety->getErrors() as $error) {
                    foreach ($error as $message) {
                        $this->Flash->error($message);
                    }
                }
            } else {
                $this->Flash->error('Erro na exclusão de ' . __('Variety') . '. Por favor, tente novamente');
            }
        }

        return $this->redirect(['action' => 'index']);
    }
}
