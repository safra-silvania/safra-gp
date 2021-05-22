<?php
declare(strict_types=1);

namespace App\Controller;

use Cake\Controller\Controller;
use Cake\Cache\Cache;
use Cake\Core\Configure;

//audit stash
use AuditStash\Meta\ApplicationMetadata;
use AuditStash\Meta\RequestMetadata;
use Cake\Event\EventManager;

class AppController extends Controller
{
    protected $userAuthenticated;

    public function beforeFilter(\Cake\Event\EventInterface $event)
    {
        parent::beforeFilter($event);

        $this->userAuthenticated = $this->request->getAttribute('identity');

        // for all controllers in our application, make index and view
        // actions public, skipping the authentication check
        // $this->Authentication->addUnauthenticatedActions(['index', 'view', 'add', 'edit']);

        $this->set('production', Configure::read('production'));
        $this->set('userAuthenticated', $this->userAuthenticated);
        $this->set('collapsedSidebar', Cache::read('collapsedSidebar') === true);
        $this->set('controller', $this->request->getParam('controller'));

        $this->loadModel('Users');
        $this->loadModel('Roles');
        $this->loadModel('Producers');
        $this->loadModel('Immobiles');
        $this->loadModel('Fields');
        $this->loadModel('Seeds');
        $this->loadModel('Suppliers');
        $this->loadModel('States');
        $this->loadModel('Cities');
        $this->loadModel('CultivationSystems');
        $this->loadModel('Cultures');
        $this->loadModel('Fertilities');
        $this->loadModel('MeasureUnits');
        $this->loadModel('Cycles');
        $this->loadModel('ProductivePotencials');
        $this->loadModel('Technologies');
        $this->loadModel('Varieties');
        $this->loadModel('SupplierTypes');
        $this->loadModel('SeedNotes');
        $this->loadModel('Chemicals');
        $this->loadModel('ChemicalTargets');
        $this->loadModel('ChemicalMeasureUnits');
        $this->loadModel('ChemicalGroups');
        $this->loadModel('ChemicalClasses');
        $this->loadModel('ChemicalActionModes');
        $this->loadModel('ApplicationSeasons');
        $this->loadModel('ChemicalNotes');
        $this->loadModel('Fertilizers');
        $this->loadModel('FertilizerMeasureUnits');

        $this->loadModel('Plans');
        $this->loadModel('SelectedSeeds');
        $this->loadModel('SelectedChemicals');
        $this->loadModel('SelectedFertilizers');
        
        
        if ($this->userAuthenticated && $this->userAuthenticated->id) {
            
            $myself = $this->Users->get($this->userAuthenticated->id, ['contain' => ['Roles', 'UserStatuses']]);
            $this->set('myself', $myself);

            if (!$myself->isActive()) {
                $this->Authentication->logout();
                $this->Flash->error("Usuário desabilitado");
                return $this->redirect(['controller' => 'Users', 'action' => 'login']);
            }

            // audit stash
            EventManager::instance()->on(new ApplicationMetadata('SafraConsultoria (admin)', [
                'ip' => $this->request->clientIp(),
                'url' => $this->request->getRequestTarget(),
                'user' => [
                    'id' => $this->userAuthenticated->id,
                    'name' => $this->userAuthenticated->name,
                    'email' => $this->userAuthenticated->email,
                    'role' => $myself->role->id.'-'.$myself->role->name,
                ],
            ]));
        }

        $this->setAccessVariables();

        //allow all...
        // $this->Authorization->skipAuthorization();
    }

