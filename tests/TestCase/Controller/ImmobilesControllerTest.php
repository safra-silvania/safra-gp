<?php
declare(strict_types=1);

namespace App\Test\TestCase\Controller;

use App\Controller\ImmobilesController;
use Cake\TestSuite\IntegrationTestTrait;
use Cake\TestSuite\TestCase;
use Cake\ORM\TableRegistry;

/**
 * App\Controller\ImmobilesController Test Case
 *
 * @uses \App\Controller\ImmobilesController
 */
class ImmobilesControllerTest extends TestCase
{
    use IntegrationTestTrait;

    /**
     * @var array
     */
    protected $fixtures = [
        'app.Immobiles',
        'app.Producers',
        'app.Cities',
        'app.Fields',
        'app.Plans',
    ];
    
    /**
     * @var \App\Model\Table\ImmobilesTable
     */
    protected $Immobiles;

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

        $this->Immobiles = TableRegistry::getTableLocator()->get('Immobiles');
    }

    public function testBeforeFilter(): void
    {
        $this->get('/immobiles');
        $this->assertResponseOk();
    }

    public function testIndex(): void
    {
        $this->get('/immobiles');
        $this->assertResponseOk();
    }

    public function testView(): void
    {
        $this->get('/immobiles/view/1');
        $this->assertResponseOk();
    }

    public function testAdd(): void
    {
        $this->get('/immobiles');
        $this->assertResponseOk();
    }

    public function testEdit(): void
    {
        $this->get('/immobiles/edit/1');
        $this->assertResponseOk();
    }

    public function testDelete(): void
    {
        $this->delete('/immobiles/delete/1');
        $this->assertRedirect(['controller' => 'Immobiles', 'action' => 'index']);
    }

    public function testAddPostData()
    {
        $this->markTestIncomplete('Not implemented yet.');

        /*
        $data = [];
        $this->post('/immobiles/add', $data);

        $this->assertResponseSuccess();
        $immobiles = TableRegistry::getTableLocator()->get('Immobiles');
        $query = $immobiles->find()->where(['' => $data['']]);
        $this->assertEquals(1, $query->count());
        */
    }

    public function testEditPostData()
    {
        $this->markTestIncomplete('Not implemented yet.');

        /*
        $data = [];
        $this->post('/immobiles/edit/1', $data);

        $this->assertResponseSuccess();
        $immobiles = TableRegistry::getTableLocator()->get('Immobiles');
        $query = $immobiles->find()->where(['' => $data['']]);
        $this->assertEquals(1, $query->count());
        */
    }
}
