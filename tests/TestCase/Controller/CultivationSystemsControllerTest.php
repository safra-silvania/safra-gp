<?php
declare(strict_types=1);

namespace App\Test\TestCase\Controller;

use App\Controller\CultivationSystemsController;
use Cake\TestSuite\IntegrationTestTrait;
use Cake\TestSuite\TestCase;
use Cake\ORM\TableRegistry;

/**
 * App\Controller\CultivationSystemsController Test Case
 *
 * @uses \App\Controller\CultivationSystemsController
 */
class CultivationSystemsControllerTest extends TestCase
{
    use IntegrationTestTrait;

    /**
     * @var array
     */
    protected $fixtures = [
        'app.CultivationSystems',
        'app.Fields',
    ];
    
    /**
     * @var \App\Model\Table\CultivationsystemsTable
     */
    protected $Cultivationsystems;

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

        $this->Cultivationsystems = TableRegistry::getTableLocator()->get('Cultivationsystems');
    }

    public function testBeforeFilter(): void
    {
        $this->get('/cultivationsystems');
        $this->assertResponseOk();
    }

    public function testIndex(): void
    {
        $this->get('/cultivationsystems');
        $this->assertResponseOk();
    }

    public function testView(): void
    {
        $this->get('/cultivationsystems/view/1');
        $this->assertResponseOk();
    }

    public function testAdd(): void
    {
        $this->get('/cultivationsystems');
        $this->assertResponseOk();
    }

    public function testEdit(): void
    {
        $this->get('/cultivationsystems/edit/1');
        $this->assertResponseOk();
    }

    public function testDelete(): void
    {
        $this->delete('/cultivationsystems/delete/1');
        $this->assertRedirect(['controller' => 'Cultivationsystems', 'action' => 'index']);
    }

    public function testAddPostData()
    {
        $data = [
            'name' => 'Lorem ipsum dolor sit amet',
        ];
        $this->post('/cultivationsystems/add', $data);

        $this->assertResponseSuccess();
        $cultivationsystems = TableRegistry::getTableLocator()->get('Cultivationsystems');
        $query = $cultivationsystems->find()->where(['name' => $data['name']]);
        $this->assertEquals(1, $query->count());
    }

    public function testEditPostData()
    {
        $data = [
            'id' => 1,
            'name' => 'Lorem ipsum dolor sit amet',
        ];
        $this->post('/cultivationsystems/edit/1', $data);

        $this->assertResponseSuccess();
        $cultivationsystems = TableRegistry::getTableLocator()->get('Cultivationsystems');
        $query = $cultivationsystems->find()->where(['id' => $data['id']]);
        $this->assertEquals(1, $query->count());
    }
}
