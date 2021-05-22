<?php
declare(strict_types=1);

namespace App\Test\TestCase\Controller;

use App\Controller\ChemicalActionModesController;
use Cake\TestSuite\IntegrationTestTrait;
use Cake\TestSuite\TestCase;
use Cake\ORM\TableRegistry;

/**
 * App\Controller\ChemicalActionModesController Test Case
 *
 * @uses \App\Controller\ChemicalActionModesController
 */
class ChemicalActionModesControllerTest extends TestCase
{
    use IntegrationTestTrait;

    /**
     * @var array
     */
    protected $fixtures = [
        'app.ChemicalActionModes',
        'app.Chemicals',
        'app.ChemicalsChemicalActionModes',
    ];
    
    /**
     * @var \App\Model\Table\ChemicalactionmodesTable
     */
    protected $Chemicalactionmodes;

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

        $this->Chemicalactionmodes = TableRegistry::getTableLocator()->get('Chemicalactionmodes');
    }

    public function testBeforeFilter(): void
    {
        $this->get('/chemicalactionmodes');
        $this->assertResponseOk();
    }

    public function testIndex(): void
    {
        $this->get('/chemicalactionmodes');
        $this->assertResponseOk();
    }

    public function testView(): void
    {
        $this->get('/chemicalactionmodes/view/1');
        $this->assertResponseOk();
    }

    public function testAdd(): void
    {
        $this->get('/chemicalactionmodes');
        $this->assertResponseOk();
    }

    public function testEdit(): void
    {
        $this->get('/chemicalactionmodes/edit/1');
        $this->assertResponseOk();
    }

    public function testDelete(): void
    {
        $this->delete('/chemicalactionmodes/delete/1');
        $this->assertRedirect(['controller' => 'Chemicalactionmodes', 'action' => 'index']);
    }

    public function testAddPostData()
    {
        $this->markTestIncomplete('Not implemented yet.');

        /*
        $data = [];
        $this->post('/chemicalactionmodes/add', $data);

        $this->assertResponseSuccess();
        $chemicalactionmodes = TableRegistry::getTableLocator()->get('Chemicalactionmodes');
        $query = $chemicalactionmodes->find()->where(['' => $data['']]);
        $this->assertEquals(1, $query->count());
        */
    }

    public function testEditPostData()
    {
        $this->markTestIncomplete('Not implemented yet.');

        /*
        $data = [];
        $this->post('/chemicalactionmodes/edit/1', $data);

        $this->assertResponseSuccess();
        $chemicalactionmodes = TableRegistry::getTableLocator()->get('Chemicalactionmodes');
        $query = $chemicalactionmodes->find()->where(['' => $data['']]);
        $this->assertEquals(1, $query->count());
        */
    }
}
