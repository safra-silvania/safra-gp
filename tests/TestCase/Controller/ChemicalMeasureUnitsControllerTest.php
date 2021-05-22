<?php
declare(strict_types=1);

namespace App\Test\TestCase\Controller;

use App\Controller\ChemicalMeasureUnitsController;
use Cake\TestSuite\IntegrationTestTrait;
use Cake\TestSuite\TestCase;
use Cake\ORM\TableRegistry;

/**
 * App\Controller\ChemicalMeasureUnitsController Test Case
 *
 * @uses \App\Controller\ChemicalMeasureUnitsController
 */
class ChemicalMeasureUnitsControllerTest extends TestCase
{
    use IntegrationTestTrait;

    /**
     * @var array
     */
    protected $fixtures = [
        'app.ChemicalMeasureUnits',
        'app.Chemicals',
    ];
    
    /**
     * @var \App\Model\Table\ChemicalmeasureunitsTable
     */
    protected $Chemicalmeasureunits;

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

        $this->Chemicalmeasureunits = TableRegistry::getTableLocator()->get('Chemicalmeasureunits');
    }

    public function testBeforeFilter(): void
    {
        $this->get('/chemicalmeasureunits');
        $this->assertResponseOk();
    }

    public function testIndex(): void
    {
        $this->get('/chemicalmeasureunits');
        $this->assertResponseOk();
    }

    public function testView(): void
    {
        $this->get('/chemicalmeasureunits/view/1');
        $this->assertResponseOk();
    }

    public function testAdd(): void
    {
        $this->get('/chemicalmeasureunits');
        $this->assertResponseOk();
    }

    public function testEdit(): void
    {
        $this->get('/chemicalmeasureunits/edit/1');
        $this->assertResponseOk();
    }

    public function testDelete(): void
    {
        $this->delete('/chemicalmeasureunits/delete/1');
        $this->assertRedirect(['controller' => 'Chemicalmeasureunits', 'action' => 'index']);
    }

    public function testAddPostData()
    {
        $this->markTestIncomplete('Not implemented yet.');

        /*
        $data = [];
        $this->post('/chemicalmeasureunits/add', $data);

        $this->assertResponseSuccess();
        $chemicalmeasureunits = TableRegistry::getTableLocator()->get('Chemicalmeasureunits');
        $query = $chemicalmeasureunits->find()->where(['' => $data['']]);
        $this->assertEquals(1, $query->count());
        */
    }

    public function testEditPostData()
    {
        $this->markTestIncomplete('Not implemented yet.');

        /*
        $data = [];
        $this->post('/chemicalmeasureunits/edit/1', $data);

        $this->assertResponseSuccess();
        $chemicalmeasureunits = TableRegistry::getTableLocator()->get('Chemicalmeasureunits');
        $query = $chemicalmeasureunits->find()->where(['' => $data['']]);
        $this->assertEquals(1, $query->count());
        */
    }
}
