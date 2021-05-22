<?php
declare(strict_types=1);

namespace App\Controller;

use App\Model\Enum;

/**
 * @property \App\Model\Table\ChemicalsTable $Chemicals
 * @method \App\Model\Entity\Chemical[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class ChemicalsController extends AppController
{
    private $chemicalSuppliers;

    public function beforeFilter(\Cake\Event\EventInterface $event)
    {
        parent::beforeFilter($event);

        $this->viewBuilder()->setLayout('admin');

        $this->set('crumbs', ['Cadastro', __('Chemicals')]);

        $this->set('canCreate', $this->userAuthenticated && $this->userAuthenticated->can('create', $this->Chemicals->newEmptyEntity()));

        $this->chemicalSuppliers = $this->Chemicals->Suppliers->find('list')
            ->innerJoinWith(
                'SupplierTypes', function ($q) {
                    return $q->where(['SupplierTypes.id' => Enum\SupplierTypesEnum::Quimicos]);
                }
            );
    }
    
    /**
     * @return \Cake\Http\Response|null|void Renders view
     */
    public function index()
    {
        if (!$this->userAuthenticated->can('access', $this->Chemicals->newEmptyEntity())) {
            $this->Flash->error('Permissão negada!');
            return $this->redirect(['controller' => 'dashboard', 'action' => 'index']);
        }

        $this->paginate = [
            'contain' => ['ChemicalNotes', 'ChemicalClasses', 'Suppliers', 'ChemicalMeasureUnits', 'ChemicalTargets', 'ChemicalGroups'],
        ];
        $chemicals = $this->paginate($this->Chemicals);

        $this->set(compact('chemicals'));
    }

    /**
     * @param string|null $id Chemical id.
     * @return \Cake\Http\Response|null|void Renders view
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $chemical = $this->Chemicals->get($id, [
            'contain' => ['ChemicalNotes', 'ChemicalClasses', 'Suppliers', 'ChemicalMeasureUnits', 'ChemicalTargets', 'ChemicalGroups', 'ApplicationSeasons', 'ChemicalActionModes', 'Cultures'],
        ]);

        if (!$this->userAuthenticated->can('view', $chemical)) {
            $this->Flash->error('Permissão negada!');
            return $this->redirect($this->referer());
        }

        $this->set('chemical', $chemical);
    }

    /**
     * @return \Cake\Http\Response|null|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $chemical = $this->Chemicals->newEmptyEntity();

        if (!$this->userAuthenticated->can('create', $chemical)) {
            $this->Flash->error('Permissão negada!');
            return $this->redirect(['action' => 'index']);
        }
        
        if ($this->request->is('post')) {
            $chemical = $this->Chemicals->patchEntity($chemical, $this->request->getData());
            
            if ($this->Chemicals->save($chemical)) {
                $this->Flash->success('Inclusão realizada com sucesso');

                return $this->redirect(['action' => 'index']);
            }

            if (count($chemical->getErrors()) > 0) {
                foreach ($chemical->getErrors() as $error) {
                    foreach ($error as $message) {
                        $this->Flash->error($message);
                    }
                }
            } else {
                $this->Flash->error('Erro na inclusão de ' . __('Chemical') . '. Por favor, tente novamente');
            }
        }

        $chemicalNotes = $this->Chemicals->ChemicalNotes->find('list', ['limit' => 200]);
        $chemicalClasses = $this->Chemicals->ChemicalClasses->find('list', ['limit' => 200]);
        $suppliers = $this->chemicalSuppliers;
        $chemicalMeasureUnits = $this->Chemicals->ChemicalMeasureUnits->find('list', ['limit' => 200]);
        $chemicalTargets = $this->Chemicals->ChemicalTargets->find('list', ['limit' => 200]);
        $applicationSeasons = $this->Chemicals->ApplicationSeasons->find('list', ['limit' => 200]);
        $chemicalActionModes = $this->Chemicals->ChemicalActionModes->find('list', ['limit' => 200]);
        $chemicalGroups = $this->Chemicals->ChemicalGroups->find('list', ['limit' => 200]);
        $cultures = $this->Chemicals->Cultures->find('list', ['limit' => 200]);
        $this->set(compact('chemical', 'chemicalNotes', 'chemicalClasses', 'suppliers', 'chemicalMeasureUnits', 'chemicalGroups', 'chemicalTargets', 'applicationSeasons', 'chemicalActionModes', 'cultures'));
    }

    /**
     * @param string|null $id Chemical id.
     * @return \Cake\Http\Response|null|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $chemical = $this->Chemicals->get($id, [
            'contain' => ['ApplicationSeasons', 'ChemicalActionModes', 'Cultures', 'ChemicalGroups'],
        ]);

        if (!$this->userAuthenticated->can('update', $chemical)) {
            $this->Flash->error('Permissão negada!');
            return $this->redirect(['action' => 'index']);
        }

        if ($this->request->is(['patch', 'post', 'put'])) {
            $chemical = $this->Chemicals->patchEntity($chemical, $this->request->getData());
            
            if ($this->Chemicals->save($chemical)) {
                $this->Flash->success('Edição realizada com sucesso');

                return $this->redirect(['action' => 'index']);
            }

            if (count($chemical->getErrors()) > 0) {
                foreach ($chemical->getErrors() as $error) {
                    foreach ($error as $message) {
                        $this->Flash->error($message);
                    }
                }
            } else {
                $this->Flash->error('Erro na edição de ' . __('Chemical') . '. Por favor, tente novamente');
            }
        }
        
        $chemicalNotes = $this->Chemicals->ChemicalNotes->find('list', ['limit' => 200]);
        $chemicalClasses = $this->Chemicals->ChemicalClasses->find('list', ['limit' => 200]);
        $suppliers = $this->chemicalSuppliers;
        $chemicalMeasureUnits = $this->Chemicals->ChemicalMeasureUnits->find('list', ['limit' => 200]);
        $chemicalTargets = $this->Chemicals->ChemicalTargets->find('list', ['limit' => 200]);
        $applicationSeasons = $this->Chemicals->ApplicationSeasons->find('list', ['limit' => 200]);
        $chemicalActionModes = $this->Chemicals->ChemicalActionModes->find('list', ['limit' => 200]);
        $chemicalGroups = $this->Chemicals->ChemicalGroups->find('list', ['limit' => 200]);
        $cultures = $this->Chemicals->Cultures->find('list', ['limit' => 200]);
        $this->set(compact('chemical', 'chemicalNotes', 'chemicalClasses', 'suppliers', 'chemicalMeasureUnits', 'chemicalGroups', 'chemicalTargets', 'applicationSeasons', 'chemicalActionModes', 'cultures'));
    }

    /**
     * @param string|null $id Chemical id.
     * @return \Cake\Http\Response|null|void Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $chemical = $this->Chemicals->get($id);

        if (!$this->userAuthenticated->can('delete', $chemical)) {
            $this->Flash->error('Permissão negada!');
            return $this->redirect(['action' => 'index']);
        }

        if ($this->Chemicals->delete($chemical))
            $this->Flash->success('Exclusão realizada com sucesso');
        else {
            if (count($chemical->getErrors()) > 0) {
                foreach ($chemical->getErrors() as $error) {
                    foreach ($error as $message) {
                        $this->Flash->error($message);
                    }
                }
            } else {
                $this->Flash->error('Erro na exclusão de ' . __('Chemical') . '. Por favor, tente novamente');
            }
        }

        return $this->redirect(['action' => 'index']);
    }
}
