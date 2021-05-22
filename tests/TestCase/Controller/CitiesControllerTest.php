<?php
declare(strict_types=1);

namespace App\Test\TestCase\Controller;

use App\Controller\CitiesController;
use Cake\TestSuite\IntegrationTestTrait;
use Cake\TestSuite\TestCase;
use Cake\ORM\TableRegistry;

/**
 * App\Controller\CitiesController Test Case
 *
 * @uses \App\Controller\CitiesController
 */
class CitiesControllerTest extends TestCase
{
    use IntegrationTestTrait;

    /**
     * @var array
     */
    protected $fixtures = [
        'app.Cities',
        'app.States',
        'app.Fields',
        'app.Immobiles',
        'app.Producers',
        'app.Seeds',
        'app.Suppliers',
    ];
    
    /**
     * @var \App\Model\Table\CitiesTable
     */
    protected $Cities;

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

        $this->Cities = TableRegistry::getTableLocator()->get('Cities');
    }

    public function testBeforeFilter(): void
    {
        $this->get('/cities');
        $this->assertResponseOk();
    }

    public function testIndex(): void
    {
        $this->get('/cities');
        $this->assertResponseOk();
    }

    public function testView(): void
    {
        $this->get('/cities/view/1');
        $this->assertResponseOk();
    }

    public function testAdd(): void
    {
        $this->get('/cities');
        $this->assertResponseOk();
    }

    public function testEdit(): void
    {
        $this->get('/cities/edit/1');
        $this->assertResponseOk();
    }

    public function testDelete(): void
    {
        $this->delete('/cities/delete/1');
        $this->assertRedirect(['controller' => 'Cities', 'action' => 'index']);
    }

    public function testAddPostData()
    {
        $this->markTestIncomplete('Not implemented yet.');

        /*
        $data = [];
        $this->post('/cities/add', $data);

        $this->assertResponseSuccess();
        $cities = TableRegistry::getTableLocator()->get('Cities');
        $query = $cities->find()->where(['' => $data['']]);
        $this->assertEquals(1, $query->count());
        */
    }

    public function testEditPostData()
    {
        $this->markTestIncomplete('Not implemented yet.');

        /*
        $data = [];
        $this->post('/cities/edit/1', $data);

        $this->assertResponseSuccess();
        $cities = TableRegistry::getTableLocator()->get('Cities');
        $query = $cities->find()->where(['' => $data['']]);
        $this->assertEquals(1, $query->count());
        */
    }
}
