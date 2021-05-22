<?php
declare(strict_types=1);

namespace App\Controller;

/**
 * @property \App\Model\Table\FieldDetailsTable $FieldDetails
 * @method \App\Model\Entity\FieldDetail[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class FieldDetailsController extends AppController
{
    public function beforeFilter(\Cake\Event\EventInterface $event)
    {
        parent::beforeFilter($event);

        $this->viewBuilder()->setLayout('admin');

        $this->set('crumbs', ['Cadastro', __('Immobiles'), __('Field'), __('FieldDetails')]);

        $this->set('canCreate', $this->userAuthenticated && $this->userAuthenticated->can('create', $this->FieldDetails->newEmptyEntity()));
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

        if (!$this->userAuthenticated->can('access', $this->FieldDetails->newEmptyEntity())) {
            $this->Flash->error('Permissão negada!');
            return $this->redirect(['controller' => 'dashboard', 'action' => 'index']);
        }

        $fieldDetails = $this->FieldDetails->find()
            ->where(['field_id' => $fieldId])
            ->contain(['Fields', 'Cultures', 'Fertilities', 'MeasureUnits'])
            ->order(['FieldDetails.id' => 'ASC']);

        $field = $this->Fields->get($fieldId, [
            'contain' => ['Immobiles', 'MeasureUnits', 'CultivationSystems', 'Fertilities', 'Cities'],
        ]);

        $this->set(compact('field', 'fieldDetails'));
    }

    /**
     * @param string|null $id Field Detail id.
     * @return \Cake\Http\Response|null|void Renders view
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($fieldId = null, $id = null)
    {
        if (!$fieldId) {
            $this->Flash->error('Talhão não encontrado');
            return $this->redirect($this->referer());
        }

        $fieldDetail = $this->FieldDetails->get($id, [
            'contain' => ['Fields', 'Cultures', 'Fertilities', 'MeasureUnits', 'PlanFieldDetails'],
        ]);

        if (!$this->userAuthenticated->can('view', $fieldDetail)) {
            $this->Flash->error('Permissão negada!');
            return $this->redirect($this->referer());
        }

        $this->set('fieldDetail', $fieldDetail);

        $field = $this->Fields->get($fieldId, ['contain' => ['Immobiles', 'MeasureUnits', 'CultivationSystems', 'Fertilities', 'Cities']]);
        $this->set(compact('field'));
    }

    /**
     * @return \Cake\Http\Response|null|void Redirects on successful add, renders view otherwise.
     */
    public function add($fieldId = null)
    {
        if (!$fieldId) {
            $this->Flash->error('Talhão não encontrado');
            return $this->redirect($this->referer());
        }
        
        $fieldDetail = $this->FieldDetails->newEmptyEntity();

        if (!$this->userAuthenticated->can('create', $fieldDetail)) {
            $this->Flash->error('Permissão negada!');
            return $this->redirect(['controller' => 'fields', 'action' => 'index', $fieldId]);
        }
        
        if ($this->request->is('post')) {
            $fieldDetail = $this->FieldDetails->patchEntity($fieldDetail, $this->request->getData());
            
            if ($this->FieldDetails->save($fieldDetail)) {
                $this->Flash->success('Inclusão realizada com sucesso');

                return $this->redirect(['action' => 'index', $fieldId]);
            }

            if (count($fieldDetail->getErrors()) > 0) {
                foreach ($fieldDetail->getErrors() as $error) {
                    foreach ($error as $message) {
                        $this->Flash->error($message);
                    }
                }
            } else {
                $this->Flash->error('Erro na inclusão de ' . __('Field Detail') . '. Por favor, tente novamente');
            }
        }

        $fields = $this->FieldDetails->Fields->find('list', ['limit' => 200]);
        $cultures = $this->FieldDetails->Cultures->find('list', ['limit' => 200]);
        $fertilities = $this->FieldDetails->Fertilities->find('list', ['limit' => 200]);
        $measureUnits = $this->FieldDetails->MeasureUnits->find('list', ['limit' => 200]);
        $this->set(compact('fieldDetail', 'fields', 'cultures', 'fertilities', 'measureUnits'));

        $field = $this->Fields->get($fieldId, ['contain' => ['Immobiles', 'MeasureUnits', 'CultivationSystems', 'Fertilities', 'Cities']]);
        $this->set(compact('field'));
    }

    /**
     * @param string|null $id Field Detail id.
     * @return \Cake\Http\Response|null|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($fieldId = null, $id = null)
    {
        if (!$fieldId) {
            $this->Flash->error('Talhão não encontrado');
            return $this->redirect($this->referer());
        }

        $fieldDetail = $this->FieldDetails->get($id, [
            'contain' => [],
        ]);

        if (!$this->userAuthenticated->can('update', $fieldDetail)) {
            $this->Flash->error('Permissão negada!');
            return $this->redirect(['controller' => 'fields', 'action' => 'index', $fieldId]);
        }

        if ($this->request->is(['patch', 'post', 'put'])) {
            $fieldDetail = $this->FieldDetails->patchEntity($fieldDetail, $this->request->getData());
            
            if ($this->FieldDetails->save($fieldDetail)) {
                $this->Flash->success('Edição realizada com sucesso');

                return $this->redirect(['action' => 'index', $fieldId]);
            }

            if (count($fieldDetail->getErrors()) > 0) {
                foreach ($fieldDetail->getErrors() as $error) {
                    foreach ($error as $message) {
                        $this->Flash->error($message);
                    }
                }
            } else {
                $this->Flash->error('Erro na edição de ' . __('Field Detail') . '. Por favor, tente novamente');
            }
        }
        
        $fields = $this->FieldDetails->Fields->find('list', ['limit' => 200]);
        $cultures = $this->FieldDetails->Cultures->find('list', ['limit' => 200]);
        $fertilities = $this->FieldDetails->Fertilities->find('list', ['limit' => 200]);
        $measureUnits = $this->FieldDetails->MeasureUnits->find('list', ['limit' => 200]);
        $this->set(compact('fieldDetail', 'fields', 'cultures', 'fertilities', 'measureUnits'));

        $field = $this->Fields->get($fieldId, ['contain' => ['Immobiles', 'MeasureUnits', 'CultivationSystems', 'Fertilities', 'Cities']]);
        $this->set(compact('field'));
    }

    /**
     * @param string|null $id Field Detail id.
     * @return \Cake\Http\Response|null|void Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($fieldId = null, $id = null)
    {
        if (!$fieldId) {
            $this->Flash->error('Talhão não encontrado');
            return $this->redirect($this->referer());
        }

        $this->request->allowMethod(['post', 'delete']);
        $fieldDetail = $this->FieldDetails->get($id);

        if (!$this->userAuthenticated->can('delete', $fieldDetail)) {
            $this->Flash->error('Permissão negada!');
            return $this->redirect(['action' => 'index', $fieldId]);
        }

        if ($this->FieldDetails->delete($fieldDetail))
            $this->Flash->success('Exclusão realizada com sucesso');
        else {
            if (count($fieldDetail->getErrors()) > 0) {
                foreach ($fieldDetail->getErrors() as $error) {
                    foreach ($error as $message) {
                        $this->Flash->error($message);
                    }
                }
            } else {
                $this->Flash->error('Erro na exclusão de ' . __('Field Detail') . '. Por favor, tente novamente');
            }
        }

        return $this->redirect(['action' => 'index', $fieldId]);
    }
}
