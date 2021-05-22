<?php
declare(strict_types=1);

namespace App\Controller;

/**
 * @property \App\Model\Table\SupplierTypesTable $SupplierTypes
 * @method \App\Model\Entity\SupplierType[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class SupplierTypesController extends AppController
{
    public function beforeFilter(\Cake\Event\EventInterface $event)
    {
        parent::beforeFilter($event);

        $this->viewBuilder()->setLayout('admin');

        $this->set('crumbs', ['Cadastro', 'Outros', __('SupplierTypes')]);

        $this->set('canCreate', $this->userAuthenticated && $this->userAuthenticated->can('create', $this->SupplierTypes->newEmptyEntity()));
    }
    
    /**
     * @return \Cake\Http\Response|null|void Renders view
     */
    public function index()
    {
        if (!$this->userAuthenticated->can('access', $this->SupplierTypes->newEmptyEntity())) {
            $this->Flash->error('Permissão negada!');
            return $this->redirect(['controller' => 'dashboard', 'action' => 'index']);
        }

        $supplierTypes = $this->paginate($this->SupplierTypes);

        $this->set(compact('supplierTypes'));
    }

    /**
     * @param string|null $id Supplier Type id.
     * @return \Cake\Http\Response|null|void Renders view
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $supplierType = $this->SupplierTypes->get($id, [
            'contain' => ['Suppliers'],
        ]);

        if (!$this->userAuthenticated->can('view', $supplierType)) {
            $this->Flash->error('Permissão negada!');
            return $this->redirect($this->referer());
        }

        $this->set('supplierType', $supplierType);
    }

    /**
     * @return \Cake\Http\Response|null|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $supplierType = $this->SupplierTypes->newEmptyEntity();

        if (!$this->userAuthenticated->can('create', $supplierType)) {
            $this->Flash->error('Permissão negada!');
            return $this->redirect(['action' => 'index']);
        }
        
        if ($this->request->is('post')) {
            $supplierType = $this->SupplierTypes->patchEntity($supplierType, $this->request->getData());
            
            if ($this->SupplierTypes->save($supplierType)) {
                $this->Flash->success('Inclusão realizada com sucesso');

                return $this->redirect(['action' => 'index']);
            }

            if (count($supplierType->getErrors()) > 0) {
                foreach ($supplierType->getErrors() as $error) {
                    foreach ($error as $message) {
                        $this->Flash->error($message);
                    }
                }
            } else {
                $this->Flash->error('Erro na inclusão de ' . __('Supplier Type') . '. Por favor, tente novamente');
            }
        }

        $suppliers = $this->SupplierTypes->Suppliers->find('list', ['limit' => 200]);
        $this->set(compact('supplierType', 'suppliers'));
    }

    /**
     * @param string|null $id Supplier Type id.
     * @return \Cake\Http\Response|null|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $supplierType = $this->SupplierTypes->get($id, [
            'contain' => ['Suppliers'],
        ]);

        if (!$this->userAuthenticated->can('update', $supplierType)) {
            $this->Flash->error('Permissão negada!');
            return $this->redirect(['action' => 'index']);
        }

        if ($this->request->is(['patch', 'post', 'put'])) {
            $supplierType = $this->SupplierTypes->patchEntity($supplierType, $this->request->getData());
            
            if ($this->SupplierTypes->save($supplierType)) {
                $this->Flash->success('Edição realizada com sucesso');

                return $this->redirect(['action' => 'index']);
            }

            if (count($supplierType->getErrors()) > 0) {
                foreach ($supplierType->getErrors() as $error) {
                    foreach ($error as $message) {
                        $this->Flash->error($message);
                    }
                }
            } else {
                $this->Flash->error('Erro na edição de ' . __('Supplier Type') . '. Por favor, tente novamente');
            }
        }
        
        $suppliers = $this->SupplierTypes->Suppliers->find('list', ['limit' => 200]);
        $this->set(compact('supplierType', 'suppliers'));
    }

    /**
     * @param string|null $id Supplier Type id.
     * @return \Cake\Http\Response|null|void Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $supplierType = $this->SupplierTypes->get($id);

        if (!$this->userAuthenticated->can('delete', $supplierType)) {
            $this->Flash->error('Permissão negada!');
            return $this->redirect(['action' => 'index']);
        }

        if ($this->SupplierTypes->delete($supplierType))
            $this->Flash->success('Exclusão realizada com sucesso');
        else {
            if (count($supplierType->getErrors()) > 0) {
                foreach ($supplierType->getErrors() as $error) {
                    foreach ($error as $message) {
                        $this->Flash->error($message);
                    }
                }
            } else {
                $this->Flash->error('Erro na exclusão de ' . __('Supplier Type') . '. Por favor, tente novamente');
            }
        }

        return $this->redirect(['action' => 'index']);
    }
}
