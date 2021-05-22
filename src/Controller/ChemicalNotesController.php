<?php
declare(strict_types=1);

namespace App\Controller;

/**
 * @property \App\Model\Table\ChemicalNotesTable $ChemicalNotes
 * @method \App\Model\Entity\ChemicalNote[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class ChemicalNotesController extends AppController
{
    public function beforeFilter(\Cake\Event\EventInterface $event)
    {
        parent::beforeFilter($event);

        $this->viewBuilder()->setLayout('admin');

        $this->set('crumbs', ['Cadastro', __('ChemicalNotes')]);

        $this->set('canCreate', $this->userAuthenticated && $this->userAuthenticated->can('create', $this->ChemicalNotes->newEmptyEntity()));
    }
    
    /**
     * @return \Cake\Http\Response|null|void Renders view
     */
    public function index()
    {
        if (!$this->userAuthenticated->can('access', $this->ChemicalNotes->newEmptyEntity())) {
            $this->Flash->error('Permissão negada!');
            return $this->redirect(['controller' => 'dashboard', 'action' => 'index']);
        }

        $chemicalNotes = $this->paginate($this->ChemicalNotes);

        $this->set(compact('chemicalNotes'));
    }

    /**
     * @param string|null $id Chemical Note id.
     * @return \Cake\Http\Response|null|void Renders view
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $chemicalNote = $this->ChemicalNotes->get($id, [
            'contain' => ['Chemicals'],
        ]);

        if (!$this->userAuthenticated->can('view', $chemicalNote)) {
            $this->Flash->error('Permissão negada!');
            return $this->redirect($this->referer());
        }

        $this->set('chemicalNote', $chemicalNote);
    }

    /**
     * @return \Cake\Http\Response|null|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $chemicalNote = $this->ChemicalNotes->newEmptyEntity();

        if (!$this->userAuthenticated->can('create', $chemicalNote)) {
            $this->Flash->error('Permissão negada!');
            return $this->redirect(['action' => 'index']);
        }
        
        if ($this->request->is('post')) {
            $chemicalNote = $this->ChemicalNotes->patchEntity($chemicalNote, $this->request->getData());
            
            if ($this->ChemicalNotes->save($chemicalNote)) {
                $this->Flash->success('Inclusão realizada com sucesso');

                return $this->redirect(['action' => 'index']);
            }

            if (count($chemicalNote->getErrors()) > 0) {
                foreach ($chemicalNote->getErrors() as $error) {
                    foreach ($error as $message) {
                        $this->Flash->error($message);
                    }
                }
            } else {
                $this->Flash->error('Erro na inclusão de ' . __('Chemical Note') . '. Por favor, tente novamente');
            }
        }

        $this->set(compact('chemicalNote'));
    }

    /**
     * @param string|null $id Chemical Note id.
     * @return \Cake\Http\Response|null|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $chemicalNote = $this->ChemicalNotes->get($id, [
            'contain' => [],
        ]);

        if (!$this->userAuthenticated->can('update', $chemicalNote)) {
            $this->Flash->error('Permissão negada!');
            return $this->redirect(['action' => 'index']);
        }

        if ($this->request->is(['patch', 'post', 'put'])) {
            $chemicalNote = $this->ChemicalNotes->patchEntity($chemicalNote, $this->request->getData());
            
            if ($this->ChemicalNotes->save($chemicalNote)) {
                $this->Flash->success('Edição realizada com sucesso');

                return $this->redirect(['action' => 'index']);
            }

            if (count($chemicalNote->getErrors()) > 0) {
                foreach ($chemicalNote->getErrors() as $error) {
                    foreach ($error as $message) {
                        $this->Flash->error($message);
                    }
                }
            } else {
                $this->Flash->error('Erro na edição de ' . __('Chemical Note') . '. Por favor, tente novamente');
            }
        }
        
        $this->set(compact('chemicalNote'));
    }

    /**
     * @param string|null $id Chemical Note id.
     * @return \Cake\Http\Response|null|void Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $chemicalNote = $this->ChemicalNotes->get($id);

        if (!$this->userAuthenticated->can('delete', $chemicalNote)) {
            $this->Flash->error('Permissão negada!');
            return $this->redirect(['action' => 'index']);
        }

        if ($this->ChemicalNotes->delete($chemicalNote))
            $this->Flash->success('Exclusão realizada com sucesso');
        else {
            if (count($chemicalNote->getErrors()) > 0) {
                foreach ($chemicalNote->getErrors() as $error) {
                    foreach ($error as $message) {
                        $this->Flash->error($message);
                    }
                }
            } else {
                $this->Flash->error('Erro na exclusão de ' . __('Chemical Note') . '. Por favor, tente novamente');
            }
        }

        return $this->redirect(['action' => 'index']);
    }
}
