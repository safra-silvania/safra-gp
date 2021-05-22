<?php
declare(strict_types=1);

namespace App\Controller;

/**
 * @property \App\Model\Table\ChemicalClassesTable $ChemicalClasses
 * @method \App\Model\Entity\ChemicalClass[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class ChemicalClassesController extends AppController
{
    public function beforeFilter(\Cake\Event\EventInterface $event)
    {
        parent::beforeFilter($event);

        $this->viewBuilder()->setLayout('admin');

        $this->set('crumbs', ['Cadastro', __('Chemicals'), __('ChemicalClasses')]);

        $this->set('canCreate', $this->userAuthenticated && $this->userAuthenticated->can('create', $this->ChemicalClasses->newEmptyEntity()));
    }
    
    /**
     * @return \Cake\Http\Response|null|void Renders view
     */
    public function index()
    {
        if (!$this->userAuthenticated->can('access', $this->ChemicalClasses->newEmptyEntity())) {
            $this->Flash->error('Permissão negada!');
            return $this->redirect(['controller' => 'dashboard', 'action' => 'index']);
        }

        $chemicalClasses = $this->paginate($this->ChemicalClasses);

        $this->set(compact('chemicalClasses'));
    }

    /**
     * @param string|null $id Chemical Class id.
     * @return \Cake\Http\Response|null|void Renders view
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $chemicalClass = $this->ChemicalClasses->get($id, [
            'contain' => ['Chemicals'],
        ]);

        if (!$this->userAuthenticated->can('view', $chemicalClass)) {
            $this->Flash->error('Permissão negada!');
            return $this->redirect($this->referer());
        }

        $this->set('chemicalClass', $chemicalClass);
    }

    /**
     * @return \Cake\Http\Response|null|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $chemicalClass = $this->ChemicalClasses->newEmptyEntity();

        if (!$this->userAuthenticated->can('create', $chemicalClass)) {
            $this->Flash->error('Permissão negada!');
            return $this->redirect(['action' => 'index']);
        }
        
        if ($this->request->is('post')) {
            $chemicalClass = $this->ChemicalClasses->patchEntity($chemicalClass, $this->request->getData());
            
            if ($this->ChemicalClasses->save($chemicalClass)) {
                $this->Flash->success('Inclusão realizada com sucesso');

                return $this->redirect(['action' => 'index']);
            }

            if (count($chemicalClass->getErrors()) > 0) {
                foreach ($chemicalClass->getErrors() as $error) {
                    foreach ($error as $message) {
                        $this->Flash->error($message);
                    }
                }
            } else {
                $this->Flash->error('Erro na inclusão de ' . __('Chemical Class') . '. Por favor, tente novamente');
            }
        }

        $this->set(compact('chemicalClass'));
    }

    /**
     * @param string|null $id Chemical Class id.
     * @return \Cake\Http\Response|null|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $chemicalClass = $this->ChemicalClasses->get($id, [
            'contain' => [],
        ]);

        if (!$this->userAuthenticated->can('update', $chemicalClass)) {
            $this->Flash->error('Permissão negada!');
            return $this->redirect(['action' => 'index']);
        }

        if ($this->request->is(['patch', 'post', 'put'])) {
            $chemicalClass = $this->ChemicalClasses->patchEntity($chemicalClass, $this->request->getData());
            
            if ($this->ChemicalClasses->save($chemicalClass)) {
                $this->Flash->success('Edição realizada com sucesso');

                return $this->redirect(['action' => 'index']);
            }

            if (count($chemicalClass->getErrors()) > 0) {
                foreach ($chemicalClass->getErrors() as $error) {
                    foreach ($error as $message) {
                        $this->Flash->error($message);
                    }
                }
            } else {
                $this->Flash->error('Erro na edição de ' . __('Chemical Class') . '. Por favor, tente novamente');
            }
        }
        
        $this->set(compact('chemicalClass'));
    }

    /**
     * @param string|null $id Chemical Class id.
     * @return \Cake\Http\Response|null|void Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $chemicalClass = $this->ChemicalClasses->get($id);

        if (!$this->userAuthenticated->can('delete', $chemicalClass)) {
            $this->Flash->error('Permissão negada!');
            return $this->redirect(['action' => 'index']);
        }

        if ($this->ChemicalClasses->delete($chemicalClass))
            $this->Flash->success('Exclusão realizada com sucesso');
        else {
            if (count($chemicalClass->getErrors()) > 0) {
                foreach ($chemicalClass->getErrors() as $error) {
                    foreach ($error as $message) {
                        $this->Flash->error($message);
                    }
                }
            } else {
                $this->Flash->error('Erro na exclusão de ' . __('Chemical Class') . '. Por favor, tente novamente');
            }
        }

        return $this->redirect(['action' => 'index']);
    }
}
