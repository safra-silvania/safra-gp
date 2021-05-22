<?php
declare(strict_types=1);

namespace App\Test\TestCase\Controller;

use App\Controller\FertilitiesSeedsController;
use Cake\TestSuite\IntegrationTestTrait;
use Cake\TestSuite\TestCase;
use Cake\ORM\TableRegistry;

/**
 * App\Controller\FertilitiesSeedsController Test Case
 *
 * @uses \App\Controller\FertilitiesSeedsController
 */
class FertilitiesSeedsControllerTest extends TestCase
{
    use IntegrationTestTrait;

    /**
     * @var array
     */
    protected $fixtures = [
        'app.FertilitiesSeeds',
        'app.Seeds',
        'app.Fertilities',
    ];
    
    /**
     * @var \App\Model\Table\FertilitiesseedsTable
     */
    protected $Fertilitiesseeds;

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

        $this->Fertilitiesseeds = TableRegistry::getTableLocator()->get('Fertilitiesseeds');
    }

    public function testBeforeFilter(): void
    {
        $this->get('/fertilitiesseeds');
        $this->assertResponseOk();
    }

    public function testIndex(): void
    {
        $this->get('/fertilitiesseeds');
        $this->assertResponseOk();
    }

    public function testView(): void
    {
        $this->get('/fertilitiesseeds/view/1');
        $this->assertResponseOk();
    }

    public function testAdd(): void
    {
        $this->get('/fertilitiesseeds');
        $this->assertResponseOk();
    }

    public function testEdit(): void
    {
        $this->get('/fertilitiesseeds/edit/1');
        $this->assertResponseOk();
    }

    public function testDelete(): void
    {
        $this->delete('/fertilitiesseeds/delete/1');
        $this->assertRedirect(['controller' => 'Fertilitiesseeds', 'action' => 'index']);
    }

    public function testAddPostData()
    {
        $this->markTestIncomplete('Not implemented yet.');

        /*
        $data = [];
        $this->post('/fertilitiesseeds/add', $data);

        $this->assertResponseSuccess();
        $fertilitiesseeds = TableRegistry::getTableLocator()->get('Fertilitiesseeds');
        $query = $fertilitiesseeds->find()->where(['' => $data['']]);
        $this->assertEquals(1, $query->count());
        */
    }

    public function testEditPostData()
    {
        $this->markTestIncomplete('Not implemented yet.');

        /*
        $data = [];
        $this->post('/fertilitiesseeds/edit/1', $data);

        $this->assertResponseSuccess();
        $fertilitiesseeds = TableRegistry::getTableLocator()->get('Fertilitiesseeds');
        $query = $fertilitiesseeds->find()->where(['' => $data['']]);
        $this->assertEquals(1, $query->count());
        */
    }
}
