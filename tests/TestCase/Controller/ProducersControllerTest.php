<?php
declare(strict_types=1);

namespace App\Test\TestCase\Controller;

use App\Controller\ProducersController;
use Cake\TestSuite\IntegrationTestTrait;
use Cake\TestSuite\TestCase;
use Cake\ORM\TableRegistry;

/**
 * App\Controller\ProducersController Test Case
 *
 * @uses \App\Controller\ProducersController
 */
class ProducersControllerTest extends TestCase
{
    use IntegrationTestTrait;

    /**
     * @var array
     */
    protected $fixtures = [
        'app.Producers',
        'app.Cities',
        'app.Immobiles',
    ];
    
    /**
     * @var \App\Model\Table\ProducersTable
     */
    protected $Producers;

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

        $this->Producers = TableRegistry::getTableLocator()->get('Producers');
    }

    public function testBeforeFilter(): void
    {
        $this->get('/producers');
        $this->assertResponseOk();
    }

    public function testIndex(): void
    {
        $this->get('/producers');
        $this->assertResponseOk();
    }

    public function testView(): void
    {
        $this->get('/producers/view/1');
        $this->assertResponseOk();
    }

    public function testAdd(): void
    {
        $this->get('/producers');
        $this->assertResponseOk();
    }

    public function testEdit(): void
    {
        $this->get('/producers/edit/1');
        $this->assertResponseOk();
    }

    public function testDelete(): void
    {
        $this->delete('/producers/delete/1');
        $this->assertRedirect(['controller' => 'Producers', 'action' => 'index']);
    }

    public function testAddPostData()
    {
        $this->markTestIncomplete('Not implemented yet.');

        /*
        $data = [];
        $this->post('/producers/add', $data);

        $this->assertResponseSuccess();
        $producers = TableRegistry::getTableLocator()->get('Producers');
        $query = $producers->find()->where(['' => $data['']]);
        $this->assertEquals(1, $query->count());
        */
    }

    public function testEditPostData()
    {
        $this->markTestIncomplete('Not implemented yet.');

        /*
        $data = [];
        $this->post('/producers/edit/1', $data);

        $this->assertResponseSuccess();
        $producers = TableRegistry::getTableLocator()->get('Producers');
        $query = $producers->find()->where(['' => $data['']]);
        $this->assertEquals(1, $query->count());
        */
    }
}
