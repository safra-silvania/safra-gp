<?php
declare(strict_types=1);

namespace App\Controller;

/**
 * @property \App\Model\Table\ProductivePotencialsTable $ProductivePotencials
 * @method \App\Model\Entity\ProductivePotencial[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class ProductivePotencialsController extends AppController
{
    public function beforeFilter(\Cake\Event\EventInterface $event)
    {
        parent::beforeFilter($event);

        $this->viewBuilder()->setLayout('admin');

        $this->set('crumbs', ['Cadastro', __('Seeds'), __('ProductivePotencials')]);

        $this->set('canCreate', $this->userAuthenticated && $this->userAuthenticated->can('create', $this->ProductivePotencials->newEmptyEntity()));
    }
    
    /**
     * @return \Cake\Http\Response|null|void Renders view
     */
    public function index()
    {
        if (!$this->userAuthenticated->can('access', $this->ProductivePotencials->newEmptyEntity())) {
            $this->Flash->error('Permissão negada!');
            return $this->redirect(['controller' => 'dashboard', 'action' => 'index']);
        }

        $productivePotencials = $this->paginate($this->ProductivePotencials);

        $this->set(compact('productivePotencials'));
    }

    /**
     * @param string|null $id Productive Potencial id.
     * @return \Cake\Http\Response|null|void Renders view
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $productivePotencial = $this->ProductivePotencials->get($id, [
            'contain' => ['Seeds'],
        ]);

        if (!$this->userAuthenticated->can('view', $productivePotencial)) {
            $this->Flash->error('Permissão negada!');
            return $this->redirect($this->referer());
        }

        $this->set('productivePotencial', $productivePotencial);
    }

    /**
     * @return \Cake\Http\Response|null|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $productivePotencial = $this->ProductivePotencials->newEmptyEntity();

        if (!$this->userAuthenticated->can('create', $productivePotencial)) {
            $this->Flash->error('Permissão negada!');
            return $this->redirect(['action' => 'index']);
        }
        
        if ($this->request->is('post')) {
            $productivePotencial = $this->ProductivePotencials->patchEntity($productivePotencial, $this->request->getData());
            
            if ($this->ProductivePotencials->save($productivePotencial)) {
                $this->Flash->success('Inclusão realizada com sucesso');

                return $this->redirect(['action' => 'index']);
            }

            if (count($productivePotencial->getErrors()) > 0) {
                foreach ($productivePotencial->getErrors() as $error) {
                    foreach ($error as $message) {
                        $this->Flash->error($message);
                    }
                }
            } else {
                $this->Flash->error('Erro na inclusão de ' . __('Productive Potencial') . '. Por favor, tente novamente');
            }
        }

        $this->set(compact('productivePotencial'));
    }

    /**
     * @param string|null $id Productive Potencial id.
     * @return \Cake\Http\Response|null|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $productivePotencial = $this->ProductivePotencials->get($id, [
            'contain' => [],
        ]);

        if (!$this->userAuthenticated->can('update', $productivePotencial)) {
            $this->Flash->error('Permissão negada!');
            return $this->redirect(['action' => 'index']);
        }

        if ($this->request->is(['patch', 'post', 'put'])) {
            $productivePotencial = $this->ProductivePotencials->patchEntity($productivePotencial, $this->request->getData());
            
            if ($this->ProductivePotencials->save($productivePotencial)) {
                $this->Flash->success('Edição realizada com sucesso');

                return $this->redirect(['action' => 'index']);
            }

            if (count($productivePotencial->getErrors()) > 0) {
                foreach ($productivePotencial->getErrors() as $error) {
                    foreach ($error as $message) {
                        $this->Flash->error($message);
                    }
                }
            } else {
                $this->Flash->error('Erro na edição de ' . __('Productive Potencial') . '. Por favor, tente novamente');
            }
        }
        
        $this->set(compact('productivePotencial'));
    }

    /**
     * @param string|null $id Productive Potencial id.
     * @return \Cake\Http\Response|null|void Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $productivePotencial = $this->ProductivePotencials->get($id);

        if (!$this->userAuthenticated->can('delete', $productivePotencial)) {
            $this->Flash->error('Permissão negada!');
            return $this->redirect(['action' => 'index']);
        }

        if ($this->ProductivePotencials->delete($productivePotencial))
            $this->Flash->success('Exclusão realizada com sucesso');
        else {
            if (count($productivePotencial->getErrors()) > 0) {
                foreach ($productivePotencial->getErrors() as $error) {
                    foreach ($error as $message) {
                        $this->Flash->error($message);
                    }
                }
            } else {
                $this->Flash->error('Erro na exclusão de ' . __('Productive Potencial') . '. Por favor, tente novamente');
            }
        }

        return $this->redirect(['action' => 'index']);
    }
}
