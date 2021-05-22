<?php
declare(strict_types=1);

namespace App\Test\TestCase\Controller;

use App\Controller\SelectedFertilizersController;
use Cake\TestSuite\IntegrationTestTrait;
use Cake\TestSuite\TestCase;
use Cake\ORM\TableRegistry;

/**
 * App\Controller\SelectedFertilizersController Test Case
 *
 * @uses \App\Controller\SelectedFertilizersController
 */
class SelectedFertilizersControllerTest extends TestCase
{
    use IntegrationTestTrait;

    /**
     * @var array
     */
    protected $fixtures = [
        'app.SelectedFertilizers',
        'app.Fertilizers',
        'app.Plans',
    ];
    
    /**
     * @var \App\Model\Table\SelectedfertilizersTable
     */
    protected $Selectedfertilizers;

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

        $this->Selectedfertilizers = TableRegistry::getTableLocator()->get('Selectedfertilizers');
    }

    public function testBeforeFilter(): void
    {
        $this->get('/selectedfertilizers');
        $this->assertResponseOk();
    }

    public function testIndex(): void
    {
        $this->get('/selectedfertilizers');
        $this->assertResponseOk();
    }

    public function testView(): void
    {
        $this->get('/selectedfertilizers/view/1');
        $this->assertResponseOk();
    }

    public function testAdd(): void
    {
        $this->get('/selectedfertilizers');
        $this->assertResponseOk();
    }

    public function testEdit(): void
    {
        $this->get('/selectedfertilizers/edit/1');
        $this->assertResponseOk();
    }

    public function testDelete(): void
    {
        $this->delete('/selectedfertilizers/delete/1');
        $this->assertRedirect(['controller' => 'Selectedfertilizers', 'action' => 'index']);
    }

    public function testAddPostData()
    {
        $this->markTestIncomplete('Not implemented yet.');

        /*
        $data = [];
        $this->post('/selectedfertilizers/add', $data);

        $this->assertResponseSuccess();
        $selectedfertilizers = TableRegistry::getTableLocator()->get('Selectedfertilizers');
        $query = $selectedfertilizers->find()->where(['' => $data['']]);
        $this->assertEquals(1, $query->count());
        */
    }

    public function testEditPostData()
    {
        $this->markTestIncomplete('Not implemented yet.');

        /*
        $data = [];
        $this->post('/selectedfertilizers/edit/1', $data);

        $this->assertResponseSuccess();
        $selectedfertilizers = TableRegistry::getTableLocator()->get('Selectedfertilizers');
        $query = $selectedfertilizers->find()->where(['' => $data['']]);
        $this->assertEquals(1, $query->count());
        */
    }
}
