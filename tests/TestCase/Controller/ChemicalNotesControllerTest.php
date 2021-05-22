<?php
declare(strict_types=1);

namespace App\Test\TestCase\Controller;

use App\Controller\ChemicalNotesController;
use Cake\TestSuite\IntegrationTestTrait;
use Cake\TestSuite\TestCase;
use Cake\ORM\TableRegistry;

/**
 * App\Controller\ChemicalNotesController Test Case
 *
 * @uses \App\Controller\ChemicalNotesController
 */
class ChemicalNotesControllerTest extends TestCase
{
    use IntegrationTestTrait;

    /**
     * @var array
     */
    protected $fixtures = [
        'app.ChemicalNotes',
        'app.Chemicals',
    ];
    
    /**
     * @var \App\Model\Table\ChemicalnotesTable
     */
    protected $Chemicalnotes;

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

        $this->Chemicalnotes = TableRegistry::getTableLocator()->get('Chemicalnotes');
    }

    public function testBeforeFilter(): void
    {
        $this->get('/chemicalnotes');
        $this->assertResponseOk();
    }

    public function testIndex(): void
    {
        $this->get('/chemicalnotes');
        $this->assertResponseOk();
    }

    public function testView(): void
    {
        $this->get('/chemicalnotes/view/1');
        $this->assertResponseOk();
    }

    public function testAdd(): void
    {
        $this->get('/chemicalnotes');
        $this->assertResponseOk();
    }

    public function testEdit(): void
    {
        $this->get('/chemicalnotes/edit/1');
        $this->assertResponseOk();
    }

    public function testDelete(): void
    {
        $this->delete('/chemicalnotes/delete/1');
        $this->assertRedirect(['controller' => 'Chemicalnotes', 'action' => 'index']);
    }

    public function testAddPostData()
    {
        $this->markTestIncomplete('Not implemented yet.');

        /*
        $data = [];
        $this->post('/chemicalnotes/add', $data);

        $this->assertResponseSuccess();
        $chemicalnotes = TableRegistry::getTableLocator()->get('Chemicalnotes');
        $query = $chemicalnotes->find()->where(['' => $data['']]);
        $this->assertEquals(1, $query->count());
        */
    }

    public function testEditPostData()
    {
        $this->markTestIncomplete('Not implemented yet.');

        /*
        $data = [];
        $this->post('/chemicalnotes/edit/1', $data);

        $this->assertResponseSuccess();
        $chemicalnotes = TableRegistry::getTableLocator()->get('Chemicalnotes');
        $query = $chemicalnotes->find()->where(['' => $data['']]);
        $this->assertEquals(1, $query->count());
        */
    }
}
