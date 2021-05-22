<?php
declare(strict_types=1);

namespace App\Test\TestCase\Controller;

use App\Controller\ChemicalGroupsController;
use Cake\TestSuite\IntegrationTestTrait;
use Cake\TestSuite\TestCase;
use Cake\ORM\TableRegistry;

/**
 * App\Controller\ChemicalGroupsController Test Case
 *
 * @uses \App\Controller\ChemicalGroupsController
 */
class ChemicalGroupsControllerTest extends TestCase
{
    use IntegrationTestTrait;

    /**
     * @var array
     */
    protected $fixtures = [
        'app.ChemicalGroups',
    ];
    
    /**
     * @var \App\Model\Table\ChemicalgroupsTable
     */
    protected $Chemicalgroups;

    public function setUp(): void
    {
        parent::setUp();

        $this->session([
            'Auth' => [
                'User' => [
                    'id' => 1,
                    'role_id' => 1,
                    'username' => 'testing',
                    'email' => 'testing@test.com',
                ]
            ]
        ]);

        $this->enableCsrfToken();
        $this->enableSecurityToken();

        $this->Chemicalgroups = TableRegistry::getTableLocator()->get('Chemicalgroups');
    }

    public function testBeforeFilter(): void
    {
        $this->get('/chemicalgroups');
        $this->assertResponseOk();
    }

    public function testIndex(): void
    {
        $this->get('/chemicalgroups');
        $this->assertResponseOk();
    }

    public function testView(): void
    {
        $this->get('/chemicalgroups/view/1');
        $this->assertResponseOk();
    }

    public function testAdd(): void
    {
        $this->get('/chemicalgroups');
        $this->assertResponseOk();
    }

    public function testEdit(): void
    {
        $this->get('/chemicalgroups/edit/1');
        $this->assertResponseOk();
    }

    public function testDelete(): void
    {
        $this->delete('/chemicalgroups/delete/1');
        $this->assertRedirect(['controller' => 'Chemicalgroups', 'action' => 'index']);
    }

    public function testAddPostData()
    {
        $this->markTestIncomplete('Not implemented yet.');

        /*
        $data = [];
        $this->post('/chemicalgroups/add', $data);

        $this->assertResponseSuccess();
        $chemicalgroups = TableRegistry::getTableLocator()->get('Chemicalgroups');
        $query = $chemicalgroups->find()->where(['' => $data['']]);
        $this->assertEquals(1, $query->count());
        */
    }

    public function testEditPostData()
    {
        $this->markTestIncomplete('Not implemented yet.');

        /*
        $data = [];
        $this->post('/chemicalgroups/edit/1', $data);

        $this->assertResponseSuccess();
        $chemicalgroups = TableRegistry::getTableLocator()->get('Chemicalgroups');
        $query = $chemicalgroups->find()->where(['' => $data['']]);
        $this->assertEquals(1, $query->count());
        */
    }
}
