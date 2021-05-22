<?php
declare(strict_types=1);

namespace App\Test\TestCase\Controller;

use App\Controller\PlanStatusesController;
use Cake\TestSuite\IntegrationTestTrait;
use Cake\TestSuite\TestCase;
use Cake\ORM\TableRegistry;

/**
 * App\Controller\PlanStatusesController Test Case
 *
 * @uses \App\Controller\PlanStatusesController
 */
class PlanStatusesControllerTest extends TestCase
{
    use IntegrationTestTrait;

    /**
     * @var array
     */
    protected $fixtures = [
        'app.PlanStatuses',
        'app.Plans',
    ];
    
    /**
     * @var \App\Model\Table\PlanstatusesTable
     */
    protected $Planstatuses;

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

        $this->Planstatuses = TableRegistry::getTableLocator()->get('Planstatuses');
    }

    public function testBeforeFilter(): void
    {
        $this->get('/planstatuses');
        $this->assertResponseOk();
    }

    public function testIndex(): void
    {
        $this->get('/planstatuses');
        $this->assertResponseOk();
    }

    public function testView(): void
    {
        $this->get('/planstatuses/view/1');
        $this->assertResponseOk();
    }

    public function testAdd(): void
    {
        $this->get('/planstatuses');
        $this->assertResponseOk();
    }

    public function testEdit(): void
    {
        $this->get('/planstatuses/edit/1');
        $this->assertResponseOk();
    }

    public function testDelete(): void
    {
        $this->delete('/planstatuses/delete/1');
        $this->assertRedirect(['controller' => 'Planstatuses', 'action' => 'index']);
    }

    public function testAddPostData()
    {
        $this->markTestIncomplete('Not implemented yet.');

        /*
        $data = [];
        $this->post('/planstatuses/add', $data);

        $this->assertResponseSuccess();
        $planstatuses = TableRegistry::getTableLocator()->get('Planstatuses');
        $query = $planstatuses->find()->where(['' => $data['']]);
        $this->assertEquals(1, $query->count());
        */
    }

    public function testEditPostData()
    {
        $this->markTestIncomplete('Not implemented yet.');

        /*
        $data = [];
        $this->post('/planstatuses/edit/1', $data);

        $this->assertResponseSuccess();
        $planstatuses = TableRegistry::getTableLocator()->get('Planstatuses');
        $query = $planstatuses->find()->where(['' => $data['']]);
        $this->assertEquals(1, $query->count());
        */
    }
}
