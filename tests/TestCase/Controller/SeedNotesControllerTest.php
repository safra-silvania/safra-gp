<?php
declare(strict_types=1);

namespace App\Test\TestCase\Controller;

use App\Controller\SeedNotesController;
use Cake\TestSuite\IntegrationTestTrait;
use Cake\TestSuite\TestCase;
use Cake\ORM\TableRegistry;

/**
 * App\Controller\SeedNotesController Test Case
 *
 * @uses \App\Controller\SeedNotesController
 */
class SeedNotesControllerTest extends TestCase
{
    use IntegrationTestTrait;

    /**
     * @var array
     */
    protected $fixtures = [
        'app.SeedNotes',
        'app.Seeds',
    ];
    
    /**
     * @var \App\Model\Table\SeednotesTable
     */
    protected $Seednotes;

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

        $this->Seednotes = TableRegistry::getTableLocator()->get('Seednotes');
    }

    public function testBeforeFilter(): void
    {
        $this->get('/seednotes');
        $this->assertResponseOk();
    }

    public function testIndex(): void
    {
        $this->get('/seednotes');
        $this->assertResponseOk();
    }

    public function testView(): void
    {
        $this->get('/seednotes/view/1');
        $this->assertResponseOk();
    }

    public function testAdd(): void
    {
        $this->get('/seednotes');
        $this->assertResponseOk();
    }

    public function testEdit(): void
    {
        $this->get('/seednotes/edit/1');
        $this->assertResponseOk();
    }

    public function testDelete(): void
    {
        $this->delete('/seednotes/delete/1');
        $this->assertRedirect(['controller' => 'Seednotes', 'action' => 'index']);
    }

    public function testAddPostData()
    {
        $this->markTestIncomplete('Not implemented yet.');

        /*
        $data = [];
        $this->post('/seednotes/add', $data);

        $this->assertResponseSuccess();
        $seednotes = TableRegistry::getTableLocator()->get('Seednotes');
        $query = $seednotes->find()->where(['' => $data['']]);
        $this->assertEquals(1, $query->count());
        */
    }

    public function testEditPostData()
    {
        $this->markTestIncomplete('Not implemented yet.');

        /*
        $data = [];
        $this->post('/seednotes/edit/1', $data);

        $this->assertResponseSuccess();
        $seednotes = TableRegistry::getTableLocator()->get('Seednotes');
        $query = $seednotes->find()->where(['' => $data['']]);
        $this->assertEquals(1, $query->count());
        */
    }
}