    private function setAccessVariables():void {
        if ($this->userAuthenticated && $this->userAuthenticated->id) {
            $this->set('canAccessRoles', $this->userAuthenticated->can('access', $this->Roles->newEmptyEntity()));
            $this->set('canAccessUsers', $this->userAuthenticated->can('access', $this->Users->newEmptyEntity()));
            $this->set('canAccessProducers', $this->userAuthenticated->can('access', $this->Producers->newEmptyEntity()));
            $this->set('canAccessImmobiles', $this->userAuthenticated->can('access', $this->Immobiles->newEmptyEntity()));
            $this->set('canAccessFields', $this->userAuthenticated->can('access', $this->Fields->newEmptyEntity()));
            $this->set('canAccessSeeds', $this->userAuthenticated->can('access', $this->Seeds->newEmptyEntity()));
            $this->set('canAccessSuppliers', $this->userAuthenticated->can('access', $this->Suppliers->newEmptyEntity()));
            $this->set('canAccessStates', $this->userAuthenticated->can('access', $this->States->newEmptyEntity()));
            $this->set('canAccessCities', $this->userAuthenticated->can('access', $this->Cities->newEmptyEntity()));
            $this->set('canAccessCultivationSystems', $this->userAuthenticated->can('access', $this->CultivationSystems->newEmptyEntity()));
            $this->set('canAccessCultures', $this->userAuthenticated->can('access', $this->Cultures->newEmptyEntity()));
            $this->set('canAccessFertilities', $this->userAuthenticated->can('access', $this->Fertilities->newEmptyEntity()));
            $this->set('canAccessMeasureUnits', $this->userAuthenticated->can('access', $this->MeasureUnits->newEmptyEntity()));
            $this->set('canAccessCycles', $this->userAuthenticated->can('access', $this->Cycles->newEmptyEntity()));
            $this->set('canAccessProductivePotencials', $this->userAuthenticated->can('access', $this->ProductivePotencials->newEmptyEntity()));
            $this->set('canAccessTechnologies', $this->userAuthenticated->can('access', $this->Technologies->newEmptyEntity()));
            $this->set('canAccessVarieties', $this->userAuthenticated->can('access', $this->Varieties->newEmptyEntity()));
            $this->set('canAccessSupplierTypes', $this->userAuthenticated->can('access', $this->SupplierTypes->newEmptyEntity()));
            $this->set('canAccessSeedNotes', $this->userAuthenticated->can('access', $this->SeedNotes->newEmptyEntity()));
            $this->set('canAccessChemicals', $this->userAuthenticated->can('access', $this->Chemicals->newEmptyEntity()));
            $this->set('canAccessChemicalTargets', $this->userAuthenticated->can('access', $this->ChemicalTargets->newEmptyEntity()));
            $this->set('canAccessChemicalMeasureUnits', $this->userAuthenticated->can('access', $this->ChemicalMeasureUnits->newEmptyEntity()));
            $this->set('canAccessChemicalGroups', $this->userAuthenticated->can('access', $this->ChemicalGroups->newEmptyEntity()));
            $this->set('canAccessChemicalClasses', $this->userAuthenticated->can('access', $this->ChemicalClasses->newEmptyEntity()));
            $this->set('canAccessChemicalActionModes', $this->userAuthenticated->can('access', $this->ChemicalActionModes->newEmptyEntity()));
            $this->set('canAccessApplicationSeasons', $this->userAuthenticated->can('access', $this->ApplicationSeasons->newEmptyEntity()));
            $this->set('canAccessChemicalNotes', $this->userAuthenticated->can('access', $this->ChemicalNotes->newEmptyEntity()));
            $this->set('canAccessFertilizerMeasureUnits', $this->userAuthenticated->can('access', $this->FertilizerMeasureUnits->newEmptyEntity()));
            $this->set('canAccessFertilizers', $this->userAuthenticated->can('access', $this->Fertilizers->newEmptyEntity()));
            $this->set('canAccessPlans', $this->userAuthenticated->can('access', $this->Plans->newEmptyEntity()));
            $this->set('canAccessSelectedSeeds', $this->userAuthenticated->can('access', $this->SelectedSeeds->newEmptyEntity()));
            $this->set('canAccessSelectedChemicals', $this->userAuthenticated->can('access', $this->SelectedChemicals->newEmptyEntity()));
            $this->set('canAccessSelectedFertilizers', $this->userAuthenticated->can('access', $this->SelectedFertilizers->newEmptyEntity()));

        } else {
            $this->set('canAccessRoles', null);
            $this->set('canAccessUsers', null);
            $this->set('canAccessProducers', null);
            $this->set('canAccessImmobiles', null);
            $this->set('canAccessFields', null);
            $this->set('canAccessSeeds', null);
            $this->set('canAccessSuppliers', null);
            $this->set('canAccessStates', null);
            $this->set('canAccessCities', null);
            $this->set('canAccessCultivationSystems', null);
            $this->set('canAccessCultures', null);
            $this->set('canAccessFertilities', null);
            $this->set('canAccessMeasureUnits', null);
            $this->set('canAccessCycles', null);
            $this->set('canAccessProductivePotencials', null);
            $this->set('canAccessTechnologies', null);
            $this->set('canAccessVarieties', null);
            $this->set('canAccessSupplierTypes', null);
            $this->set('canAccessSeedNotes', null);
            $this->set('canAccessChemicals', null);
            $this->set('canAccessChemicalTargets', null);
            $this->set('canAccessChemicalMeasureUnits', null);
            $this->set('canAccessChemicalGroups', null);
            $this->set('canAccessChemicalClasses', null);
            $this->set('canAccessChemicalActionModes', null);
            $this->set('canAccessApplicationSeasons', null);
            $this->set('canAccessChemicalNotes', null);
            $this->set('canAccessFertilizerMeasureUnits', null);
            $this->set('canAccessFertilizers', null);
            $this->set('canAccessPlans', null);
            $this->set('canAccessSelectedSeeds', null);
            $this->set('canAccessSelectedChemicals', null);
            $this->set('canAccessSelectedFertilizers', null);
        }
    }

    /**
     * Initialization hook method.
     *
     * Use this method to add common initialization code like loading components.
     *
     * e.g. `$this->loadComponent('FormProtection');`
     *
     * @return void
     */
    public function initialize(): void
    {
        parent::initialize();

        $this->loadComponent('RequestHandler');
        $this->loadComponent('Flash');
        $this->loadComponent('Authentication.Authentication');

        $this->loadComponent('Authorization.Authorization', [
            'skipAuthorization' => [
                'login', 'logout', 'toolbar'
            ]
        ]);

        /*
         * Enable the following component for recommended CakePHP form protection settings.
         * see https://book.cakephp.org/4/en/controllers/components/form-protection.html
         */
        // $this->loadComponent('FormProtection');
    }
}
