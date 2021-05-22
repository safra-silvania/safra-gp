<?php
declare(strict_types=1);

namespace App\Controller;

/**
 * @property \App\Model\Table\FertilizerMeasureUnitsTable $FertilizerMeasureUnits
 * @method \App\Model\Entity\FertilizerMeasureUnit[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class FertilizerMeasureUnitsController extends AppController
{
    public function beforeFilter(\Cake\Event\EventInterface $event)
    {
        parent::beforeFilter($event);

        $this->viewBuilder()->setLayout('admin');

        $this->set('crumbs', ['Cadastro',  __('Fertilizers'), __('FertilizerMeasureUnits')]);

        $this->set('canCreate', $this->userAuthenticated && $this->userAuthenticated->can('create', $this->FertilizerMeasureUnits->newEmptyEntity()));
    }
    
    /**
     * @return \Cake\Http\Response|null|void Renders view
     */
    public function index()
    {
        if (!$this->userAuthenticated->can('access', $this->FertilizerMeasureUnits->newEmptyEntity())) {
            $this->Flash->error('Permissão negada!');
            return $this->redirect(['controller' => 'dashboard', 'action' => 'index']);
        }

        $fertilizerMeasureUnits = $this->paginate($this->FertilizerMeasureUnits);

        $this->set(compact('fertilizerMeasureUnits'));
    }

    /**
     * @param string|null $id Fertilizer Measure Unit id.
     * @return \Cake\Http\Response|null|void Renders view
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $fertilizerMeasureUnit = $this->FertilizerMeasureUnits->get($id, [
            'contain' => ['Fertilizers'],
        ]);

        if (!$this->userAuthenticated->can('view', $fertilizerMeasureUnit)) {
            $this->Flash->error('Permissão negada!');
            return $this->redirect($this->referer());
        }

        $this->set('fertilizerMeasureUnit', $fertilizerMeasureUnit);
    }

    /**
     * @return \Cake\Http\Response|null|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $fertilizerMeasureUnit = $this->FertilizerMeasureUnits->newEmptyEntity();

        if (!$this->userAuthenticated->can('create', $fertilizerMeasureUnit)) {
            $this->Flash->error('Permissão negada!');
            return $this->redirect(['action' => 'index']);
        }
        
        if ($this->request->is('post')) {
            $fertilizerMeasureUnit = $this->FertilizerMeasureUnits->patchEntity($fertilizerMeasureUnit, $this->request->getData());
            
            if ($this->FertilizerMeasureUnits->save($fertilizerMeasureUnit)) {
                $this->Flash->success('Inclusão realizada com sucesso');

                return $this->redirect(['action' => 'index']);
            }

            if (count($fertilizerMeasureUnit->getErrors()) > 0) {
                foreach ($fertilizerMeasureUnit->getErrors() as $error) {
                    foreach ($error as $message) {
                        $this->Flash->error($message);
                    }
                }
            } else {
                $this->Flash->error('Erro na inclusão de ' . __('Fertilizer Measure Unit') . '. Por favor, tente novamente');
            }
        }

        $this->set(compact('fertilizerMeasureUnit'));
    }

    /**
     * @param string|null $id Fertilizer Measure Unit id.
     * @return \Cake\Http\Response|null|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $fertilizerMeasureUnit = $this->FertilizerMeasureUnits->get($id, [
            'contain' => [],
        ]);

        if (!$this->userAuthenticated->can('update', $fertilizerMeasureUnit)) {
            $this->Flash->error('Permissão negada!');
            return $this->redirect(['action' => 'index']);
        }

        if ($this->request->is(['patch', 'post', 'put'])) {
            $fertilizerMeasureUnit = $this->FertilizerMeasureUnits->patchEntity($fertilizerMeasureUnit, $this->request->getData());
            
            if ($this->FertilizerMeasureUnits->save($fertilizerMeasureUnit)) {
                $this->Flash->success('Edição realizada com sucesso');

                return $this->redirect(['action' => 'index']);
            }

            if (count($fertilizerMeasureUnit->getErrors()) > 0) {
                foreach ($fertilizerMeasureUnit->getErrors() as $error) {
                    foreach ($error as $message) {
                        $this->Flash->error($message);
                    }
                }
            } else {
                $this->Flash->error('Erro na edição de ' . __('Fertilizer Measure Unit') . '. Por favor, tente novamente');
            }
        }
        
        $this->set(compact('fertilizerMeasureUnit'));
    }

    /**
     * @param string|null $id Fertilizer Measure Unit id.
     * @return \Cake\Http\Response|null|void Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $fertilizerMeasureUnit = $this->FertilizerMeasureUnits->get($id);

        if (!$this->userAuthenticated->can('delete', $fertilizerMeasureUnit)) {
            $this->Flash->error('Permissão negada!');
            return $this->redirect(['action' => 'index']);
        }

        if ($this->FertilizerMeasureUnits->delete($fertilizerMeasureUnit))
            $this->Flash->success('Exclusão realizada com sucesso');
        else {
            if (count($fertilizerMeasureUnit->getErrors()) > 0) {
                foreach ($fertilizerMeasureUnit->getErrors() as $error) {
                    foreach ($error as $message) {
                        $this->Flash->error($message);
                    }
                }
            } else {
                $this->Flash->error('Erro na exclusão de ' . __('Fertilizer Measure Unit') . '. Por favor, tente novamente');
            }
        }

        return $this->redirect(['action' => 'index']);
    }
}
