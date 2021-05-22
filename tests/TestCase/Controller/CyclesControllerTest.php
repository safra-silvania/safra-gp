<?php
declare(strict_types=1);

namespace App\Test\TestCase\Controller;

use App\Controller\CyclesController;
use Cake\TestSuite\IntegrationTestTrait;
use Cake\TestSuite\TestCase;
use Cake\ORM\TableRegistry;

/**
 * App\Controller\CyclesController Test Case
 *
 * @uses \App\Controller\CyclesController
 */
class CyclesControllerTest extends TestCase
{
    use IntegrationTestTrait;

    /**
     * @var array
     */
    protected $fixtures = [
        'app.Cycles',
        'app.Seeds',
    ];
    
    /**
     * @var \App\Model\Table\CyclesTable
     */
    protected $Cycles;

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

        $this->Cycles = TableRegistry::getTableLocator()->get('Cycles');
    }

    public function testBeforeFilter(): void
    {
        $this->get('/cycles');
        $this->assertResponseOk();
    }

    public function testIndex(): void
    {
        $this->get('/cycles');
        $this->assertResponseOk();
    }

    public function testView(): void
    {
        $this->get('/cycles/view/1');
        $this->assertResponseOk();
    }

    public function testAdd(): void
    {
        $this->get('/cycles');
        $this->assertResponseOk();
    }

    public function testEdit(): void
    {
        $this->get('/cycles/edit/1');
        $this->assertResponseOk();
    }

    public function testDelete(): void
    {
        $this->delete('/cycles/delete/1');
        $this->assertRedirect(['controller' => 'Cycles', 'action' => 'index']);
    }

    public function testAddPostData()
    {
        $this->markTestIncomplete('Not implemented yet.');

        /*
        $data = [];
        $this->post('/cycles/add', $data);

        $this->assertResponseSuccess();
        $cycles = TableRegistry::getTableLocator()->get('Cycles');
        $query = $cycles->find()->where(['' => $data['']]);
        $this->assertEquals(1, $query->count());
        */
    }

    public function testEditPostData()
    {
        $this->markTestIncomplete('Not implemented yet.');

        /*
        $data = [];
        $this->post('/cycles/edit/1', $data);

        $this->assertResponseSuccess();
        $cycles = TableRegistry::getTableLocator()->get('Cycles');
        $query = $cycles->find()->where(['' => $data['']]);
        $this->assertEquals(1, $query->count());
        */
    }
}
