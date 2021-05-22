<?php
declare(strict_types=1);

namespace App\Test\TestCase\Controller;

use App\Controller\SketchesController;
use Cake\TestSuite\IntegrationTestTrait;
use Cake\TestSuite\TestCase;
use Cake\ORM\TableRegistry;

/**
 * App\Controller\SketchesController Test Case
 *
 * @uses \App\Controller\SketchesController
 */
class SketchesControllerTest extends TestCase
{
    use IntegrationTestTrait;

    /**
     * @var array
     */
    protected $fixtures = [
        'app.Sketches',
        'app.Fields',
        'app.Files',
    ];
    
    /**
     * @var \App\Model\Table\SketchesTable
     */
    protected $Sketches;

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

        $this->Sketches = TableRegistry::getTableLocator()->get('Sketches');
    }

    public function testBeforeFilter(): void
    {
        $this->get('/sketches');
        $this->assertResponseOk();
    }

    public function testIndex(): void
    {
        $this->get('/sketches');
        $this->assertResponseOk();
    }

    public function testView(): void
    {
        $this->get('/sketches/view/1');
        $this->assertResponseOk();
    }

    public function testAdd(): void
    {
        $this->get('/sketches');
        $this->assertResponseOk();
    }

    public function testEdit(): void
    {
        $this->get('/sketches/edit/1');
        $this->assertResponseOk();
    }

    public function testDelete(): void
    {
        $this->delete('/sketches/delete/1');
        $this->assertRedirect(['controller' => 'Sketches', 'action' => 'index']);
    }

    public function testAddPostData()
    {
        $this->markTestIncomplete('Not implemented yet.');

        /*
        $data = [];
        $this->post('/sketches/add', $data);

        $this->assertResponseSuccess();
        $sketches = TableRegistry::getTableLocator()->get('Sketches');
        $query = $sketches->find()->where(['' => $data['']]);
        $this->assertEquals(1, $query->count());
        */
    }

    public function testEditPostData()
    {
        $this->markTestIncomplete('Not implemented yet.');

        /*
        $data = [];
        $this->post('/sketches/edit/1', $data);

        $this->assertResponseSuccess();
        $sketches = TableRegistry::getTableLocator()->get('Sketches');
        $query = $sketches->find()->where(['' => $data['']]);
        $this->assertEquals(1, $query->count());
        */
    }
}
