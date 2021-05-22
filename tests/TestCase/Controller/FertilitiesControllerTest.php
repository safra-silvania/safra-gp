<?php
declare(strict_types=1);

namespace App\Test\TestCase\Controller;

use App\Controller\FertilitiesController;
use Cake\TestSuite\IntegrationTestTrait;
use Cake\TestSuite\TestCase;
use Cake\ORM\TableRegistry;

/**
 * App\Controller\FertilitiesController Test Case
 *
 * @uses \App\Controller\FertilitiesController
 */
class FertilitiesControllerTest extends TestCase
{
    use IntegrationTestTrait;

    /**
     * @var array
     */
    protected $fixtures = [
        'app.Fertilities',
        'app.FieldDetails',
        'app.Fields',
        'app.Seeds',
        'app.FertilitiesSeeds',
    ];
    
    /**
     * @var \App\Model\Table\FertilitiesTable
     */
    protected $Fertilities;

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

        $this->Fertilities = TableRegistry::getTableLocator()->get('Fertilities');
    }

    public function testBeforeFilter(): void
    {
        $this->get('/fertilities');
        $this->assertResponseOk();
    }

    public function testIndex(): void
    {
        $this->get('/fertilities');
        $this->assertResponseOk();
    }

    public function testView(): void
    {
        $this->get('/fertilities/view/1');
        $this->assertResponseOk();
    }

    public function testAdd(): void
    {
        $this->get('/fertilities');
        $this->assertResponseOk();
    }

    public function testEdit(): void
    {
        $this->get('/fertilities/edit/1');
        $this->assertResponseOk();
    }

    public function testDelete(): void
    {
        $this->delete('/fertilities/delete/1');
        $this->assertRedirect(['controller' => 'Fertilities', 'action' => 'index']);
    }

    public function testAddPostData()
    {
        $this->markTestIncomplete('Not implemented yet.');

        /*
        $data = [];
        $this->post('/fertilities/add', $data);

        $this->assertResponseSuccess();
        $fertilities = TableRegistry::getTableLocator()->get('Fertilities');
        $query = $fertilities->find()->where(['' => $data['']]);
        $this->assertEquals(1, $query->count());
        */
    }

    public function testEditPostData()
    {
        $this->markTestIncomplete('Not implemented yet.');

        /*
        $data = [];
        $this->post('/fertilities/edit/1', $data);

        $this->assertResponseSuccess();
        $fertilities = TableRegistry::getTableLocator()->get('Fertilities');
        $query = $fertilities->find()->where(['' => $data['']]);
        $this->assertEquals(1, $query->count());
        */
    }
}
