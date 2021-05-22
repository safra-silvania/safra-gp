<?php
declare(strict_types=1);

namespace App\Controller;

/**
 * @property \App\Model\Table\FieldsTable $Fields
 * @method \App\Model\Entity\Field[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class FieldsController extends AppController
{
    public function beforeFilter(\Cake\Event\EventInterface $event)
    {
        parent::beforeFilter($event);

        $this->viewBuilder()->setLayout('admin');

        $this->set('crumbs', ['Cadastro', __('Immobile'), __('Fields')]);

        $this->set('canCreate', $this->userAuthenticated && $this->userAuthenticated->can('create', $this->Fields->newEmptyEntity()));
        
        $this->loadModel('Immobiles');
        $this->loadModel('FieldDetails');
    }
    
    /**
     * @return \Cake\Http\Response|null|void Renders view
     */
    public function index($immobileId = null)
    {
        if (!$immobileId) {
            $this->Flash->error('Imóvel não encontrado');
            return $this->redirect(['controller' => 'immobiles', 'action' => 'index']);
        }

        if (!$this->userAuthenticated->can('access', $this->Fields->newEmptyEntity())) {
            $this->Flash->error('Permissão negada!');
            return $this->redirect(['action' => 'index', $immobileId]);
        }

        $fields = $this->Fields->getFieldsByImmobile($immobileId);
        $this->set(compact('immobileId', 'fields'));
    }

    /**
     * @param string|null $id Field id.
     * @return \Cake\Http\Response|null|void Renders view
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($immobileId = null, $id = null)
    {
        if (!$immobileId) {
            $this->Flash->error('Imóvel não encontrado');
            return $this->redirect(['controller' => 'immobiles', 'action' => 'index']);
        }

        if (!$id) {
            $this->Flash->error('Talhão não encontrado');
            return $this->redirect(['controller' => 'fields', 'action' => 'index', $immobileId]);
        }

        $field = $this->Fields->get($id, [
            'contain' => ['Immobiles', 'MeasureUnits', 'CultivationSystems', 'Fertilities', 'Cities', 'FieldDetails'],
        ]);

        if (!$this->userAuthenticated->can('view', $field)) {
            $this->Flash->error('Permissão negada!');
            return $this->redirect($this->referer());
        }

        $this->set('field', $field);

        $immobile = $this->Immobiles->get($immobileId, ['contain' => ['Producers', 'Cities']]);
        $this->set(compact('immobile'));
    }

    /**
     * @return \Cake\Http\Response|null|void Redirects on successful add, renders view otherwise.
     */
    public function add($immobileId = null)
    {
        if (!$immobileId) {
            $this->Flash->error('Imóvel não encontrado');
            return $this->redirect(['controller' => 'immobiles', 'action' => 'index']);
        }

        $field = $this->Fields->newEmptyEntity();

        if (!$this->userAuthenticated->can('create', $field)) {
            $this->Flash->error('Permissão negada!');
            return $this->redirect(['action' => 'index', $immobileId]);
        }
        
        if ($this->request->is('post')) {
            $field = $this->Fields->patchEntity($field, $this->request->getData());
            
            if ($this->Fields->save($field)) {
                $this->Flash->success('Inclusão realizada com sucesso');

                return $this->redirect(['action' => 'index', $immobileId]);
            }

            $this->Flash->error('Erro na inclusão de Talhão. Por favor, tente novamente');
        }

        $immobiles = $this->Fields->Immobiles->find('list', ['limit' => 200]);
        $measureUnits = $this->Fields->MeasureUnits->find('list', ['limit' => 200]);
        $cultivationSystems = $this->Fields->CultivationSystems->find('list', ['limit' => 200]);
        $fertilities = $this->Fields->Fertilities->find('list', ['limit' => 200]);
        $cities = $this->Fields->Cities->find('list', ['limit' => 200]);
        $this->set(compact('field', 'immobiles', 'measureUnits', 'cultivationSystems', 'fertilities', 'cities'));

        $immobile = $this->Immobiles->get($immobileId, ['contain' => ['Producers', 'Cities']]);
        $this->set(compact('immobile'));
    }

    /**
     * @param string|null $id Field id.
     * @return \Cake\Http\Response|null|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($immobileId = null, $id = null)
    {
        $this->set('title', "Talhão");

        if (!$immobileId) {
            $this->Flash->error('Imóvel não encontrado');
            return $this->redirect(['controller' => 'immobiles', 'action' => 'index']);
        }

        if (!$id) {
            $this->Flash->error('Talhão não encontrado');
            return $this->redirect(['action' => 'index', $immobileId]);
        }

        $field = $this->Fields->get($id, [
            'contain' => ['FieldDetails'],
        ]);

        if (!$this->userAuthenticated->can('update', $field)) {
            $this->Flash->error('Permissão negada!');
            return $this->redirect(['action' => 'index', $immobileId]);
        }

        if ($this->request->is(['patch', 'post', 'put'])) {
            $field = $this->Fields->patchEntity($field, $this->request->getData());
            
            if ($this->Fields->save($field)) {
                $this->Flash->success('Edição realizada com sucesso');

                return $this->redirect(['action' => 'index', $immobileId]);
            }

            $this->Flash->error('Erro na edição de Talhão. Por favor, tente novamente');
        }
        
        $immobiles = $this->Fields->Immobiles->find('list', ['limit' => 200]);
        $measureUnits = $this->Fields->MeasureUnits->find('list', ['limit' => 200])->order(['id' => 'DESC']);
        $cultivationSystems = $this->Fields->CultivationSystems->find('list', ['limit' => 200]);
        $fertilities = $this->Fields->Fertilities->find('list', ['limit' => 200]);
        $cities = $this->Fields->Cities->find('list', ['limit' => 200]);
        $this->set(compact('field', 'immobiles', 'measureUnits', 'cultivationSystems', 'fertilities', 'cities'));

        $immobile = $this->Immobiles->get($immobileId, ['contain' => ['Producers', 'Cities']]);
        $this->set(compact('immobile'));
    }

    /**
     * @param string|null $id Field id.
     * @return \Cake\Http\Response|null|void Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($immobileId = null, $id = null)
    {
        if (!$immobileId) {
            $this->Flash->error('Imóvel não encontrado');
            return $this->redirect(['controller' => 'immobiles', 'action' => 'index']);
        }

        if (!$id) {
            $this->Flash->error('Talhão não encontrado');
            return $this->redirect(['action' => 'index', $immobileId]);
        }

        $this->request->allowMethod(['post', 'delete']);
        $field = $this->Fields->get($id);

        if (!$this->userAuthenticated->can('delete', $field)) {
            $this->Flash->error('Permissão negada!');
            return $this->redirect(['action' => 'index', $immobileId]);
        }

        if ($this->Fields->delete($field))
            $this->Flash->success('Exclusão realizada com sucesso');
        else {
            if (count($field->getErrors()) > 0) {
                foreach ($field->getErrors() as $error) {
                    foreach ($error as $message) {
                        $this->Flash->error($message);
                    }
                }
            } else {
                $this->Flash->error('Erro na exclusão de Talhão. Por favor, tente novamente');
            }
        }

        return $this->redirect(['action' => 'index', $immobileId]);
    }
}
