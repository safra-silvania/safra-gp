<?php
declare(strict_types=1);

namespace App\Controller;

/**
 * @property \App\Model\Table\FilesTable $Files
 * @method \App\Model\Entity\File[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class FilesController extends AppController
{
    public function beforeFilter(\Cake\Event\EventInterface $event)
    {
        parent::beforeFilter($event);

        $this->viewBuilder()->setLayout('admin');

        $this->set('crumbs', ['Cadastro', __('Files')]);

        $this->set('canCreate', $this->userAuthenticated && $this->userAuthenticated->can('create', $this->Files->newEmptyEntity()));
    }

    public function getFilesByField($fieldId)
    {
        $sketch = $this->Files->Sketches->find()->where(['field_id' => $fieldId])->first();
        $files = $this->Files->find("all")->where(['sketch_id' => $sketch->id]);

        $data = $files;
        $this->set(compact('data'));
        $this->viewBuilder()->setOption('serialize', ['data']);
    }
    
    /**
     * @return \Cake\Http\Response|null|void Renders view
     */
    public function index()
    {
        if (!$this->userAuthenticated->can('access', $this->Files->newEmptyEntity())) {
            $this->Flash->error('Permissão negada!');
            return $this->redirect(['controller' => 'dashboard', 'action' => 'index']);
        }

        $this->paginate = [
            'contain' => ['Sketches'],
        ];
        $files = $this->paginate($this->Files);

        $this->set(compact('files'));
    }

    /**
     * @param string|null $id File id.
     * @return \Cake\Http\Response|null|void Renders view
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $file = $this->Files->get($id, [
            'contain' => ['Sketches'],
        ]);

        if (!$this->userAuthenticated->can('view', $file)) {
            $this->Flash->error('Permissão negada!');
            return $this->redirect($this->referer());
        }

        $this->set('file', $file);
    }

    /**
     * @return \Cake\Http\Response|null|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $file = $this->Files->newEmptyEntity();

        if (!$this->userAuthenticated->can('create', $file)) {
            $this->Flash->error('Permissão negada!');
            return $this->redirect(['action' => 'index']);
        }
        
        if ($this->request->is('post')) {
            $file = $this->Files->patchEntity($file, $this->request->getData());
            
            if ($this->Files->save($file)) {
                $this->Flash->success('Inclusão realizada com sucesso');

                return $this->redirect(['action' => 'index']);
            }

            if (count($file->getErrors()) > 0) {
                foreach ($file->getErrors() as $error) {
                    foreach ($error as $message) {
                        $this->Flash->error($message);
                    }
                }
            } else {
                $this->Flash->error('Erro na inclusão de ' . __('File') . '. Por favor, tente novamente');
            }
        }

        $sketches = $this->Files->Sketches->find('list', ['limit' => 200]);
        $this->set(compact('file', 'sketches'));
    }

    /**
     * @param string|null $id File id.
     * @return \Cake\Http\Response|null|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $file = $this->Files->get($id, [
            'contain' => [],
        ]);

        if (!$this->userAuthenticated->can('update', $file)) {
            $this->Flash->error('Permissão negada!');
            return $this->redirect(['action' => 'index']);
        }

        if ($this->request->is(['patch', 'post', 'put'])) {
            $file = $this->Files->patchEntity($file, $this->request->getData());
            
            if ($this->Files->save($file)) {
                $this->Flash->success('Edição realizada com sucesso');

                return $this->redirect(['action' => 'index']);
            }

            if (count($file->getErrors()) > 0) {
                foreach ($file->getErrors() as $error) {
                    foreach ($error as $message) {
                        $this->Flash->error($message);
                    }
                }
            } else {
                $this->Flash->error('Erro na edição de ' . __('File') . '. Por favor, tente novamente');
            }
        }
        
        $sketches = $this->Files->Sketches->find('list', ['limit' => 200]);
        $this->set(compact('file', 'sketches'));
    }

    /**
     * @param string|null $id File id.
     * @return \Cake\Http\Response|null|void Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $file = $this->Files->get($id);

        if (!$this->userAuthenticated->can('delete', $file)) {
            $this->Flash->error('Permissão negada!');
            return $this->redirect(['action' => 'index']);
        }

        if ($this->Files->delete($file))
            $this->Flash->success('Exclusão realizada com sucesso');
        else {
            if (count($file->getErrors()) > 0) {
                foreach ($file->getErrors() as $error) {
                    foreach ($error as $message) {
                        $this->Flash->error($message);
                    }
                }
            } else {
                $this->Flash->error('Erro na exclusão de ' . __('File') . '. Por favor, tente novamente');
            }
        }

        return $this->redirect(['action' => 'index']);
    }
}
