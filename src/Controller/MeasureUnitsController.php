<?php
declare(strict_types=1);

namespace App\Controller;

/**
 * @property \App\Model\Table\MeasureUnitsTable $MeasureUnits
 * @method \App\Model\Entity\MeasureUnit[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class MeasureUnitsController extends AppController
{
    public function beforeFilter(\Cake\Event\EventInterface $event)
    {
        parent::beforeFilter($event);

        $this->viewBuilder()->setLayout('admin');

        $this->set('crumbs', ['Cadastro', 'Outros', __('MeasureUnits')]);

        $this->set('canCreate', $this->userAuthenticated && $this->userAuthenticated->can('create', $this->MeasureUnits->newEmptyEntity()));
    }
    
    /**
     * @return \Cake\Http\Response|null|void Renders view
     */
    public function index()
    {
        if (!$this->userAuthenticated->can('access', $this->MeasureUnits->newEmptyEntity())) {
            $this->Flash->error('Permissão negada!');
            return $this->redirect(['controller' => 'dashboard', 'action' => 'index']);
        }

        $measureUnits = $this->paginate($this->MeasureUnits);

        $this->set(compact('measureUnits'));
    }

    /**
     * @param string|null $id Measure Unit id.
     * @return \Cake\Http\Response|null|void Renders view
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $measureUnit = $this->MeasureUnits->get($id, [
            'contain' => ['Fields'],
        ]);

        if (!$this->userAuthenticated->can('view', $measureUnit)) {
            $this->Flash->error('Permissão negada!');
            return $this->redirect($this->referer());
        }

        $this->set('measureUnit', $measureUnit);
    }

    /**
     * @return \Cake\Http\Response|null|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $measureUnit = $this->MeasureUnits->newEmptyEntity();

        if (!$this->userAuthenticated->can('create', $measureUnit)) {
            $this->Flash->error('Permissão negada!');
            return $this->redirect(['action' => 'index']);
        }
        
        if ($this->request->is('post')) {
            $measureUnit = $this->MeasureUnits->patchEntity($measureUnit, $this->request->getData());
            
            if ($this->MeasureUnits->save($measureUnit)) {
                $this->Flash->success('Inclusão realizada com sucesso');

                return $this->redirect(['action' => 'index']);
            }

            if (count($measureUnit->getErrors()) > 0) {
                foreach ($measureUnit->getErrors() as $error) {
                    foreach ($error as $message) {
                        $this->Flash->error($message);
                    }
                }
            } else {
                $this->Flash->error('Erro na inclusão de ' . __('Measure Unit') . '. Por favor, tente novamente');
            }
        }

        $this->set(compact('measureUnit'));
    }

    /**
     * @param string|null $id Measure Unit id.
     * @return \Cake\Http\Response|null|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $measureUnit = $this->MeasureUnits->get($id, [
            'contain' => [],
        ]);

        if (!$this->userAuthenticated->can('update', $measureUnit)) {
            $this->Flash->error('Permissão negada!');
            return $this->redirect(['action' => 'index']);
        }

        if ($this->request->is(['patch', 'post', 'put'])) {
            $measureUnit = $this->MeasureUnits->patchEntity($measureUnit, $this->request->getData());
            
            if ($this->MeasureUnits->save($measureUnit)) {
                $this->Flash->success('Edição realizada com sucesso');

                return $this->redirect(['action' => 'index']);
            }

            if (count($measureUnit->getErrors()) > 0) {
                foreach ($measureUnit->getErrors() as $error) {
                    foreach ($error as $message) {
                        $this->Flash->error($message);
                    }
                }
            } else {
                $this->Flash->error('Erro na edição de ' . __('Measure Unit') . '. Por favor, tente novamente');
            }
        }
        
        $this->set(compact('measureUnit'));
    }

    /**
     * @param string|null $id Measure Unit id.
     * @return \Cake\Http\Response|null|void Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $measureUnit = $this->MeasureUnits->get($id);

        if (!$this->userAuthenticated->can('delete', $measureUnit)) {
            $this->Flash->error('Permissão negada!');
            return $this->redirect(['action' => 'index']);
        }

        if ($this->MeasureUnits->delete($measureUnit))
            $this->Flash->success('Exclusão realizada com sucesso');
        else {
            if (count($measureUnit->getErrors()) > 0) {
                foreach ($measureUnit->getErrors() as $error) {
                    foreach ($error as $message) {
                        $this->Flash->error($message);
                    }
                }
            } else {
                $this->Flash->error('Erro na exclusão de ' . __('Measure Unit') . '. Por favor, tente novamente');
            }
        }

        return $this->redirect(['action' => 'index']);
    }
}
