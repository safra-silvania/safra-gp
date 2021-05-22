<?php
declare(strict_types=1);

namespace App\Test\TestCase\Controller;

use App\Controller\PlanFieldDetailsController;
use Cake\TestSuite\IntegrationTestTrait;
use Cake\TestSuite\TestCase;
use Cake\ORM\TableRegistry;

/**
 * App\Controller\PlanFieldDetailsController Test Case
 *
 * @uses \App\Controller\PlanFieldDetailsController
 */
class PlanFieldDetailsControllerTest extends TestCase
{
    use IntegrationTestTrait;

    /**
     * @var array
     */
    protected $fixtures = [
        'app.PlanFieldDetails',
        'app.FieldDetails',
        'app.Plans',
        'app.SelectedSeeds',
    ];
    
    /**
     * @var \App\Model\Table\PlanfielddetailsTable
     */
    protected $Planfielddetails;

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

        $this->Planfielddetails = TableRegistry::getTableLocator()->get('Planfielddetails');
    }

    public function testBeforeFilter(): void
    {
        $this->get('/planfielddetails');
        $this->assertResponseOk();
    }

    public function testIndex(): void
    {
        $this->get('/planfielddetails');
        $this->assertResponseOk();
    }

    public function testView(): void
    {
        $this->get('/planfielddetails/view/1');
        $this->assertResponseOk();
    }

    public function testAdd(): void
    {
        $this->get('/planfielddetails');
        $this->assertResponseOk();
    }

    public function testEdit(): void
    {
        $this->get('/planfielddetails/edit/1');
        $this->assertResponseOk();
    }

    public function testDelete(): void
    {
        $this->delete('/planfielddetails/delete/1');
        $this->assertRedirect(['controller' => 'Planfielddetails', 'action' => 'index']);
    }

    public function testAddPostData()
    {
        $this->markTestIncomplete('Not implemented yet.');

        /*
        $data = [];
        $this->post('/planfielddetails/add', $data);

        $this->assertResponseSuccess();
        $planfielddetails = TableRegistry::getTableLocator()->get('Planfielddetails');
        $query = $planfielddetails->find()->where(['' => $data['']]);
        $this->assertEquals(1, $query->count());
        */
    }

    public function testEditPostData()
    {
        $this->markTestIncomplete('Not implemented yet.');

        /*
        $data = [];
        $this->post('/planfielddetails/edit/1', $data);

        $this->assertResponseSuccess();
        $planfielddetails = TableRegistry::getTableLocator()->get('Planfielddetails');
        $query = $planfielddetails->find()->where(['' => $data['']]);
        $this->assertEquals(1, $query->count());
        */
    }
}
