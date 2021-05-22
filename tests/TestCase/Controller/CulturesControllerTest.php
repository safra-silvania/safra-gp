<?php
declare(strict_types=1);

namespace App\Test\TestCase\Controller;

use App\Controller\CulturesController;
use Cake\TestSuite\IntegrationTestTrait;
use Cake\TestSuite\TestCase;
use Cake\ORM\TableRegistry;

/**
 * App\Controller\CulturesController Test Case
 *
 * @uses \App\Controller\CulturesController
 */
class CulturesControllerTest extends TestCase
{
    use IntegrationTestTrait;

    /**
     * @var array
     */
    protected $fixtures = [
        'app.Cultures',
        'app.FieldDetails',
        'app.Seeds',
    ];
    
    /**
     * @var \App\Model\Table\CulturesTable
     */
    protected $Cultures;

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

        $this->Cultures = TableRegistry::getTableLocator()->get('Cultures');
    }

    public function testBeforeFilter(): void
    {
        $this->get('/cultures');
        $this->assertResponseOk();
    }

    public function testIndex(): void
    {
        $this->get('/cultures');
        $this->assertResponseOk();
    }

    public function testView(): void
    {
        $this->get('/cultures/view/1');
        $this->assertResponseOk();
    }

    public function testAdd(): void
    {
        $this->get('/cultures');
        $this->assertResponseOk();
    }

    public function testEdit(): void
    {
        $this->get('/cultures/edit/1');
        $this->assertResponseOk();
    }

    public function testDelete(): void
    {
        $this->delete('/cultures/delete/1');
        $this->assertRedirect(['controller' => 'Cultures', 'action' => 'index']);
    }

    public function testAddPostData()
    {
        $data = [
            'name' => 'Lorem ipsum dolor sit amet',
        ];
        $this->post('/cultures/add', $data);

        $this->assertResponseSuccess();
        $cultures = TableRegistry::getTableLocator()->get('Cultures');
        $query = $cultures->find()->where(['name' => $data['name']]);
        $this->assertEquals(1, $query->count());
    }

    public function testEditPostData()
    {
        $data = [
            'id' => 1,
            'name' => 'Lorem ipsum dolor sit amet',
        ];
        $this->post('/cultures/edit/1', $data);

        $this->assertResponseSuccess();
        $cultures = TableRegistry::getTableLocator()->get('Cultures');
        $query = $cultures->find()->where(['id' => $data['id']]);
        $this->assertEquals(1, $query->count());
    }
}
