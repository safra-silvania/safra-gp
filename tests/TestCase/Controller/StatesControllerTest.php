<?php
declare(strict_types=1);

namespace App\Test\TestCase\Controller;

use App\Controller\StatesController;
use Cake\TestSuite\IntegrationTestTrait;
use Cake\TestSuite\TestCase;
use Cake\ORM\TableRegistry;

/**
 * App\Controller\StatesController Test Case
 *
 * @uses \App\Controller\StatesController
 */
class StatesControllerTest extends TestCase
{
    use IntegrationTestTrait;

    /**
     * @var array
     */
    protected $fixtures = [
        'app.States',
        'app.Cities',
    ];
    
    /**
     * @var \App\Model\Table\StatesTable
     */
    protected $States;

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

        $this->States = TableRegistry::getTableLocator()->get('States');
    }

    public function testBeforeFilter(): void
    {
        $this->get('/states');
        $this->assertResponseSuccess();
    }

    public function testIndex(): void
    {
        $this->get('/states');
        $this->assertResponseSuccess();
    }

    public function testView(): void
    {
        $this->get('/states/view/1');
        $this->assertResponseSuccess();
    }

    public function testAdd(): void
    {
        $this->get('/states');
        $this->assertResponseSuccess();
    }

    public function testEdit(): void
    {
        $this->get('/states/edit/1');
        $this->assertResponseSuccess();
    }

    public function testDelete(): void
    {
        $this->delete('/states/delete/1');
        $this->assertRedirect(['controller' => 'States', 'action' => 'index']);
    }

    public function testAddPostData()
    {
        $data = [
            'name' => 'Lorem ipsum dolor sit amet',
            'initial' => 'Lo',
        ];
        $this->post('/states/add', $data);

        $this->assertResponseSuccess();
        $states = TableRegistry::getTableLocator()->get('States');
        $query = $states->find()->where(['name' => $data['name']]);
        $this->assertEquals(1, $query->count());
    }

    public function testEditPostData()
    {
        $data = [
            'id' => 1,
            'name' => 'Lorem ipsum dolor sit amet',
            'initial' => 'Lo',
        ];
        $this->post('/states/edit/1', $data);

        $this->assertResponseSuccess();
        $states = TableRegistry::getTableLocator()->get('States');
        $query = $states->find()->where(['id' => $data['id']]);
        $this->assertEquals(1, $query->count());
    }
}
