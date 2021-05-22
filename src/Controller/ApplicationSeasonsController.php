<?php
declare(strict_types=1);

namespace App\Controller;

/**
 * @property \App\Model\Table\ApplicationSeasonsTable $ApplicationSeasons
 * @method \App\Model\Entity\ApplicationSeason[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class ApplicationSeasonsController extends AppController
{
    public function beforeFilter(\Cake\Event\EventInterface $event)
    {
        parent::beforeFilter($event);

        $this->viewBuilder()->setLayout('admin');

        $this->set('crumbs', ['Cadastro', __('Chemicals'), __('ApplicationSeasons')]);

        $this->set('canCreate', $this->userAuthenticated && $this->userAuthenticated->can('create', $this->ApplicationSeasons->newEmptyEntity()));
    }
    
    /**
     * @return \Cake\Http\Response|null|void Renders view
     */
    public function index()
    {
        if (!$this->userAuthenticated->can('access', $this->ApplicationSeasons->newEmptyEntity())) {
            $this->Flash->error('Permissão negada!');
            return $this->redirect(['controller' => 'dashboard', 'action' => 'index']);
        }

        $applicationSeasons = $this->paginate($this->ApplicationSeasons);

        $this->set(compact('applicationSeasons'));
    }

    /**
     * @param string|null $id Application Season id.
     * @return \Cake\Http\Response|null|void Renders view
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $applicationSeason = $this->ApplicationSeasons->get($id, [
            'contain' => ['Chemicals'],
        ]);

        if (!$this->userAuthenticated->can('view', $applicationSeason)) {
            $this->Flash->error('Permissão negada!');
            return $this->redirect($this->referer());
        }

        $this->set('applicationSeason', $applicationSeason);
    }

    /**
     * @return \Cake\Http\Response|null|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $applicationSeason = $this->ApplicationSeasons->newEmptyEntity();

        if (!$this->userAuthenticated->can('create', $applicationSeason)) {
            $this->Flash->error('Permissão negada!');
            return $this->redirect(['action' => 'index']);
        }
        
        if ($this->request->is('post')) {
            $applicationSeason = $this->ApplicationSeasons->patchEntity($applicationSeason, $this->request->getData());
            
            if ($this->ApplicationSeasons->save($applicationSeason)) {
                $this->Flash->success('Inclusão realizada com sucesso');

                return $this->redirect(['action' => 'index']);
            }

            if (count($applicationSeason->getErrors()) > 0) {
                foreach ($applicationSeason->getErrors() as $error) {
                    foreach ($error as $message) {
                        $this->Flash->error($message);
                    }
                }
            } else {
                $this->Flash->error('Erro na inclusão de ' . __('Application Season') . '. Por favor, tente novamente');
            }
        }

        $chemicals = $this->ApplicationSeasons->Chemicals->find('list', ['limit' => 200]);
        $this->set(compact('applicationSeason', 'chemicals'));
    }

    /**
     * @param string|null $id Application Season id.
     * @return \Cake\Http\Response|null|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $applicationSeason = $this->ApplicationSeasons->get($id, [
            'contain' => ['Chemicals'],
        ]);

        if (!$this->userAuthenticated->can('update', $applicationSeason)) {
            $this->Flash->error('Permissão negada!');
            return $this->redirect(['action' => 'index']);
        }

        if ($this->request->is(['patch', 'post', 'put'])) {
            $applicationSeason = $this->ApplicationSeasons->patchEntity($applicationSeason, $this->request->getData());
            
            if ($this->ApplicationSeasons->save($applicationSeason)) {
                $this->Flash->success('Edição realizada com sucesso');

                return $this->redirect(['action' => 'index']);
            }

            if (count($applicationSeason->getErrors()) > 0) {
                foreach ($applicationSeason->getErrors() as $error) {
                    foreach ($error as $message) {
                        $this->Flash->error($message);
                    }
                }
            } else {
                $this->Flash->error('Erro na edição de ' . __('Application Season') . '. Por favor, tente novamente');
            }
        }
        
        $chemicals = $this->ApplicationSeasons->Chemicals->find('list', ['limit' => 200]);
        $this->set(compact('applicationSeason', 'chemicals'));
    }

    /**
     * @param string|null $id Application Season id.
     * @return \Cake\Http\Response|null|void Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $applicationSeason = $this->ApplicationSeasons->get($id);

        if (!$this->userAuthenticated->can('delete', $applicationSeason)) {
            $this->Flash->error('Permissão negada!');
            return $this->redirect(['action' => 'index']);
        }

        if ($this->ApplicationSeasons->delete($applicationSeason))
            $this->Flash->success('Exclusão realizada com sucesso');
        else {
            if (count($applicationSeason->getErrors()) > 0) {
                foreach ($applicationSeason->getErrors() as $error) {
                    foreach ($error as $message) {
                        $this->Flash->error($message);
                    }
                }
            } else {
                $this->Flash->error('Erro na exclusão de ' . __('Application Season') . '. Por favor, tente novamente');
            }
        }

        return $this->redirect(['action' => 'index']);
    }
}
