<?php
declare(strict_types=1);

namespace App\Test\TestCase\Controller;

use App\Controller\FertilizersController;
use Cake\TestSuite\IntegrationTestTrait;
use Cake\TestSuite\TestCase;
use Cake\ORM\TableRegistry;

/**
 * App\Controller\FertilizersController Test Case
 *
 * @uses \App\Controller\FertilizersController
 */
class FertilizersControllerTest extends TestCase
{
    use IntegrationTestTrait;

    /**
     * @var array
     */
    protected $fixtures = [
        'app.Fertilizers',
        'app.Suppliers',
        'app.FertilizerMeasureUnits',
    ];
    
    /**
     * @var \App\Model\Table\FertilizersTable
     */
    protected $Fertilizers;

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

        $this->Fertilizers = TableRegistry::getTableLocator()->get('Fertilizers');
    }

    public function testBeforeFilter(): void
    {
        $this->get('/fertilizers');
        $this->assertResponseOk();
    }

    public function testIndex(): void
    {
        $this->get('/fertilizers');
        $this->assertResponseOk();
    }

    public function testView(): void
    {
        $this->get('/fertilizers/view/1');
        $this->assertResponseOk();
    }

    public function testAdd(): void
    {
        $this->get('/fertilizers');
        $this->assertResponseOk();
    }

    public function testEdit(): void
    {
        $this->get('/fertilizers/edit/1');
        $this->assertResponseOk();
    }

    public function testDelete(): void
    {
        $this->delete('/fertilizers/delete/1');
        $this->assertRedirect(['controller' => 'Fertilizers', 'action' => 'index']);
    }

    public function testAddPostData()
    {
        $this->markTestIncomplete('Not implemented yet.');

        /*
        $data = [];
        $this->post('/fertilizers/add', $data);

        $this->assertResponseSuccess();
        $fertilizers = TableRegistry::getTableLocator()->get('Fertilizers');
        $query = $fertilizers->find()->where(['' => $data['']]);
        $this->assertEquals(1, $query->count());
        */
    }

    public function testEditPostData()
    {
        $this->markTestIncomplete('Not implemented yet.');

        /*
        $data = [];
        $this->post('/fertilizers/edit/1', $data);

        $this->assertResponseSuccess();
        $fertilizers = TableRegistry::getTableLocator()->get('Fertilizers');
        $query = $fertilizers->find()->where(['' => $data['']]);
        $this->assertEquals(1, $query->count());
        */
    }
}
