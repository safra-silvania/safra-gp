<?php
declare(strict_types=1);

namespace App\Controller;

use App\Model\Enum;

/**
 * @property \App\Model\Table\SeedsTable $Seeds
 * @method \App\Model\Entity\Seed[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class SeedsController extends AppController
{
    private $seedsSuppliers;

    public function beforeFilter(\Cake\Event\EventInterface $event)
    {
        parent::beforeFilter($event);

        $this->viewBuilder()->setLayout('admin');

        $this->set('crumbs', ['Cadastro', __('Seeds')]);

        $this->set('canCreate', $this->userAuthenticated && $this->userAuthenticated->can('create', $this->Seeds->newEmptyEntity()));

        $this->seedsSuppliers = $this->Seeds->Suppliers->find('list')
            ->innerJoinWith(
                'SupplierTypes', function ($q) {
                    return $q->where(['SupplierTypes.id' => Enum\SupplierTypesEnum::Sementes]);
                }
            );
    }

    /**
     * @return \Cake\Http\Response|null|void Renders view
     */
    public function index()
    {
        if (!$this->userAuthenticated->can('access', $this->Seeds->newEmptyEntity())) {
            $this->Flash->error('Permissão negada!');
            return $this->redirect(['controller' => 'dashboard', 'action' => 'index']);
        }

        $this->paginate = [
            'contain' => ['SeedNotes', 'Cultures', 'Varieties', 'Technologies', 'Cycles', 'ZoningRegions', 'ProductivePotencials', 'Cities', 'Suppliers'],
        ];
        $seeds = $this->paginate($this->Seeds);

        $date = $this->Seeds->getLastestUpdate();
        $lastestUpdate = $date ? (new \DateTime($date))->format('d/m/Y H:i:s') : null;

        $this->set(compact('seeds', 'lastestUpdate'));
    }

    /**
     * @param string|null $id Seed id.
     * @return \Cake\Http\Response|null|void Renders view
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $seed = $this->Seeds->get($id, [
            'contain' => ['SeedNotes', 'Cultures', 'Varieties', 'Technologies', 'Cycles', 'ZoningRegions', 'ProductivePotencials', 'Cities', 'Suppliers', 'Fertilities'],
        ]);

        if (!$this->userAuthenticated->can('view', $seed)) {
            $this->Flash->error('Permissão negada!');
            return $this->redirect($this->referer());
        }

        $this->set('seed', $seed);
    }

    /**
     * @return \Cake\Http\Response|null|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $seed = $this->Seeds->newEmptyEntity();

        if (!$this->userAuthenticated->can('create', $seed)) {
            $this->Flash->error('Permissão negada!');
            return $this->redirect(['action' => 'index']);
        }

        if ($this->request->is('post')) {
            $seed = $this->Seeds->patchEntity($seed, $this->request->getData());

            if ($this->Seeds->save($seed)) {
                $this->Flash->success('Inclusão realizada com sucesso');

                return $this->redirect(['action' => 'index']);
            }

            if (count($seed->getErrors()) > 0) {
                foreach ($seed->getErrors() as $error) {
                    foreach ($error as $message) {
                        $this->Flash->error($message);
                    }
                }
            } else {
                $this->Flash->error('Erro na inclusão de ' . __('Seed') . '. Por favor, tente novamente');
            }
        }

        $seedNotes = $this->Seeds->SeedNotes->find('list', ['limit' => 200]);
        $cultures = $this->Seeds->Cultures->find('list', ['limit' => 200]);
        $varieties = $this->Seeds->Varieties->find('list', ['limit' => 200]);
        $technologies = $this->Seeds->Technologies->find('list', ['limit' => 200]);
        $cycles = $this->Seeds->Cycles->find('all');
        $zoningRegions = $this->Seeds->ZoningRegions->find('list', ['limit' => 200]);
        $productivePotencials = $this->Seeds->ProductivePotencials->find('list', ['limit' => 200]);
        $cities = $this->Seeds->Cities->find('list', ['limit' => 200]);
        $suppliers = $this->seedsSuppliers;
        $fertilities = $this->Seeds->Fertilities->find('list', ['limit' => 200]);
        $this->set(compact('seed', 'seedNotes', 'cultures', 'varieties', 'technologies', 'cycles', 'zoningRegions', 'productivePotencials', 'cities', 'suppliers', 'fertilities'));
    }

    /**
     * @param string|null $id Seed id.
     * @return \Cake\Http\Response|null|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $seed = $this->Seeds->get($id, [
            'contain' => ['Fertilities', 'Cycles'],
        ]);

        if (!$this->userAuthenticated->can('update', $seed)) {
            $this->Flash->error('Permissão negada!');
            return $this->redirect(['action' => 'index']);
        }

        if ($this->request->is(['patch', 'post', 'put'])) {
            $seed = $this->Seeds->patchEntity($seed, $this->request->getData());

            if ($this->Seeds->save($seed)) {
                $this->Flash->success('Edição realizada com sucesso');

                return $this->redirect(['action' => 'index']);
            }

            $this->Flash->error('Erro na edição de ' . __('Seed') . '. Por favor, tente novamente');
        }

        $seedNotes = $this->Seeds->SeedNotes->find('list', ['limit' => 200]);
        $cultures = $this->Seeds->Cultures->find('list', ['limit' => 200]);
        $varieties = $this->Seeds->Varieties->find('list', ['limit' => 200]);
        $technologies = $this->Seeds->Technologies->find('list', ['limit' => 200]);
        $cycles = $this->Seeds->Cycles->find('all');
        $zoningRegions = $this->Seeds->ZoningRegions->find('list', ['limit' => 200]);
        $productivePotencials = $this->Seeds->ProductivePotencials->find('list', ['limit' => 200]);
        $cities = $this->Seeds->Cities->find('list', ['limit' => 200]);
        $suppliers = $this->seedsSuppliers;
        $fertilities = $this->Seeds->Fertilities->find('list', ['limit' => 200]);
        $this->set(compact('seed', 'seedNotes', 'cultures', 'varieties', 'technologies', 'cycles', 'zoningRegions', 'productivePotencials', 'cities', 'suppliers', 'fertilities'));
    }

    /**
     * @param string|null $id Seed id.
     * @return \Cake\Http\Response|null|void Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $seed = $this->Seeds->get($id);

        if (!$this->userAuthenticated->can('delete', $seed)) {
            $this->Flash->error('Permissão negada!');
            return $this->redirect(['action' => 'index']);
        }

        if ($this->Seeds->delete($seed))
            $this->Flash->success('Exclusão realizada com sucesso');
        else {
            if (count($seed->getErrors()) > 0) {
                foreach ($seed->getErrors() as $error) {
                    foreach ($error as $message) {
                        $this->Flash->error($message);
                    }
                }
            } else {
                $this->Flash->error('Erro na exclusão de ' . __('Seed') . '. Por favor, tente novamente');
            }
        }

        return $this->redirect(['action' => 'index']);
    }
}
