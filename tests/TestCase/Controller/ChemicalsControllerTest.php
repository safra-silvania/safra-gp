<?php
declare(strict_types=1);

namespace App\Test\TestCase\Controller;

use App\Controller\ChemicalsController;
use Cake\TestSuite\IntegrationTestTrait;
use Cake\TestSuite\TestCase;
use Cake\ORM\TableRegistry;

/**
 * App\Controller\ChemicalsController Test Case
 *
 * @uses \App\Controller\ChemicalsController
 */
class ChemicalsControllerTest extends TestCase
{
    use IntegrationTestTrait;

    /**
     * @var array
     */
    protected $fixtures = [
        'app.Chemicals',
        'app.ChemicalNotes',
        'app.ChemicalClasses',
        'app.Suppliers',
        'app.ChemicalMeasureUnits',
        'app.ChemicalTargets',
        'app.ApplicationSeasons',
        'app.ChemicalActionModes',
        'app.Cultures',
        'app.ChemicalsApplicationSeasons',
        'app.ChemicalsChemicalActionModes',
        'app.ChemicalsCultures',
    ];
    
    /**
     * @var \App\Model\Table\ChemicalsTable
     */
    protected $Chemicals;

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

        $this->Chemicals = TableRegistry::getTableLocator()->get('Chemicals');
    }

    public function testBeforeFilter(): void
    {
        $this->get('/chemicals');
        $this->assertResponseOk();
    }

    public function testIndex(): void
    {
        $this->get('/chemicals');
        $this->assertResponseOk();
    }

    public function testView(): void
    {
        $this->get('/chemicals/view/1');
        $this->assertResponseOk();
    }

    public function testAdd(): void
    {
        $this->get('/chemicals');
        $this->assertResponseOk();
    }

    public function testEdit(): void
    {
        $this->get('/chemicals/edit/1');
        $this->assertResponseOk();
    }

    public function testDelete(): void
    {
        $this->delete('/chemicals/delete/1');
        $this->assertRedirect(['controller' => 'Chemicals', 'action' => 'index']);
    }

    public function testAddPostData()
    {
        $this->markTestIncomplete('Not implemented yet.');

        /*
        $data = [];
        $this->post('/chemicals/add', $data);

        $this->assertResponseSuccess();
        $chemicals = TableRegistry::getTableLocator()->get('Chemicals');
        $query = $chemicals->find()->where(['' => $data['']]);
        $this->assertEquals(1, $query->count());
        */
    }

    public function testEditPostData()
    {
        $this->markTestIncomplete('Not implemented yet.');

        /*
        $data = [];
        $this->post('/chemicals/edit/1', $data);

        $this->assertResponseSuccess();
        $chemicals = TableRegistry::getTableLocator()->get('Chemicals');
        $query = $chemicals->find()->where(['' => $data['']]);
        $this->assertEquals(1, $query->count());
        */
    }
}
