<?php
declare(strict_types=1);

namespace App\Test\TestCase\Controller;

use App\Controller\RolesController;
use Cake\TestSuite\IntegrationTestTrait;
use Cake\TestSuite\TestCase;
use Cake\ORM\TableRegistry;

/**
 * App\Controller\RolesController Test Case
 *
 * @uses \App\Controller\RolesController
 */
class RolesControllerTest extends TestCase
{
    use IntegrationTestTrait;

    /**
     * @var array
     */
    protected $fixtures = [
        'app.Roles',
        'app.Users',
    ];
    
    /**
     * @var \App\Model\Table\RolesTable
     */
    protected $Roles;

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

        $this->Roles = TableRegistry::getTableLocator()->get('Roles');
    }

    public function testBeforeFilter(): void
    {
        $this->get('/roles');
        $this->assertResponseOk();
    }

    public function testIndex(): void
    {
        $this->get('/roles');
        $this->assertResponseOk();
    }

    public function testView(): void
    {
        $this->get('/roles/view/1');
        $this->assertResponseSuccess();
    }

    public function testAdd(): void
    {
        $this->get('/roles');
        $this->assertResponseSuccess();
    }

    public function testEdit(): void
    {
        $this->get('/roles/edit/1');
        $this->assertResponseSuccess();
    }

    public function testDelete(): void
    {
        $this->delete('/roles/delete/1');
        $this->assertRedirect(['controller' => 'Roles', 'action' => 'index']);
    }

    public function testAddPostData()
    {
        $data = [
            'name' => 'Lorem ipsum dolor sit amet',
        ];
        $this->post('/roles/add', $data);

        $this->assertResponseSuccess();
        $roles = TableRegistry::getTableLocator()->get('Roles');
        $query = $roles->find()->where(['name' => $data['name']]);
        $this->assertEquals(1, $query->count());
    }

    public function testEditPostData()
    {
        $data = [
            'id' => 1,
            'name' => 'Lorem ipsum dolor sit amet',
        ];
        $this->post('/roles/edit/1', $data);

        $this->assertResponseSuccess();
        $roles = TableRegistry::getTableLocator()->get('Roles');
        $query = $roles->find()->where(['id' => $data['id']]);
        $this->assertEquals(1, $query->count());
    }
}
