<?php
declare(strict_types=1);

namespace App\Test\TestCase\Controller;

use App\Controller\SuppliersController;
use Cake\TestSuite\IntegrationTestTrait;
use Cake\TestSuite\TestCase;
use Cake\ORM\TableRegistry;

/**
 * App\Controller\SuppliersController Test Case
 *
 * @uses \App\Controller\SuppliersController
 */
class SuppliersControllerTest extends TestCase
{
    use IntegrationTestTrait;

    /**
     * @var array
     */
    protected $fixtures = [
        'app.Suppliers',
        'app.Cities',
        'app.Chemicals',
        'app.Fertilities',
        'app.Fertilizers',
        'app.Seeds',
        'app.SupplierTypes',
        'app.SuppliersSupplierTypes',
    ];
    
    /**
     * @var \App\Model\Table\SuppliersTable
     */
    protected $Suppliers;

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

        $this->Suppliers = TableRegistry::getTableLocator()->get('Suppliers');
    }

    public function testBeforeFilter(): void
    {
        $this->get('/suppliers');
        $this->assertResponseOk();
    }

    public function testIndex(): void
    {
        $this->get('/suppliers');
        $this->assertResponseOk();
    }

    public function testView(): void
    {
        $this->get('/suppliers/view/1');
        $this->assertResponseOk();
    }

    public function testAdd(): void
    {
        $this->get('/suppliers');
        $this->assertResponseOk();
    }

    public function testEdit(): void
    {
        $this->get('/suppliers/edit/1');
        $this->assertResponseOk();
    }

    public function testDelete(): void
    {
        $this->delete('/suppliers/delete/1');
        $this->assertRedirect(['controller' => 'Suppliers', 'action' => 'index']);
    }

    public function testAddPostData()
    {
        $this->markTestIncomplete('Not implemented yet.');

        /*
        $data = [];
        $this->post('/suppliers/add', $data);

        $this->assertResponseSuccess();
        $suppliers = TableRegistry::getTableLocator()->get('Suppliers');
        $query = $suppliers->find()->where(['' => $data['']]);
        $this->assertEquals(1, $query->count());
        */
    }

    public function testEditPostData()
    {
        $this->markTestIncomplete('Not implemented yet.');

        /*
        $data = [];
        $this->post('/suppliers/edit/1', $data);

        $this->assertResponseSuccess();
        $suppliers = TableRegistry::getTableLocator()->get('Suppliers');
        $query = $suppliers->find()->where(['' => $data['']]);
        $this->assertEquals(1, $query->count());
        */
    }
}
