<?php
declare(strict_types=1);

namespace App\Test\TestCase\Controller;

use App\Controller\PlansController;
use Cake\TestSuite\IntegrationTestTrait;
use Cake\TestSuite\TestCase;
use Cake\ORM\TableRegistry;

/**
 * App\Controller\PlansController Test Case
 *
 * @uses \App\Controller\PlansController
 */
class PlansControllerTest extends TestCase
{
    use IntegrationTestTrait;

    /**
     * @var array
     */
    protected $fixtures = [
        'app.Plans',
        'app.Immobiles',
        'app.PlanStatuses',
        'app.PlanFieldDetails',
        'app.SelectedChemicals',
        'app.SelectedFertilizers',
        'app.SelectedSeeds',
    ];
    
    /**
     * @var \App\Model\Table\PlansTable
     */
    protected $Plans;

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

        $this->Plans = TableRegistry::getTableLocator()->get('Plans');
    }

    public function testBeforeFilter(): void
    {
        $this->get('/plans');
        $this->assertResponseOk();
    }

    public function testIndex(): void
    {
        $this->get('/plans');
        $this->assertResponseOk();
    }

    public function testView(): void
    {
        $this->get('/plans/view/1');
        $this->assertResponseOk();
    }

    public function testAdd(): void
    {
        $this->get('/plans');
        $this->assertResponseOk();
    }

    public function testEdit(): void
    {
        $this->get('/plans/edit/1');
        $this->assertResponseOk();
    }

    public function testDelete(): void
    {
        $this->delete('/plans/delete/1');
        $this->assertRedirect(['controller' => 'Plans', 'action' => 'index']);
    }

    public function testAddPostData()
    {
        $this->markTestIncomplete('Not implemented yet.');

        /*
        $data = [];
        $this->post('/plans/add', $data);

        $this->assertResponseSuccess();
        $plans = TableRegistry::getTableLocator()->get('Plans');
        $query = $plans->find()->where(['' => $data['']]);
        $this->assertEquals(1, $query->count());
        */
    }

    public function testEditPostData()
    {
        $this->markTestIncomplete('Not implemented yet.');

        /*
        $data = [];
        $this->post('/plans/edit/1', $data);

        $this->assertResponseSuccess();
        $plans = TableRegistry::getTableLocator()->get('Plans');
        $query = $plans->find()->where(['' => $data['']]);
        $this->assertEquals(1, $query->count());
        */
    }
}
