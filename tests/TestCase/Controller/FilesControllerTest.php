<?php
declare(strict_types=1);

namespace App\Test\TestCase\Controller;

use App\Controller\FilesController;
use Cake\TestSuite\IntegrationTestTrait;
use Cake\TestSuite\TestCase;
use Cake\ORM\TableRegistry;

/**
 * App\Controller\FilesController Test Case
 *
 * @uses \App\Controller\FilesController
 */
class FilesControllerTest extends TestCase
{
    use IntegrationTestTrait;

    /**
     * @var array
     */
    protected $fixtures = [
        'app.Files',
        'app.Sketches',
    ];
    
    /**
     * @var \App\Model\Table\FilesTable
     */
    protected $Files;

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

        $this->Files = TableRegistry::getTableLocator()->get('Files');
    }

    public function testBeforeFilter(): void
    {
        $this->get('/files');
        $this->assertResponseOk();
    }

    public function testIndex(): void
    {
        $this->get('/files');
        $this->assertResponseOk();
    }

    public function testView(): void
    {
        $this->get('/files/view/1');
        $this->assertResponseOk();
    }

    public function testAdd(): void
    {
        $this->get('/files');
        $this->assertResponseOk();
    }

    public function testEdit(): void
    {
        $this->get('/files/edit/1');
        $this->assertResponseOk();
    }

    public function testDelete(): void
    {
        $this->delete('/files/delete/1');
        $this->assertRedirect(['controller' => 'Files', 'action' => 'index']);
    }

    public function testAddPostData()
    {
        $this->markTestIncomplete('Not implemented yet.');

        /*
        $data = [];
        $this->post('/files/add', $data);

        $this->assertResponseSuccess();
        $files = TableRegistry::getTableLocator()->get('Files');
        $query = $files->find()->where(['' => $data['']]);
        $this->assertEquals(1, $query->count());
        */
    }

    public function testEditPostData()
    {
        $this->markTestIncomplete('Not implemented yet.');

        /*
        $data = [];
        $this->post('/files/edit/1', $data);

        $this->assertResponseSuccess();
        $files = TableRegistry::getTableLocator()->get('Files');
        $query = $files->find()->where(['' => $data['']]);
        $this->assertEquals(1, $query->count());
        */
    }
}
