<?php
declare(strict_types=1);

namespace App\Controller;

/**
 * @property \App\Model\Table\ChemicalGroupsTable $ChemicalGroups
 * @method \App\Model\Entity\ChemicalGroup[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class ChemicalGroupsController extends AppController
{
    public function beforeFilter(\Cake\Event\EventInterface $event)
    {
        parent::beforeFilter($event);

        $this->viewBuilder()->setLayout('admin');

        $this->set('crumbs', ['Cadastro', __('Chemicals'), __('ChemicalGroups')]);

        $this->set('canCreate', $this->userAuthenticated && $this->userAuthenticated->can('create', $this->ChemicalGroups->newEmptyEntity()));
    }
    
    /**
     * @return \Cake\Http\Response|null|void Renders view
     */
    public function index()
    {
        if (!$this->userAuthenticated->can('access', $this->ChemicalGroups->newEmptyEntity())) {
            $this->Flash->error('Permissão negada!');
            return $this->redirect(['controller' => 'dashboard', 'action' => 'index']);
        }

        $chemicalGroups = $this->paginate($this->ChemicalGroups);

        $this->set(compact('chemicalGroups'));
    }

    /**
     * @param string|null $id Chemical Group id.
     * @return \Cake\Http\Response|null|void Renders view
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $chemicalGroup = $this->ChemicalGroups->get($id, [
            'contain' => [],
        ]);

        if (!$this->userAuthenticated->can('view', $chemicalGroup)) {
            $this->Flash->error('Permissão negada!');
            return $this->redirect($this->referer());
        }

        $this->set('chemicalGroup', $chemicalGroup);
    }

    /**
     * @return \Cake\Http\Response|null|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $chemicalGroup = $this->ChemicalGroups->newEmptyEntity();

        if (!$this->userAuthenticated->can('create', $chemicalGroup)) {
            $this->Flash->error('Permissão negada!');
            return $this->redirect(['action' => 'index']);
        }
        
        if ($this->request->is('post')) {
            $chemicalGroup = $this->ChemicalGroups->patchEntity($chemicalGroup, $this->request->getData());
            
            if ($this->ChemicalGroups->save($chemicalGroup)) {
                $this->Flash->success('Inclusão realizada com sucesso');

                return $this->redirect(['action' => 'index']);
            }

            if (count($chemicalGroup->getErrors()) > 0) {
                foreach ($chemicalGroup->getErrors() as $error) {
                    foreach ($error as $message) {
                        $this->Flash->error($message);
                    }
                }
            } else {
                $this->Flash->error('Erro na inclusão de ' . __('Chemical Group') . '. Por favor, tente novamente');
            }
        }

        $this->set(compact('chemicalGroup'));
    }

    /**
     * @param string|null $id Chemical Group id.
     * @return \Cake\Http\Response|null|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $chemicalGroup = $this->ChemicalGroups->get($id, [
            'contain' => [],
        ]);

        if (!$this->userAuthenticated->can('update', $chemicalGroup)) {
            $this->Flash->error('Permissão negada!');
            return $this->redirect(['action' => 'index']);
        }

        if ($this->request->is(['patch', 'post', 'put'])) {
            $chemicalGroup = $this->ChemicalGroups->patchEntity($chemicalGroup, $this->request->getData());
            
            if ($this->ChemicalGroups->save($chemicalGroup)) {
                $this->Flash->success('Edição realizada com sucesso');

                return $this->redirect(['action' => 'index']);
            }

            if (count($chemicalGroup->getErrors()) > 0) {
                foreach ($chemicalGroup->getErrors() as $error) {
                    foreach ($error as $message) {
                        $this->Flash->error($message);
                    }
                }
            } else {
                $this->Flash->error('Erro na edição de ' . __('Chemical Group') . '. Por favor, tente novamente');
            }
        }
        
        $this->set(compact('chemicalGroup'));
    }

    /**
     * @param string|null $id Chemical Group id.
     * @return \Cake\Http\Response|null|void Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $chemicalGroup = $this->ChemicalGroups->get($id);

        if (!$this->userAuthenticated->can('delete', $chemicalGroup)) {
            $this->Flash->error('Permissão negada!');
            return $this->redirect(['action' => 'index']);
        }

        if ($this->ChemicalGroups->delete($chemicalGroup))
            $this->Flash->success('Exclusão realizada com sucesso');
        else {
            if (count($chemicalGroup->getErrors()) > 0) {
                foreach ($chemicalGroup->getErrors() as $error) {
                    foreach ($error as $message) {
                        $this->Flash->error($message);
                    }
                }
            } else {
                $this->Flash->error('Erro na exclusão de ' . __('Chemical Group') . '. Por favor, tente novamente');
            }
        }

        return $this->redirect(['action' => 'index']);
    }
}
