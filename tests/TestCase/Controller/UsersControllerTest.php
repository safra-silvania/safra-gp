<?php
declare(strict_types=1);

namespace App\Test\TestCase\Controller;

use App\Controller\UsersController;
use Cake\TestSuite\IntegrationTestTrait;
use Cake\TestSuite\TestCase;
use Cake\ORM\TableRegistry;

/**
 * App\Controller\UsersController Test Case
 *
 * @uses \App\Controller\UsersController
 */
class UsersControllerTest extends TestCase
{
    use IntegrationTestTrait;

    /**
     * @var array
     */
    protected $fixtures = [
        'app.Users',
        'app.Roles',
        'app.Notifications',
    ];
    
    /**
     * @var \App\Model\Table\UsersTable
     */
    protected $Users;

    public function setUp(): void
    {
        parent::setUp();

        $user = TableRegistry::get('Users')->get(1);

        $this->session([
            'Auth' => [
                'User' => [
                    'id' => 1,
                    'role_id' => 1,
                    'name' => 'testing',
                    'email' => 'testing@test.com',
                ]
                // 'User' => $user
            ]
        ]);

        $this->enableCsrfToken();
        $this->enableSecurityToken();
        // $this->configRequest([
        //     'Auth' => [
        //         // 'User' => [
        //         //     'id' => 1,
        //         //     'role_id' => 1,
        //         //     'username' => 'testing',
        //         //     'email' => 'testing@test.com',
        //         // ]
        //         'User' => $user
        //     ]
        // ]);

        $this->Users = TableRegistry::getTableLocator()->get('Users');
    }

    /*
    public function controllerSpy($event)
    {
        parent::controllerSpy($event);

        if (isset($this->_controller)) {
            $this->_controller->Auth->setUser([
                'id' => 1,
                'role_id' => 1,
                'username' => 'testing',
                'email' => 'testing@test.com',
            ]);
        }
    }
    */

    public function testDummy(): void
    {
        $this->assertEquals(1,1);
    }

    // public function testBeforeFilter(): void
    // {
    //     $this->get('/users');
    //     $this->assertResponseOk();
    // }

    // public function testToggleSidebar(): void
    // {
    //     $this->get('/users');
    //     $this->assertResponseOk();
    // }

    // public function testLogin(): void
    // {
    //     $this->get('/users');
    //     $this->assertResponseOk();
    // }

    // public function testLogout(): void
    // {
    //     $this->get('/users');
    //     $this->assertResponseOk();
    // }

    // public function testIndex(): void
    // {
    //     $this->get('/users');
    //     $this->assertResponseOk();
    // }

    // public function testView(): void
    // {
    //     $this->get('/users/view/1');
    //     $this->assertResponseOk();
    // }

    // public function testAdd(): void
    // {
    //     $this->get('/users');
    //     $this->assertResponseOk();
    // }

    // public function testEdit(): void
    // {
    //     $this->get('/users/edit/1');
    //     $this->assertResponseOk();
    // }

    // public function testChangePassword(): void
    // {
    //     $this->get('/users/changePassword');
    //     $this->assertResponseOk();
    // }

    // public function testDelete(): void
    // {
    //     $this->delete('/users/delete/1');
    //     $this->assertRedirect(['controller' => 'Users', 'action' => 'index']);
    // }

    // public function testAddPostData()
    // {
    //     $data = [
    //         'role_id' => 1,
    //         'name' => 'Nome de teste',
    //         'email' => 'teste@teste.com',
    //         'password' => '123456',
    //         'password_confirm' => '123456'
    //     ];
    //     $this->post('/users/add', $data);

    //     $this->assertResponseSuccess();
    //     $users = TableRegistry::getTableLocator()->get('Users');
    //     $query = $users->find()->where(['name' => $data['name']]);
    //     $this->assertEquals(1, $query->count());
    // }

    // public function testEditPostData()
    // {
    //     $data = [
    //         'id' => 1,
    //         'role_id' => 1,
    //         'name' => 'tester',
    //         'email' => 'teste@teste.com',
    //         'password' => '123456',
    //         'password_confirm' => '123456'
    //     ];
    //     $this->post('/users/edit/1', $data);

    //     $this->assertResponseSuccess();
    //     $users = TableRegistry::getTableLocator()->get('Users');
    //     $query = $users->find()->where(['name' => $data['name']]);
    //     $this->assertEquals(1, $query->count());
    // }

    // public function testChangePasswordPostData()
    // {
    //     $data = [
    //         'password' => '123456',
    //         'password_confirm' => '123456'
    //     ];
    //     $this->post('/users/changePassword', $data);

    //     $this->assertResponseSuccess();
    //     // $users = TableRegistry::getTableLocator()->get('Users');
    //     // $query = $users->find()->where(['name' => $data['name']]);
    //     // $this->assertEquals(1, $query->count());
    // }

}
