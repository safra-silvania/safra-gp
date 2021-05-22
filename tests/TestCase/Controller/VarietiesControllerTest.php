<?php
declare(strict_types=1);

namespace App\Test\TestCase\Controller;

use App\Controller\VarietiesController;
use Cake\TestSuite\IntegrationTestTrait;
use Cake\TestSuite\TestCase;
use Cake\ORM\TableRegistry;

/**
 * App\Controller\VarietiesController Test Case
 *
 * @uses \App\Controller\VarietiesController
 */
class VarietiesControllerTest extends TestCase
{
    use IntegrationTestTrait;

    /**
     * @var array
     */
    protected $fixtures = [
        'app.Varieties',
        'app.Seeds',
    ];
    
    /**
     * @var \App\Model\Table\VarietiesTable
     */
    protected $Varieties;

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

        $this->Varieties = TableRegistry::getTableLocator()->get('Varieties');
    }

    public function testBeforeFilter(): void
    {
        $this->get('/varieties');
        $this->assertResponseOk();
    }

    public function testIndex(): void
    {
        $this->get('/varieties');
        $this->assertResponseOk();
    }

    public function testView(): void
    {
        $this->get('/varieties/view/1');
        $this->assertResponseOk();
    }

    public function testAdd(): void
    {
        $this->get('/varieties');
        $this->assertResponseOk();
    }

    public function testEdit(): void
    {
        $this->get('/varieties/edit/1');
        $this->assertResponseOk();
    }

    public function testDelete(): void
    {
        $this->delete('/varieties/delete/1');
        $this->assertRedirect(['controller' => 'Varieties', 'action' => 'index']);
    }

    public function testAddPostData()
    {
        $data = ['name' => 'Lorem ipsum dolor sit amet'];
        $this->post('/varieties/add', $data);

        $this->assertResponseSuccess();
        $varieties = TableRegistry::getTableLocator()->get('Varieties');
        $query = $varieties->find()->where(['name' => $data['name']]);
        $this->assertEquals(1, $query->count());
    }

    public function testEditPostData()
    {
        $data = ['id' => 1, 'name' => 'Lorem ipsum dolor sit amet'];
        $this->post('/varieties/edit/1', $data);

        $this->assertResponseSuccess();
        $varieties = TableRegistry::getTableLocator()->get('Varieties');
        $query = $varieties->find()->where(['id' => $data['id']]);
        $this->assertEquals(1, $query->count());
    }
}
