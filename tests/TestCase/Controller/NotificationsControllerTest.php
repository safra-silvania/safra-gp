<?php
declare(strict_types=1);

namespace App\Test\TestCase\Controller;

use App\Controller\NotificationsController;
use Cake\TestSuite\IntegrationTestTrait;
use Cake\TestSuite\TestCase;
use Cake\ORM\TableRegistry;

/**
 * App\Controller\NotificationsController Test Case
 *
 * @uses \App\Controller\NotificationsController
 */
class NotificationsControllerTest extends TestCase
{
    use IntegrationTestTrait;

    /**
     * @var array
     */
    protected $fixtures = [
        'app.Notifications',
        'app.Users',
    ];
    
    /**
     * @var \App\Model\Table\NotificationsTable
     */
    protected $Notifications;

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

        $this->Notifications = TableRegistry::getTableLocator()->get('Notifications');
    }

    public function testBeforeFilter(): void
    {
        $this->get('/notifications');
        $this->assertResponseOk();
    }

    public function testIndex(): void
    {
        $this->get('/notifications');
        $this->assertResponseOk();
    }

    public function testView(): void
    {
        $this->get('/notifications/view/1');
        $this->assertResponseOk();
    }

    public function testAdd(): void
    {
        $this->get('/notifications');
        $this->assertResponseOk();
    }

    public function testEdit(): void
    {
        $this->get('/notifications/edit/1');
        $this->assertResponseOk();
    }

    public function testDelete(): void
    {
        $this->delete('/notifications/delete/1');
        $this->assertRedirect(['controller' => 'Notifications', 'action' => 'index']);
    }

    public function testAddPostData()
    {
        $this->markTestIncomplete('Not implemented yet.');

        /*
        $data = [];
        $this->post('/notifications/add', $data);

        $this->assertResponseSuccess();
        $notifications = TableRegistry::getTableLocator()->get('Notifications');
        $query = $notifications->find()->where(['' => $data['']]);
        $this->assertEquals(1, $query->count());
        */
    }

    public function testEditPostData()
    {
        $this->markTestIncomplete('Not implemented yet.');

        /*
        $data = [];
        $this->post('/notifications/edit/1', $data);

        $this->assertResponseSuccess();
        $notifications = TableRegistry::getTableLocator()->get('Notifications');
        $query = $notifications->find()->where(['' => $data['']]);
        $this->assertEquals(1, $query->count());
        */
    }
}
