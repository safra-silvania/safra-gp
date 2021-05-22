<?php
declare(strict_types=1);

namespace App\Controller;

/**
 * @property \App\Model\Table\CyclesTable $Cycles
 * @method \App\Model\Entity\Cycle[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class CyclesController extends AppController
{
    public function beforeFilter(\Cake\Event\EventInterface $event)
    {
        parent::beforeFilter($event);

        $this->viewBuilder()->setLayout('admin');

        $this->set('crumbs', ['Cadastro', __('Seeds'), __('Cycles')]);

        $this->set('canCreate', $this->userAuthenticated && $this->userAuthenticated->can('create', $this->Cycles->newEmptyEntity()));
    }
    
    /**
     * @return \Cake\Http\Response|null|void Renders view
     */
    public function index()
    {
        if (!$this->userAuthenticated->can('access', $this->Cycles->newEmptyEntity())) {
            $this->Flash->error('Permissão negada!');
            return $this->redirect(['controller' => 'dashboard', 'action' => 'index']);
        }

        $cycles = $this->paginate($this->Cycles);

        $this->set(compact('cycles'));
    }

    /**
     * @param string|null $id Cycle id.
     * @return \Cake\Http\Response|null|void Renders view
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $cycle = $this->Cycles->get($id, [
            'contain' => ['Seeds'],
        ]);

        if (!$this->userAuthenticated->can('view', $cycle)) {
            $this->Flash->error('Permissão negada!');
            return $this->redirect($this->referer());
        }

        $this->set('cycle', $cycle);
    }

    /**
     * @return \Cake\Http\Response|null|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $cycle = $this->Cycles->newEmptyEntity();

        if (!$this->userAuthenticated->can('create', $cycle)) {
            $this->Flash->error('Permissão negada!');
            return $this->redirect(['action' => 'index']);
        }
        
        if ($this->request->is('post')) {
            $cycle = $this->Cycles->patchEntity($cycle, $this->request->getData());
            
            if ($this->Cycles->save($cycle)) {
                $this->Flash->success('Inclusão realizada com sucesso');

                return $this->redirect(['action' => 'index']);
            }

            if (count($cycle->getErrors()) > 0) {
                foreach ($cycle->getErrors() as $error) {
                    foreach ($error as $message) {
                        $this->Flash->error($message);
                    }
                }
            } else {
                $this->Flash->error('Erro na inclusão de ' . __('Cycle') . '. Por favor, tente novamente');
            }
        }

        $this->set(compact('cycle'));
    }

    /**
     * @param string|null $id Cycle id.
     * @return \Cake\Http\Response|null|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $cycle = $this->Cycles->get($id, [
            'contain' => [],
        ]);

        if (!$this->userAuthenticated->can('update', $cycle)) {
            $this->Flash->error('Permissão negada!');
            return $this->redirect(['action' => 'index']);
        }

        if ($this->request->is(['patch', 'post', 'put'])) {
            $cycle = $this->Cycles->patchEntity($cycle, $this->request->getData());
            
            if ($this->Cycles->save($cycle)) {
                $this->Flash->success('Edição realizada com sucesso');

                return $this->redirect(['action' => 'index']);
            }

            if (count($cycle->getErrors()) > 0) {
                foreach ($cycle->getErrors() as $error) {
                    foreach ($error as $message) {
                        $this->Flash->error($message);
                    }
                }
            } else {
                $this->Flash->error('Erro na edição de ' . __('Cycle') . '. Por favor, tente novamente');
            }
        }
        
        $this->set(compact('cycle'));
    }

    /**
     * @param string|null $id Cycle id.
     * @return \Cake\Http\Response|null|void Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $cycle = $this->Cycles->get($id);

        if (!$this->userAuthenticated->can('delete', $cycle)) {
            $this->Flash->error('Permissão negada!');
            return $this->redirect(['action' => 'index']);
        }

        if ($this->Cycles->delete($cycle))
            $this->Flash->success('Exclusão realizada com sucesso');
        else {
            if (count($cycle->getErrors()) > 0) {
                foreach ($cycle->getErrors() as $error) {
                    foreach ($error as $message) {
                        $this->Flash->error($message);
                    }
                }
            } else {
                $this->Flash->error('Erro na exclusão de ' . __('Cycle') . '. Por favor, tente novamente');
            }
        }

        return $this->redirect(['action' => 'index']);
    }
}
