<?php
declare(strict_types=1);

namespace App\Test\TestCase\Controller;

use App\Controller\ProductivePotencialsController;
use Cake\TestSuite\IntegrationTestTrait;
use Cake\TestSuite\TestCase;
use Cake\ORM\TableRegistry;

/**
 * App\Controller\ProductivePotencialsController Test Case
 *
 * @uses \App\Controller\ProductivePotencialsController
 */
class ProductivePotencialsControllerTest extends TestCase
{
    use IntegrationTestTrait;

    /**
     * @var array
     */
    protected $fixtures = [
        'app.ProductivePotencials',
        'app.Seeds',
    ];
    
    /**
     * @var \App\Model\Table\ProductivepotencialsTable
     */
    protected $Productivepotencials;

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

        $this->Productivepotencials = TableRegistry::getTableLocator()->get('Productivepotencials');
    }

    public function testBeforeFilter(): void
    {
        $this->get('/productivepotencials');
        $this->assertResponseOk();
    }

    public function testIndex(): void
    {
        $this->get('/productivepotencials');
        $this->assertResponseOk();
    }

    public function testView(): void
    {
        $this->get('/productivepotencials/view/1');
        $this->assertResponseOk();
    }

    public function testAdd(): void
    {
        $this->get('/productivepotencials');
        $this->assertResponseOk();
    }

    public function testEdit(): void
    {
        $this->get('/productivepotencials/edit/1');
        $this->assertResponseOk();
    }

    public function testDelete(): void
    {
        $this->delete('/productivepotencials/delete/1');
        $this->assertRedirect(['controller' => 'Productivepotencials', 'action' => 'index']);
    }

    public function testAddPostData()
    {
        $this->markTestIncomplete('Not implemented yet.');

        /*
        $data = [];
        $this->post('/productivepotencials/add', $data);

        $this->assertResponseSuccess();
        $productivepotencials = TableRegistry::getTableLocator()->get('Productivepotencials');
        $query = $productivepotencials->find()->where(['' => $data['']]);
        $this->assertEquals(1, $query->count());
        */
    }

    public function testEditPostData()
    {
        $this->markTestIncomplete('Not implemented yet.');

        /*
        $data = [];
        $this->post('/productivepotencials/edit/1', $data);

        $this->assertResponseSuccess();
        $productivepotencials = TableRegistry::getTableLocator()->get('Productivepotencials');
        $query = $productivepotencials->find()->where(['' => $data['']]);
        $this->assertEquals(1, $query->count());
        */
    }
}
