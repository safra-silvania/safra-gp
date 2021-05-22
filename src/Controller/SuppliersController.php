<?php
declare(strict_types=1);

namespace App\Controller;

/**
 * @property \App\Model\Table\SuppliersTable $Suppliers
 * @method \App\Model\Entity\Supplier[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class SuppliersController extends AppController
{
    public function beforeFilter(\Cake\Event\EventInterface $event)
    {
        parent::beforeFilter($event);

        $this->viewBuilder()->setLayout('admin');

        $this->set('crumbs', ['Cadastro', __('Suppliers')]);

        $this->set('canCreate', $this->userAuthenticated && $this->userAuthenticated->can('create', $this->Suppliers->newEmptyEntity()));
    }
    
    /**
     * @return \Cake\Http\Response|null|void Renders view
     */
    public function index()
    {
        if (!$this->userAuthenticated->can('access', $this->Suppliers->newEmptyEntity())) {
            $this->Flash->error('Permissão negada!');
            return $this->redirect(['controller' => 'dashboard', 'action' => 'index']);
        }

        $this->paginate = [
            'contain' => ['Cities'],
        ];
        $suppliers = $this->paginate($this->Suppliers);

        $this->set(compact('suppliers'));
    }

    /**
     * @param string|null $id Supplier id.
     * @return \Cake\Http\Response|null|void Renders view
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $supplier = $this->Suppliers->get($id, [
            'contain' => ['Cities', 'SupplierTypes', 'Chemicals', 'Fertilities', 'Fertilizers', 'Seeds'],
        ]);

        if (!$this->userAuthenticated->can('view', $supplier)) {
            $this->Flash->error('Permissão negada!');
            return $this->redirect($this->referer());
        }

        $this->set('supplier', $supplier);
    }

    /**
     * @return \Cake\Http\Response|null|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $supplier = $this->Suppliers->newEmptyEntity();

        if (!$this->userAuthenticated->can('create', $supplier)) {
            $this->Flash->error('Permissão negada!');
            return $this->redirect(['action' => 'index']);
        }
        
        if ($this->request->is('post')) {
            $supplier = $this->Suppliers->patchEntity($supplier, $this->request->getData());
            
            if ($this->Suppliers->save($supplier)) {
                $this->Flash->success('Inclusão realizada com sucesso');

                return $this->redirect(['action' => 'index']);
            }

            if (count($supplier->getErrors()) > 0) {
                foreach ($supplier->getErrors() as $error) {
                    foreach ($error as $message) {
                        $this->Flash->error($message);
                    }
                }
            } else {
                $this->Flash->error('Erro na inclusão de ' . __('Supplier') . '. Por favor, tente novamente');
            }
        }

        $cities = $this->Suppliers->Cities->find('list', ['limit' => 200]);
        $supplierTypes = $this->Suppliers->SupplierTypes->find('list', ['limit' => 200]);
        $this->set(compact('supplier', 'cities', 'supplierTypes'));
    }

    /**
     * @param string|null $id Supplier id.
     * @return \Cake\Http\Response|null|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $supplier = $this->Suppliers->get($id, [
            'contain' => ['SupplierTypes'],
        ]);

        if (!$this->userAuthenticated->can('update', $supplier)) {
            $this->Flash->error('Permissão negada!');
            return $this->redirect(['action' => 'index']);
        }

        if ($this->request->is(['patch', 'post', 'put'])) {
            $supplier = $this->Suppliers->patchEntity($supplier, $this->request->getData());
            
            if ($this->Suppliers->save($supplier)) {
                $this->Flash->success('Edição realizada com sucesso');

                return $this->redirect(['action' => 'index']);
            }

            if (count($supplier->getErrors()) > 0) {
                foreach ($supplier->getErrors() as $error) {
                    foreach ($error as $message) {
                        $this->Flash->error($message);
                    }
                }
            } else {
                $this->Flash->error('Erro na edição de ' . __('Supplier') . '. Por favor, tente novamente');
            }
        }
        
        $cities = $this->Suppliers->Cities->find('list', ['limit' => 200]);
        $supplierTypes = $this->Suppliers->SupplierTypes->find('list', ['limit' => 200]);
        $this->set(compact('supplier', 'cities', 'supplierTypes'));
    }

    /**
     * @param string|null $id Supplier id.
     * @return \Cake\Http\Response|null|void Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $supplier = $this->Suppliers->get($id);

        if (!$this->userAuthenticated->can('delete', $supplier)) {
            $this->Flash->error('Permissão negada!');
            return $this->redirect(['action' => 'index']);
        }

        if ($this->Suppliers->delete($supplier))
            $this->Flash->success('Exclusão realizada com sucesso');
        else {
            if (count($supplier->getErrors()) > 0) {
                foreach ($supplier->getErrors() as $error) {
                    foreach ($error as $message) {
                        $this->Flash->error($message);
                    }
                }
            } else {
                $this->Flash->error('Erro na exclusão de ' . __('Supplier') . '. Por favor, tente novamente');
            }
        }

        return $this->redirect(['action' => 'index']);
    }
}
