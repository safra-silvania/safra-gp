<?php
declare(strict_types=1);

namespace App\Test\TestCase\Controller;

use App\Controller\ChemicalClassesController;
use Cake\TestSuite\IntegrationTestTrait;
use Cake\TestSuite\TestCase;
use Cake\ORM\TableRegistry;

/**
 * App\Controller\ChemicalClassesController Test Case
 *
 * @uses \App\Controller\ChemicalClassesController
 */
class ChemicalClassesControllerTest extends TestCase
{
    use IntegrationTestTrait;

    /**
     * @var array
     */
    protected $fixtures = [
        'app.ChemicalClasses',
        'app.Chemicals',
    ];
    
    /**
     * @var \App\Model\Table\ChemicalclassesTable
     */
    protected $Chemicalclasses;

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

        $this->Chemicalclasses = TableRegistry::getTableLocator()->get('Chemicalclasses');
    }

    public function testBeforeFilter(): void
    {
        $this->get('/chemicalclasses');
        $this->assertResponseOk();
    }

    public function testIndex(): void
    {
        $this->get('/chemicalclasses');
        $this->assertResponseOk();
    }

    public function testView(): void
    {
        $this->get('/chemicalclasses/view/1');
        $this->assertResponseOk();
    }

    public function testAdd(): void
    {
        $this->get('/chemicalclasses');
        $this->assertResponseOk();
    }

    public function testEdit(): void
    {
        $this->get('/chemicalclasses/edit/1');
        $this->assertResponseOk();
    }

    public function testDelete(): void
    {
        $this->delete('/chemicalclasses/delete/1');
        $this->assertRedirect(['controller' => 'Chemicalclasses', 'action' => 'index']);
    }

    public function testAddPostData()
    {
        $this->markTestIncomplete('Not implemented yet.');

        /*
        $data = [];
        $this->post('/chemicalclasses/add', $data);

        $this->assertResponseSuccess();
        $chemicalclasses = TableRegistry::getTableLocator()->get('Chemicalclasses');
        $query = $chemicalclasses->find()->where(['' => $data['']]);
        $this->assertEquals(1, $query->count());
        */
    }

    public function testEditPostData()
    {
        $this->markTestIncomplete('Not implemented yet.');

        /*
        $data = [];
        $this->post('/chemicalclasses/edit/1', $data);

        $this->assertResponseSuccess();
        $chemicalclasses = TableRegistry::getTableLocator()->get('Chemicalclasses');
        $query = $chemicalclasses->find()->where(['' => $data['']]);
        $this->assertEquals(1, $query->count());
        */
    }
}
