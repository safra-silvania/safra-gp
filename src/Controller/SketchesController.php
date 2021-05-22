<?php
declare(strict_types=1);

namespace App\Controller;

use Cake\Filesystem\Folder;
use Cake\Filesystem\File;

/**
 * @property \App\Model\Table\SketchesTable $Sketches
 * @method \App\Model\Entity\Sketch[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class SketchesController extends AppController
{
    public function beforeFilter(\Cake\Event\EventInterface $event)
    {
        parent::beforeFilter($event);

        $this->viewBuilder()->setLayout('admin');

        $this->set('crumbs', ['Cadastro', __('Immobiles'), __('Field'), __('Sketches')]);

        $this->set('canCreate', $this->userAuthenticated && $this->userAuthenticated->can('create', $this->Sketches->newEmptyEntity()));

        $this->loadModel('Fields');
        $this->loadModel('Files');
    }

    public function upload($fieldId)
    {
        $this->viewBuilder()->setLayout('ajax');
        $this->request->allowMethod(['post']);

        $folder = "field_{$fieldId}";
        $realDir = WWW_ROOT . "upload" .DS. "sketches" .DS. $folder;
        $virtualDir = "/upload/sketches/{$folder}";

        $create = !is_dir($realDir);

        $dir = new Folder($realDir, $create);

        $attachment = $this->request->getUploadedFile('file-upload');

        $name = $attachment->getClientFilename();
        $type = $attachment->getClientMediaType();
        $size = $attachment->getSize();
        $tmpName = $attachment->getStream()->getMetadata('uri');
        $error = $attachment->getError();
        $extension = pathinfo($name, PATHINFO_EXTENSION);
        $now = date('Y-m-d H:i:s');
        $hash = md5(uniqid($now."".rand(), true));

        $attachment->moveTo($realDir .DS. "{$hash}.{$extension}");

        $sketch = $this->Sketches->find()->where(['field_id' => $fieldId])->first();

        $file = $this->Files->newEmptyEntity();
        $file = $this->Files->patchEntity($file, [
            'sketch_id' => $sketch->id,
            'name' => $name,
            'hash' => $hash,
            'path' => $virtualDir,
            'type' => $type,
            'extension' => $extension,
        ]);

        $this->Files->save($file);

        $data = [];
        $this->set(compact('data'));
        $this->viewBuilder()->setOption('serialize', ['data']);
    }

    /**
     * @return \Cake\Http\Response|null|void Renders view
     */
    public function index($fieldId = null)
    {
        if (!$fieldId) {
            $this->Flash->error('Talhão não encontrado');
            return $this->redirect($this->referer());
        }

        $field = $this->Fields->get($fieldId, ['contain' => ['Sketches']]);

        if (count($field->sketches) == 0) {
            $sketch = $this->Sketches->newEmptyEntity();
            $sketch = $this->Sketches->patchEntity($sketch, ['field_id' => $fieldId]);
            $this->Sketches->save($sketch);
        }

        if (!$this->userAuthenticated->can('access', $this->Sketches->newEmptyEntity())) {
            $this->Flash->error('Permissão negada!');
            return $this->redirect(['controller' => 'dashboard', 'action' => 'index']);
        }

        $sketch = $this->Sketches->find()
            ->where(['field_id' => $fieldId])
            ->contain(['Fields', 'Files'])
            ->order(['Sketches.id' => 'ASC'])
            ->first();

        $field = $this->Fields->get($fieldId, [
            'contain' => ['Immobiles', 'MeasureUnits', 'CultivationSystems', 'Fertilities', 'Cities'],
        ]);

        $this->set(compact('sketch', 'field'));
    }

    
    public function deleteFile($fileId = null)
    {
        $this->request->allowMethod(['post']);
        $file = $this->Files->get($fileId, ['contain' => ['Sketches' => 'Fields']]);


        $success = true;

        if ($this->Files->delete($file))
            $success = true;
        else
            $success = false;

        $data = [$success];
        $this->set(compact('data'));
        $this->viewBuilder()->setOption('serialize', ['data']);
        /*
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

        return $this->redirect(['action' => 'index', $file->sketch->field->id]);
        */
    }


    /**
     * @param string|null $id Sketch id.
     * @return \Cake\Http\Response|null|void Renders view
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $sketch = $this->Sketches->get($id, [
            'contain' => ['Fields'],
        ]);

        if (!$this->userAuthenticated->can('view', $sketch)) {
            $this->Flash->error('Permissão negada!');
            return $this->redirect($this->referer());
        }

        $this->set('sketch', $sketch);
    }

    /**
     * @return \Cake\Http\Response|null|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $sketch = $this->Sketches->newEmptyEntity();

        if (!$this->userAuthenticated->can('create', $sketch)) {
            $this->Flash->error('Permissão negada!');
            return $this->redirect(['action' => 'index']);
        }
        
        if ($this->request->is('post')) {
            $sketch = $this->Sketches->patchEntity($sketch, $this->request->getData());
            
            if ($this->Sketches->save($sketch)) {
                $this->Flash->success('Inclusão realizada com sucesso');

                return $this->redirect(['action' => 'index']);
            }

            if (count($sketch->getErrors()) > 0) {
                foreach ($sketch->getErrors() as $error) {
                    foreach ($error as $message) {
                        $this->Flash->error($message);
                    }
                }
            } else {
                $this->Flash->error('Erro na inclusão de ' . __('Sketch') . '. Por favor, tente novamente');
            }
        }

        $fields = $this->Sketches->Fields->find('list', ['limit' => 200]);
        $this->set(compact('sketch', 'fields'));
    }

    /**
     * @param string|null $id Sketch id.
     * @return \Cake\Http\Response|null|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $sketch = $this->Sketches->get($id, [
            'contain' => [],
        ]);

        if (!$this->userAuthenticated->can('update', $sketch)) {
            $this->Flash->error('Permissão negada!');
            return $this->redirect(['action' => 'index']);
        }

        if ($this->request->is(['patch', 'post', 'put'])) {
            $sketch = $this->Sketches->patchEntity($sketch, $this->request->getData());
            
            if ($this->Sketches->save($sketch)) {
                $this->Flash->success('Edição realizada com sucesso');

                return $this->redirect(['action' => 'index']);
            }

            if (count($sketch->getErrors()) > 0) {
                foreach ($sketch->getErrors() as $error) {
                    foreach ($error as $message) {
                        $this->Flash->error($message);
                    }
                }
            } else {
                $this->Flash->error('Erro na edição de ' . __('Sketch') . '. Por favor, tente novamente');
            }
        }
        
        $fields = $this->Sketches->Fields->find('list', ['limit' => 200]);
        $this->set(compact('sketch', 'fields'));
    }

    /**
     * @param string|null $id Sketch id.
     * @return \Cake\Http\Response|null|void Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $sketch = $this->Sketches->get($id);

        if (!$this->userAuthenticated->can('delete', $sketch)) {
            $this->Flash->error('Permissão negada!');
            return $this->redirect(['action' => 'index']);
        }

        if ($this->Sketches->delete($sketch))
            $this->Flash->success('Exclusão realizada com sucesso');
        else {
            if (count($sketch->getErrors()) > 0) {
                foreach ($sketch->getErrors() as $error) {
                    foreach ($error as $message) {
                        $this->Flash->error($message);
                    }
                }
            } else {
                $this->Flash->error('Erro na exclusão de ' . __('Sketch') . '. Por favor, tente novamente');
            }
        }

        return $this->redirect(['action' => 'index']);
    }
}
