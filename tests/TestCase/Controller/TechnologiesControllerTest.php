<?php
declare(strict_types=1);

namespace App\Test\TestCase\Controller;

use App\Controller\TechnologiesController;
use Cake\TestSuite\IntegrationTestTrait;
use Cake\TestSuite\TestCase;
use Cake\ORM\TableRegistry;

/**
 * App\Controller\TechnologiesController Test Case
 *
 * @uses \App\Controller\TechnologiesController
 */
class TechnologiesControllerTest extends TestCase
{
    use IntegrationTestTrait;

    /**
     * @var array
     */
    protected $fixtures = [
        'app.Technologies',
        'app.Seeds',
    ];
    
    /**
     * @var \App\Model\Table\TechnologiesTable
     */
    protected $Technologies;

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

        $this->Technologies = TableRegistry::getTableLocator()->get('Technologies');
    }

    public function testBeforeFilter(): void
    {
        $this->get('/technologies');
        $this->assertResponseOk();
    }

    public function testIndex(): void
    {
        $this->get('/technologies');
        $this->assertResponseOk();
    }

    public function testView(): void
    {
        $this->get('/technologies/view/1');
        $this->assertResponseOk();
    }

    public function testAdd(): void
    {
        $this->get('/technologies');
        $this->assertResponseOk();
    }

    public function testEdit(): void
    {
        $this->get('/technologies/edit/1');
        $this->assertResponseOk();
    }

    public function testDelete(): void
    {
        $this->delete('/technologies/delete/1');
        $this->assertRedirect(['controller' => 'Technologies', 'action' => 'index']);
    }

    public function testAddPostData()
    {
        $data = ['name' => 'Lorem ipsum dolor sit amet'];
        $this->post('/technologies/add', $data);

        $this->assertResponseSuccess();
        $technologies = TableRegistry::getTableLocator()->get('Technologies');
        $query = $technologies->find()->where(['name' => $data['name']]);
        $this->assertEquals(1, $query->count());
    }

    public function testEditPostData()
    {
        $data = ['id' => 1, 'name' => 'Lorem ipsum dolor sit amet'];
        $this->post('/technologies/edit/1', $data);

        $this->assertResponseSuccess();
        $technologies = TableRegistry::getTableLocator()->get('Technologies');
        $query = $technologies->find()->where(['id' => $data['id']]);
        $this->assertEquals(1, $query->count());
    }
}
