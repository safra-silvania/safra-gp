<?php
declare(strict_types=1);

namespace App\Controller;

/**
 * @property \App\Model\Table\CulturesTable $Cultures
 * @method \App\Model\Entity\Culture[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class CulturesController extends AppController
{
    public function beforeFilter(\Cake\Event\EventInterface $event)
    {
        parent::beforeFilter($event);

        $this->viewBuilder()->setLayout('admin');

        $this->set('crumbs', ['Cadastro', __('Seeds'), __('Cultures')]);

        $this->set('canCreate', $this->userAuthenticated && $this->userAuthenticated->can('create', $this->Cultures->newEmptyEntity()));
    }
    
    /**
     * @return \Cake\Http\Response|null|void Renders view
     */
    public function index()
    {
        if (!$this->userAuthenticated->can('access', $this->Cultures->newEmptyEntity())) {
            $this->Flash->error('Permissão negada!');
            return $this->redirect(['controller' => 'dashboard', 'action' => 'index']);
        }

        $cultures = $this->paginate($this->Cultures);

        $this->set(compact('cultures'));
    }

    /**
     * @param string|null $id Culture id.
     * @return \Cake\Http\Response|null|void Renders view
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $culture = $this->Cultures->get($id, [
            'contain' => ['FieldDetails', 'Seeds'],
        ]);

        if (!$this->userAuthenticated->can('view', $culture)) {
            $this->Flash->error('Permissão negada!');
            return $this->redirect($this->referer());
        }

        $this->set('culture', $culture);
    }

    /**
     * @return \Cake\Http\Response|null|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $culture = $this->Cultures->newEmptyEntity();

        if (!$this->userAuthenticated->can('create', $culture)) {
            $this->Flash->error('Permissão negada!');
            return $this->redirect(['action' => 'index']);
        }
        
        if ($this->request->is('post')) {
            $culture = $this->Cultures->patchEntity($culture, $this->request->getData());
            
            if ($this->Cultures->save($culture)) {
                $this->Flash->success('Inclusão realizada com sucesso');

                return $this->redirect(['action' => 'index']);
            }

            if (count($culture->getErrors()) > 0) {
                foreach ($culture->getErrors() as $error) {
                    foreach ($error as $message) {
                        $this->Flash->error($message);
                    }
                }
            } else {
                $this->Flash->error('Erro na inclusão de ' . __('Culture') . '. Por favor, tente novamente');
            }
        }

        $this->set(compact('culture'));
    }

    /**
     * @param string|null $id Culture id.
     * @return \Cake\Http\Response|null|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $culture = $this->Cultures->get($id, [
            'contain' => [],
        ]);

        if (!$this->userAuthenticated->can('update', $culture)) {
            $this->Flash->error('Permissão negada!');
            return $this->redirect(['action' => 'index']);
        }

        if ($this->request->is(['patch', 'post', 'put'])) {
            $culture = $this->Cultures->patchEntity($culture, $this->request->getData());
            
            if ($this->Cultures->save($culture)) {
                $this->Flash->success('Edição realizada com sucesso');

                return $this->redirect(['action' => 'index']);
            }

            if (count($culture->getErrors()) > 0) {
                foreach ($culture->getErrors() as $error) {
                    foreach ($error as $message) {
                        $this->Flash->error($message);
                    }
                }
            } else {
                $this->Flash->error('Erro na edição de ' . __('Culture') . '. Por favor, tente novamente');
            }
        }
        
        $this->set(compact('culture'));
    }

    /**
     * @param string|null $id Culture id.
     * @return \Cake\Http\Response|null|void Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $culture = $this->Cultures->get($id);

        if (!$this->userAuthenticated->can('delete', $culture)) {
            $this->Flash->error('Permissão negada!');
            return $this->redirect(['action' => 'index']);
        }

        if ($this->Cultures->delete($culture))
            $this->Flash->success('Exclusão realizada com sucesso');
        else {
            if (count($culture->getErrors()) > 0) {
                foreach ($culture->getErrors() as $error) {
                    foreach ($error as $message) {
                        $this->Flash->error($message);
                    }
                }
            } else {
                $this->Flash->error('Erro na exclusão de ' . __('Culture') . '. Por favor, tente novamente');
            }
        }

        return $this->redirect(['action' => 'index']);
    }
}
