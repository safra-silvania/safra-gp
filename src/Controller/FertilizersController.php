<?php
declare(strict_types=1);

namespace App\Controller;

use App\Model\Enum;

/**
 * @property \App\Model\Table\FertilizersTable $Fertilizers
 * @method \App\Model\Entity\Fertilizer[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class FertilizersController extends AppController
{
    private $fertilizerSuppliers;

    public function beforeFilter(\Cake\Event\EventInterface $event)
    {
        parent::beforeFilter($event);

        $this->viewBuilder()->setLayout('admin');

        $this->set('crumbs', ['Cadastro', __('Fertilizers')]);

        $this->set('canCreate', $this->userAuthenticated && $this->userAuthenticated->can('create', $this->Fertilizers->newEmptyEntity()));

        $this->fertilizerSuppliers = $this->Fertilizers->Suppliers->find('list')
            ->innerJoinWith(
                'SupplierTypes', function ($q) {
                    return $q->where(['SupplierTypes.id' => Enum\SupplierTypesEnum::Adubos]);
                }
            );
    }
    
    /**
     * @return \Cake\Http\Response|null|void Renders view
     */
    public function index()
    {
        if (!$this->userAuthenticated->can('access', $this->Fertilizers->newEmptyEntity())) {
            $this->Flash->error('Permissão negada!');
            return $this->redirect(['controller' => 'dashboard', 'action' => 'index']);
        }

        $this->paginate = [
            'contain' => ['Suppliers', 'FertilizerMeasureUnits'],
        ];
        $fertilizers = $this->paginate($this->Fertilizers);

        $this->set(compact('fertilizers'));
    }

    /**
     * @param string|null $id Fertilizer id.
     * @return \Cake\Http\Response|null|void Renders view
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $fertilizer = $this->Fertilizers->get($id, [
            'contain' => ['Suppliers', 'FertilizerMeasureUnits'],
        ]);

        if (!$this->userAuthenticated->can('view', $fertilizer)) {
            $this->Flash->error('Permissão negada!');
            return $this->redirect($this->referer());
        }

        $this->set('fertilizer', $fertilizer);
    }

    /**
     * @return \Cake\Http\Response|null|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $fertilizer = $this->Fertilizers->newEmptyEntity();

        if (!$this->userAuthenticated->can('create', $fertilizer)) {
            $this->Flash->error('Permissão negada!');
            return $this->redirect(['action' => 'index']);
        }
        
        if ($this->request->is('post')) {
            $fertilizer = $this->Fertilizers->patchEntity($fertilizer, $this->request->getData());
            
            if ($this->Fertilizers->save($fertilizer)) {
                $this->Flash->success('Inclusão realizada com sucesso');

                return $this->redirect(['action' => 'index']);
            }

            if (count($fertilizer->getErrors()) > 0) {
                foreach ($fertilizer->getErrors() as $error) {
                    foreach ($error as $message) {
                        $this->Flash->error($message);
                    }
                }
            } else {
                $this->Flash->error('Erro na inclusão de ' . __('Fertilizer') . '. Por favor, tente novamente');
            }
        }

        $suppliers = $this->fertilizerSuppliers;
        $fertilizerMeasureUnits = $this->Fertilizers->FertilizerMeasureUnits->find('list', ['limit' => 200]);
        $this->set(compact('fertilizer', 'suppliers', 'fertilizerMeasureUnits'));
    }

    /**
     * @param string|null $id Fertilizer id.
     * @return \Cake\Http\Response|null|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $fertilizer = $this->Fertilizers->get($id, [
            'contain' => [],
        ]);

        if (!$this->userAuthenticated->can('update', $fertilizer)) {
            $this->Flash->error('Permissão negada!');
            return $this->redirect(['action' => 'index']);
        }

        if ($this->request->is(['patch', 'post', 'put'])) {
            $fertilizer = $this->Fertilizers->patchEntity($fertilizer, $this->request->getData());
            
            if ($this->Fertilizers->save($fertilizer)) {
                $this->Flash->success('Edição realizada com sucesso');

                return $this->redirect(['action' => 'index']);
            }

            if (count($fertilizer->getErrors()) > 0) {
                foreach ($fertilizer->getErrors() as $error) {
                    foreach ($error as $message) {
                        $this->Flash->error($message);
                    }
                }
            } else {
                $this->Flash->error('Erro na edição de ' . __('Fertilizer') . '. Por favor, tente novamente');
            }
        }
        
        $suppliers = $this->fertilizerSuppliers;
        $fertilizerMeasureUnits = $this->Fertilizers->FertilizerMeasureUnits->find('list', ['limit' => 200]);
        $this->set(compact('fertilizer', 'suppliers', 'fertilizerMeasureUnits'));
    }

    /**
     * @param string|null $id Fertilizer id.
     * @return \Cake\Http\Response|null|void Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $fertilizer = $this->Fertilizers->get($id);

        if (!$this->userAuthenticated->can('delete', $fertilizer)) {
            $this->Flash->error('Permissão negada!');
            return $this->redirect(['action' => 'index']);
        }

        if ($this->Fertilizers->delete($fertilizer))
            $this->Flash->success('Exclusão realizada com sucesso');
        else {
            if (count($fertilizer->getErrors()) > 0) {
                foreach ($fertilizer->getErrors() as $error) {
                    foreach ($error as $message) {
                        $this->Flash->error($message);
                    }
                }
            } else {
                $this->Flash->error('Erro na exclusão de ' . __('Fertilizer') . '. Por favor, tente novamente');
            }
        }

        return $this->redirect(['action' => 'index']);
    }
}
