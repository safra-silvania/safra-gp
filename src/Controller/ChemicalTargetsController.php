<?php
declare(strict_types=1);

namespace App\Controller;

/**
 * @property \App\Model\Table\ChemicalTargetsTable $ChemicalTargets
 * @method \App\Model\Entity\ChemicalTarget[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class ChemicalTargetsController extends AppController
{
    public function beforeFilter(\Cake\Event\EventInterface $event)
    {
        parent::beforeFilter($event);

        $this->viewBuilder()->setLayout('admin');

        $this->set('crumbs', ['Cadastro', __('Chemicals'), __('ChemicalTargets')]);

        $this->set('canCreate', $this->userAuthenticated && $this->userAuthenticated->can('create', $this->ChemicalTargets->newEmptyEntity()));
    }
    
    /**
     * @return \Cake\Http\Response|null|void Renders view
     */
    public function index()
    {
        if (!$this->userAuthenticated->can('access', $this->ChemicalTargets->newEmptyEntity())) {
            $this->Flash->error('Permissão negada!');
            return $this->redirect(['controller' => 'dashboard', 'action' => 'index']);
        }

        $chemicalTargets = $this->paginate($this->ChemicalTargets);

        $this->set(compact('chemicalTargets'));
    }

    /**
     * @param string|null $id Chemical Target id.
     * @return \Cake\Http\Response|null|void Renders view
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $chemicalTarget = $this->ChemicalTargets->get($id, [
            'contain' => ['Chemicals'],
        ]);

        if (!$this->userAuthenticated->can('view', $chemicalTarget)) {
            $this->Flash->error('Permissão negada!');
            return $this->redirect($this->referer());
        }

        $this->set('chemicalTarget', $chemicalTarget);
    }

    /**
     * @return \Cake\Http\Response|null|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $chemicalTarget = $this->ChemicalTargets->newEmptyEntity();

        if (!$this->userAuthenticated->can('create', $chemicalTarget)) {
            $this->Flash->error('Permissão negada!');
            return $this->redirect(['action' => 'index']);
        }
        
        if ($this->request->is('post')) {
            $chemicalTarget = $this->ChemicalTargets->patchEntity($chemicalTarget, $this->request->getData());
            
            if ($this->ChemicalTargets->save($chemicalTarget)) {
                $this->Flash->success('Inclusão realizada com sucesso');

                return $this->redirect(['action' => 'index']);
            }

            if (count($chemicalTarget->getErrors()) > 0) {
                foreach ($chemicalTarget->getErrors() as $error) {
                    foreach ($error as $message) {
                        $this->Flash->error($message);
                    }
                }
            } else {
                $this->Flash->error('Erro na inclusão de ' . __('Chemical Target') . '. Por favor, tente novamente');
            }
        }

        $this->set(compact('chemicalTarget'));
    }

    /**
     * @param string|null $id Chemical Target id.
     * @return \Cake\Http\Response|null|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $chemicalTarget = $this->ChemicalTargets->get($id, [
            'contain' => [],
        ]);

        if (!$this->userAuthenticated->can('update', $chemicalTarget)) {
            $this->Flash->error('Permissão negada!');
            return $this->redirect(['action' => 'index']);
        }

        if ($this->request->is(['patch', 'post', 'put'])) {
            $chemicalTarget = $this->ChemicalTargets->patchEntity($chemicalTarget, $this->request->getData());
            
            if ($this->ChemicalTargets->save($chemicalTarget)) {
                $this->Flash->success('Edição realizada com sucesso');

                return $this->redirect(['action' => 'index']);
            }

            if (count($chemicalTarget->getErrors()) > 0) {
                foreach ($chemicalTarget->getErrors() as $error) {
                    foreach ($error as $message) {
                        $this->Flash->error($message);
                    }
                }
            } else {
                $this->Flash->error('Erro na edição de ' . __('Chemical Target') . '. Por favor, tente novamente');
            }
        }
        
        $this->set(compact('chemicalTarget'));
    }

    /**
     * @param string|null $id Chemical Target id.
     * @return \Cake\Http\Response|null|void Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $chemicalTarget = $this->ChemicalTargets->get($id);

        if (!$this->userAuthenticated->can('delete', $chemicalTarget)) {
            $this->Flash->error('Permissão negada!');
            return $this->redirect(['action' => 'index']);
        }

        if ($this->ChemicalTargets->delete($chemicalTarget))
            $this->Flash->success('Exclusão realizada com sucesso');
        else {
            if (count($chemicalTarget->getErrors()) > 0) {
                foreach ($chemicalTarget->getErrors() as $error) {
                    foreach ($error as $message) {
                        $this->Flash->error($message);
                    }
                }
            } else {
                $this->Flash->error('Erro na exclusão de ' . __('Chemical Target') . '. Por favor, tente novamente');
            }
        }

        return $this->redirect(['action' => 'index']);
    }
}
