<?php
declare(strict_types=1);

namespace App\Controller;

/**
 * @property \App\Model\Table\SeedNotesTable $SeedNotes
 * @method \App\Model\Entity\SeedNote[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class SeedNotesController extends AppController
{
    public function beforeFilter(\Cake\Event\EventInterface $event)
    {
        parent::beforeFilter($event);

        $this->viewBuilder()->setLayout('admin');

        $this->set('crumbs', ['Cadastro', __('Seeds'), __('SeedNotes')]);

        $this->set('canCreate', $this->userAuthenticated && $this->userAuthenticated->can('create', $this->SeedNotes->newEmptyEntity()));
    }
    
    /**
     * @return \Cake\Http\Response|null|void Renders view
     */
    public function index()
    {
        if (!$this->userAuthenticated->can('access', $this->SeedNotes->newEmptyEntity())) {
            $this->Flash->error('Permissão negada!');
            return $this->redirect(['controller' => 'dashboard', 'action' => 'index']);
        }

        $seedNotes = $this->paginate($this->SeedNotes);

        $this->set(compact('seedNotes'));
    }

    /**
     * @param string|null $id Seed Note id.
     * @return \Cake\Http\Response|null|void Renders view
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $seedNote = $this->SeedNotes->get($id, [
            'contain' => ['Seeds'],
        ]);

        if (!$this->userAuthenticated->can('view', $seedNote)) {
            $this->Flash->error('Permissão negada!');
            return $this->redirect($this->referer());
        }

        $this->set('seedNote', $seedNote);
    }

    /**
     * @return \Cake\Http\Response|null|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $seedNote = $this->SeedNotes->newEmptyEntity();

        if (!$this->userAuthenticated->can('create', $seedNote)) {
            $this->Flash->error('Permissão negada!');
            return $this->redirect(['action' => 'index']);
        }
        
        if ($this->request->is('post')) {
            $seedNote = $this->SeedNotes->patchEntity($seedNote, $this->request->getData());
            
            if ($this->SeedNotes->save($seedNote)) {
                $this->Flash->success('Inclusão realizada com sucesso');

                return $this->redirect(['action' => 'index']);
            }

            if (count($seedNote->getErrors()) > 0) {
                foreach ($seedNote->getErrors() as $error) {
                    foreach ($error as $message) {
                        $this->Flash->error($message);
                    }
                }
            } else {
                $this->Flash->error('Erro na inclusão de ' . __('Seed Note') . '. Por favor, tente novamente');
            }
        }

        $this->set(compact('seedNote'));
    }

    /**
     * @param string|null $id Seed Note id.
     * @return \Cake\Http\Response|null|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $seedNote = $this->SeedNotes->get($id, [
            'contain' => [],
        ]);

        if (!$this->userAuthenticated->can('update', $seedNote)) {
            $this->Flash->error('Permissão negada!');
            return $this->redirect(['action' => 'index']);
        }

        if ($this->request->is(['patch', 'post', 'put'])) {
            $seedNote = $this->SeedNotes->patchEntity($seedNote, $this->request->getData());
            
            if ($this->SeedNotes->save($seedNote)) {
                $this->Flash->success('Edição realizada com sucesso');

                return $this->redirect(['action' => 'index']);
            }

            if (count($seedNote->getErrors()) > 0) {
                foreach ($seedNote->getErrors() as $error) {
                    foreach ($error as $message) {
                        $this->Flash->error($message);
                    }
                }
            } else {
                $this->Flash->error('Erro na edição de ' . __('Seed Note') . '. Por favor, tente novamente');
            }
        }
        
        $this->set(compact('seedNote'));
    }

    /**
     * @param string|null $id Seed Note id.
     * @return \Cake\Http\Response|null|void Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $seedNote = $this->SeedNotes->get($id);

        if (!$this->userAuthenticated->can('delete', $seedNote)) {
            $this->Flash->error('Permissão negada!');
            return $this->redirect(['action' => 'index']);
        }

        if ($this->SeedNotes->delete($seedNote))
            $this->Flash->success('Exclusão realizada com sucesso');
        else {
            if (count($seedNote->getErrors()) > 0) {
                foreach ($seedNote->getErrors() as $error) {
                    foreach ($error as $message) {
                        $this->Flash->error($message);
                    }
                }
            } else {
                $this->Flash->error('Erro na exclusão de ' . __('Seed Note') . '. Por favor, tente novamente');
            }
        }

        return $this->redirect(['action' => 'index']);
    }
}
