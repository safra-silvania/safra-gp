<?php
declare(strict_types=1);

namespace App\Controller;

/**
 * @property \App\Model\Table\ZoningRegionsTable $ZoningRegions
 * @method \App\Model\Entity\ZoningRegion[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class ZoningRegionsController extends AppController
{
    public function beforeFilter(\Cake\Event\EventInterface $event)
    {
        parent::beforeFilter($event);

        $this->viewBuilder()->setLayout('admin');

        $this->set('crumbs', ['Cadastro', __('ZoningRegions')]);

        $this->set('canCreate', $this->userAuthenticated && $this->userAuthenticated->can('create', $this->ZoningRegions->newEmptyEntity()));
    }
    
    /**
     * @return \Cake\Http\Response|null|void Renders view
     */
    public function index()
    {
        if (!$this->userAuthenticated->can('access', $this->ZoningRegions->newEmptyEntity())) {
            $this->Flash->error('Permissão negada!');
            return $this->redirect(['controller' => 'dashboard', 'action' => 'index']);
        }

        $zoningRegions = $this->paginate($this->ZoningRegions);

        $this->set(compact('zoningRegions'));
    }

    /**
     * @param string|null $id Zoning Region id.
     * @return \Cake\Http\Response|null|void Renders view
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $zoningRegion = $this->ZoningRegions->get($id, [
            'contain' => ['Seeds'],
        ]);

        if (!$this->userAuthenticated->can('view', $zoningRegion)) {
            $this->Flash->error('Permissão negada!');
            return $this->redirect($this->referer());
        }

        $this->set('zoningRegion', $zoningRegion);
    }

    /**
     * @return \Cake\Http\Response|null|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $zoningRegion = $this->ZoningRegions->newEmptyEntity();

        if (!$this->userAuthenticated->can('create', $zoningRegion)) {
            $this->Flash->error('Permissão negada!');
            return $this->redirect(['action' => 'index']);
        }
        
        if ($this->request->is('post')) {
            $zoningRegion = $this->ZoningRegions->patchEntity($zoningRegion, $this->request->getData());
            
            if ($this->ZoningRegions->save($zoningRegion)) {
                $this->Flash->success('Inclusão realizada com sucesso');

                return $this->redirect(['action' => 'index']);
            }

            if (count($zoningRegion->getErrors()) > 0) {
                foreach ($zoningRegion->getErrors() as $error) {
                    foreach ($error as $message) {
                        $this->Flash->error($message);
                    }
                }
            } else {
                $this->Flash->error('Erro na inclusão de ' . __('Zoning Region') . '. Por favor, tente novamente');
            }
        }

        $this->set(compact('zoningRegion'));
    }

    /**
     * @param string|null $id Zoning Region id.
     * @return \Cake\Http\Response|null|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $zoningRegion = $this->ZoningRegions->get($id, [
            'contain' => [],
        ]);

        if (!$this->userAuthenticated->can('update', $zoningRegion)) {
            $this->Flash->error('Permissão negada!');
            return $this->redirect(['action' => 'index']);
        }

        if ($this->request->is(['patch', 'post', 'put'])) {
            $zoningRegion = $this->ZoningRegions->patchEntity($zoningRegion, $this->request->getData());
            
            if ($this->ZoningRegions->save($zoningRegion)) {
                $this->Flash->success('Edição realizada com sucesso');

                return $this->redirect(['action' => 'index']);
            }

            if (count($zoningRegion->getErrors()) > 0) {
                foreach ($zoningRegion->getErrors() as $error) {
                    foreach ($error as $message) {
                        $this->Flash->error($message);
                    }
                }
            } else {
                $this->Flash->error('Erro na edição de ' . __('Zoning Region') . '. Por favor, tente novamente');
            }
        }
        
        $this->set(compact('zoningRegion'));
    }

    /**
     * @param string|null $id Zoning Region id.
     * @return \Cake\Http\Response|null|void Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $zoningRegion = $this->ZoningRegions->get($id);

        if (!$this->userAuthenticated->can('delete', $zoningRegion)) {
            $this->Flash->error('Permissão negada!');
            return $this->redirect(['action' => 'index']);
        }

        if ($this->ZoningRegions->delete($zoningRegion))
            $this->Flash->success('Exclusão realizada com sucesso');
        else {
            if (count($zoningRegion->getErrors()) > 0) {
                foreach ($zoningRegion->getErrors() as $error) {
                    foreach ($error as $message) {
                        $this->Flash->error($message);
                    }
                }
            } else {
                $this->Flash->error('Erro na exclusão de ' . __('Zoning Region') . '. Por favor, tente novamente');
            }
        }

        return $this->redirect(['action' => 'index']);
    }
}
