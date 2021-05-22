<?php
declare(strict_types=1);

namespace App\Test\TestCase\Controller;

use App\Controller\ChemicalTargetsController;
use Cake\TestSuite\IntegrationTestTrait;
use Cake\TestSuite\TestCase;
use Cake\ORM\TableRegistry;

/**
 * App\Controller\ChemicalTargetsController Test Case
 *
 * @uses \App\Controller\ChemicalTargetsController
 */
class ChemicalTargetsControllerTest extends TestCase
{
    use IntegrationTestTrait;

    /**
     * @var array
     */
    protected $fixtures = [
        'app.ChemicalTargets',
        'app.Chemicals',
    ];
    
    /**
     * @var \App\Model\Table\ChemicaltargetsTable
     */
    protected $Chemicaltargets;

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

        $this->Chemicaltargets = TableRegistry::getTableLocator()->get('Chemicaltargets');
    }

    public function testBeforeFilter(): void
    {
        $this->get('/chemicaltargets');
        $this->assertResponseOk();
    }

    public function testIndex(): void
    {
        $this->get('/chemicaltargets');
        $this->assertResponseOk();
    }

    public function testView(): void
    {
        $this->get('/chemicaltargets/view/1');
        $this->assertResponseOk();
    }

    public function testAdd(): void
    {
        $this->get('/chemicaltargets');
        $this->assertResponseOk();
    }

    public function testEdit(): void
    {
        $this->get('/chemicaltargets/edit/1');
        $this->assertResponseOk();
    }

    public function testDelete(): void
    {
        $this->delete('/chemicaltargets/delete/1');
        $this->assertRedirect(['controller' => 'Chemicaltargets', 'action' => 'index']);
    }

    public function testAddPostData()
    {
        $this->markTestIncomplete('Not implemented yet.');

        /*
        $data = [];
        $this->post('/chemicaltargets/add', $data);

        $this->assertResponseSuccess();
        $chemicaltargets = TableRegistry::getTableLocator()->get('Chemicaltargets');
        $query = $chemicaltargets->find()->where(['' => $data['']]);
        $this->assertEquals(1, $query->count());
        */
    }

    public function testEditPostData()
    {
        $this->markTestIncomplete('Not implemented yet.');

        /*
        $data = [];
        $this->post('/chemicaltargets/edit/1', $data);

        $this->assertResponseSuccess();
        $chemicaltargets = TableRegistry::getTableLocator()->get('Chemicaltargets');
        $query = $chemicaltargets->find()->where(['' => $data['']]);
        $this->assertEquals(1, $query->count());
        */
    }
}
