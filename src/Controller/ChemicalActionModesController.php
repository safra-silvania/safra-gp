<?php
declare(strict_types=1);

namespace App\Controller;

/**
 * @property \App\Model\Table\ChemicalActionModesTable $ChemicalActionModes
 * @method \App\Model\Entity\ChemicalActionMode[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class ChemicalActionModesController extends AppController
{
    public function beforeFilter(\Cake\Event\EventInterface $event)
    {
        parent::beforeFilter($event);

        $this->viewBuilder()->setLayout('admin');

        $this->set('crumbs', ['Cadastro', __('Chemicals'), __('ChemicalActionModes')]);

        $this->set('canCreate', $this->userAuthenticated && $this->userAuthenticated->can('create', $this->ChemicalActionModes->newEmptyEntity()));
    }
    
    /**
     * @return \Cake\Http\Response|null|void Renders view
     */
    public function index()
    {
        if (!$this->userAuthenticated->can('access', $this->ChemicalActionModes->newEmptyEntity())) {
            $this->Flash->error('Permissão negada!');
            return $this->redirect(['controller' => 'dashboard', 'action' => 'index']);
        }

        $chemicalActionModes = $this->paginate($this->ChemicalActionModes);

        $this->set(compact('chemicalActionModes'));
    }

    /**
     * @param string|null $id Chemical Action Mode id.
     * @return \Cake\Http\Response|null|void Renders view
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $chemicalActionMode = $this->ChemicalActionModes->get($id, [
            'contain' => ['Chemicals'],
        ]);

        if (!$this->userAuthenticated->can('view', $chemicalActionMode)) {
            $this->Flash->error('Permissão negada!');
            return $this->redirect($this->referer());
        }

        $this->set('chemicalActionMode', $chemicalActionMode);
    }

    /**
     * @return \Cake\Http\Response|null|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $chemicalActionMode = $this->ChemicalActionModes->newEmptyEntity();

        if (!$this->userAuthenticated->can('create', $chemicalActionMode)) {
            $this->Flash->error('Permissão negada!');
            return $this->redirect(['action' => 'index']);
        }
        
        if ($this->request->is('post')) {
            $chemicalActionMode = $this->ChemicalActionModes->patchEntity($chemicalActionMode, $this->request->getData());
            
            if ($this->ChemicalActionModes->save($chemicalActionMode)) {
                $this->Flash->success('Inclusão realizada com sucesso');

                return $this->redirect(['action' => 'index']);
            }

            if (count($chemicalActionMode->getErrors()) > 0) {
                foreach ($chemicalActionMode->getErrors() as $error) {
                    foreach ($error as $message) {
                        $this->Flash->error($message);
                    }
                }
            } else {
                $this->Flash->error('Erro na inclusão de ' . __('Chemical Action Mode') . '. Por favor, tente novamente');
            }
        }

        $chemicals = $this->ChemicalActionModes->Chemicals->find('list', ['limit' => 200]);
        $this->set(compact('chemicalActionMode', 'chemicals'));
    }

    /**
     * @param string|null $id Chemical Action Mode id.
     * @return \Cake\Http\Response|null|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $chemicalActionMode = $this->ChemicalActionModes->get($id, [
            'contain' => ['Chemicals'],
        ]);

        if (!$this->userAuthenticated->can('update', $chemicalActionMode)) {
            $this->Flash->error('Permissão negada!');
            return $this->redirect(['action' => 'index']);
        }

        if ($this->request->is(['patch', 'post', 'put'])) {
            $chemicalActionMode = $this->ChemicalActionModes->patchEntity($chemicalActionMode, $this->request->getData());
            
            if ($this->ChemicalActionModes->save($chemicalActionMode)) {
                $this->Flash->success('Edição realizada com sucesso');

                return $this->redirect(['action' => 'index']);
            }

            if (count($chemicalActionMode->getErrors()) > 0) {
                foreach ($chemicalActionMode->getErrors() as $error) {
                    foreach ($error as $message) {
                        $this->Flash->error($message);
                    }
                }
            } else {
                $this->Flash->error('Erro na edição de ' . __('Chemical Action Mode') . '. Por favor, tente novamente');
            }
        }
        
        $chemicals = $this->ChemicalActionModes->Chemicals->find('list', ['limit' => 200]);
        $this->set(compact('chemicalActionMode', 'chemicals'));
    }

    /**
     * @param string|null $id Chemical Action Mode id.
     * @return \Cake\Http\Response|null|void Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $chemicalActionMode = $this->ChemicalActionModes->get($id);

        if (!$this->userAuthenticated->can('delete', $chemicalActionMode)) {
            $this->Flash->error('Permissão negada!');
            return $this->redirect(['action' => 'index']);
        }

        if ($this->ChemicalActionModes->delete($chemicalActionMode))
            $this->Flash->success('Exclusão realizada com sucesso');
        else {
            if (count($chemicalActionMode->getErrors()) > 0) {
                foreach ($chemicalActionMode->getErrors() as $error) {
                    foreach ($error as $message) {
                        $this->Flash->error($message);
                    }
                }
            } else {
                $this->Flash->error('Erro na exclusão de ' . __('Chemical Action Mode') . '. Por favor, tente novamente');
            }
        }

        return $this->redirect(['action' => 'index']);
    }
}
