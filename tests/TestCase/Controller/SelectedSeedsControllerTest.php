<?php
declare(strict_types=1);

namespace App\Test\TestCase\Controller;

use App\Controller\SelectedSeedsController;
use Cake\TestSuite\IntegrationTestTrait;
use Cake\TestSuite\TestCase;
use Cake\ORM\TableRegistry;

/**
 * App\Controller\SelectedSeedsController Test Case
 *
 * @uses \App\Controller\SelectedSeedsController
 */
class SelectedSeedsControllerTest extends TestCase
{
    use IntegrationTestTrait;

    /**
     * @var array
     */
    protected $fixtures = [
        'app.SelectedSeeds',
        'app.Seeds',
        'app.Plans',
        'app.PlanFieldDetails',
    ];
    
    /**
     * @var \App\Model\Table\SelectedseedsTable
     */
    protected $Selectedseeds;

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

        $this->Selectedseeds = TableRegistry::getTableLocator()->get('Selectedseeds');
    }

    public function testBeforeFilter(): void
    {
        $this->get('/selectedseeds');
        $this->assertResponseOk();
    }

    public function testIndex(): void
    {
        $this->get('/selectedseeds');
        $this->assertResponseOk();
    }

    public function testView(): void
    {
        $this->get('/selectedseeds/view/1');
        $this->assertResponseOk();
    }

    public function testAdd(): void
    {
        $this->get('/selectedseeds');
        $this->assertResponseOk();
    }

    public function testEdit(): void
    {
        $this->get('/selectedseeds/edit/1');
        $this->assertResponseOk();
    }

    public function testDelete(): void
    {
        $this->delete('/selectedseeds/delete/1');
        $this->assertRedirect(['controller' => 'Selectedseeds', 'action' => 'index']);
    }

    public function testAddPostData()
    {
        $this->markTestIncomplete('Not implemented yet.');

        /*
        $data = [];
        $this->post('/selectedseeds/add', $data);

        $this->assertResponseSuccess();
        $selectedseeds = TableRegistry::getTableLocator()->get('Selectedseeds');
        $query = $selectedseeds->find()->where(['' => $data['']]);
        $this->assertEquals(1, $query->count());
        */
    }

    public function testEditPostData()
    {
        $this->markTestIncomplete('Not implemented yet.');

        /*
        $data = [];
        $this->post('/selectedseeds/edit/1', $data);

        $this->assertResponseSuccess();
        $selectedseeds = TableRegistry::getTableLocator()->get('Selectedseeds');
        $query = $selectedseeds->find()->where(['' => $data['']]);
        $this->assertEquals(1, $query->count());
        */
    }
}
