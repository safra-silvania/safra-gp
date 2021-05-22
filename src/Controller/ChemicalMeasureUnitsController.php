<?php
declare(strict_types=1);

namespace App\Controller;

/**
 * @property \App\Model\Table\ChemicalMeasureUnitsTable $ChemicalMeasureUnits
 * @method \App\Model\Entity\ChemicalMeasureUnit[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class ChemicalMeasureUnitsController extends AppController
{
    public function beforeFilter(\Cake\Event\EventInterface $event)
    {
        parent::beforeFilter($event);

        $this->viewBuilder()->setLayout('admin');

        $this->set('crumbs', ['Cadastro', __('Chemicals'), __('ChemicalMeasureUnits')]);

        $this->set('canCreate', $this->userAuthenticated && $this->userAuthenticated->can('create', $this->ChemicalMeasureUnits->newEmptyEntity()));
    }
    
    /**
     * @return \Cake\Http\Response|null|void Renders view
     */
    public function index()
    {
        if (!$this->userAuthenticated->can('access', $this->ChemicalMeasureUnits->newEmptyEntity())) {
            $this->Flash->error('Permissão negada!');
            return $this->redirect(['controller' => 'dashboard', 'action' => 'index']);
        }

        $chemicalMeasureUnits = $this->paginate($this->ChemicalMeasureUnits);

        $this->set(compact('chemicalMeasureUnits'));
    }

    /**
     * @param string|null $id Chemical Measure Unit id.
     * @return \Cake\Http\Response|null|void Renders view
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $chemicalMeasureUnit = $this->ChemicalMeasureUnits->get($id, [
            'contain' => ['Chemicals'],
        ]);

        if (!$this->userAuthenticated->can('view', $chemicalMeasureUnit)) {
            $this->Flash->error('Permissão negada!');
            return $this->redirect($this->referer());
        }

        $this->set('chemicalMeasureUnit', $chemicalMeasureUnit);
    }

    /**
     * @return \Cake\Http\Response|null|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $chemicalMeasureUnit = $this->ChemicalMeasureUnits->newEmptyEntity();

        if (!$this->userAuthenticated->can('create', $chemicalMeasureUnit)) {
            $this->Flash->error('Permissão negada!');
            return $this->redirect(['action' => 'index']);
        }
        
        if ($this->request->is('post')) {
            $chemicalMeasureUnit = $this->ChemicalMeasureUnits->patchEntity($chemicalMeasureUnit, $this->request->getData());
            
            if ($this->ChemicalMeasureUnits->save($chemicalMeasureUnit)) {
                $this->Flash->success('Inclusão realizada com sucesso');

                return $this->redirect(['action' => 'index']);
            }

            if (count($chemicalMeasureUnit->getErrors()) > 0) {
                foreach ($chemicalMeasureUnit->getErrors() as $error) {
                    foreach ($error as $message) {
                        $this->Flash->error($message);
                    }
                }
            } else {
                $this->Flash->error('Erro na inclusão de ' . __('Chemical Measure Unit') . '. Por favor, tente novamente');
            }
        }

        $this->set(compact('chemicalMeasureUnit'));
    }

    /**
     * @param string|null $id Chemical Measure Unit id.
     * @return \Cake\Http\Response|null|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $chemicalMeasureUnit = $this->ChemicalMeasureUnits->get($id, [
            'contain' => [],
        ]);

        if (!$this->userAuthenticated->can('update', $chemicalMeasureUnit)) {
            $this->Flash->error('Permissão negada!');
            return $this->redirect(['action' => 'index']);
        }

        if ($this->request->is(['patch', 'post', 'put'])) {
            $chemicalMeasureUnit = $this->ChemicalMeasureUnits->patchEntity($chemicalMeasureUnit, $this->request->getData());
            
            if ($this->ChemicalMeasureUnits->save($chemicalMeasureUnit)) {
                $this->Flash->success('Edição realizada com sucesso');

                return $this->redirect(['action' => 'index']);
            }

            if (count($chemicalMeasureUnit->getErrors()) > 0) {
                foreach ($chemicalMeasureUnit->getErrors() as $error) {
                    foreach ($error as $message) {
                        $this->Flash->error($message);
                    }
                }
            } else {
                $this->Flash->error('Erro na edição de ' . __('Chemical Measure Unit') . '. Por favor, tente novamente');
            }
        }
        
        $this->set(compact('chemicalMeasureUnit'));
    }

    /**
     * @param string|null $id Chemical Measure Unit id.
     * @return \Cake\Http\Response|null|void Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $chemicalMeasureUnit = $this->ChemicalMeasureUnits->get($id);

        if (!$this->userAuthenticated->can('delete', $chemicalMeasureUnit)) {
            $this->Flash->error('Permissão negada!');
            return $this->redirect(['action' => 'index']);
        }

        if ($this->ChemicalMeasureUnits->delete($chemicalMeasureUnit))
            $this->Flash->success('Exclusão realizada com sucesso');
        else {
            if (count($chemicalMeasureUnit->getErrors()) > 0) {
                foreach ($chemicalMeasureUnit->getErrors() as $error) {
                    foreach ($error as $message) {
                        $this->Flash->error($message);
                    }
                }
            } else {
                $this->Flash->error('Erro na exclusão de ' . __('Chemical Measure Unit') . '. Por favor, tente novamente');
            }
        }

        return $this->redirect(['action' => 'index']);
    }
}
