<?php
declare(strict_types=1);

namespace App\Test\TestCase\Controller;

use App\Controller\SelectedChemicalsController;
use Cake\TestSuite\IntegrationTestTrait;
use Cake\TestSuite\TestCase;
use Cake\ORM\TableRegistry;

/**
 * App\Controller\SelectedChemicalsController Test Case
 *
 * @uses \App\Controller\SelectedChemicalsController
 */
class SelectedChemicalsControllerTest extends TestCase
{
    use IntegrationTestTrait;

    /**
     * @var array
     */
    protected $fixtures = [
        'app.SelectedChemicals',
        'app.Chemicals',
        'app.Plans',
    ];
    
    /**
     * @var \App\Model\Table\SelectedchemicalsTable
     */
    protected $Selectedchemicals;

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

        $this->Selectedchemicals = TableRegistry::getTableLocator()->get('Selectedchemicals');
    }

    public function testBeforeFilter(): void
    {
        $this->get('/selectedchemicals');
        $this->assertResponseOk();
    }

    public function testIndex(): void
    {
        $this->get('/selectedchemicals');
        $this->assertResponseOk();
    }

    public function testView(): void
    {
        $this->get('/selectedchemicals/view/1');
        $this->assertResponseOk();
    }

    public function testAdd(): void
    {
        $this->get('/selectedchemicals');
        $this->assertResponseOk();
    }

    public function testEdit(): void
    {
        $this->get('/selectedchemicals/edit/1');
        $this->assertResponseOk();
    }

    public function testDelete(): void
    {
        $this->delete('/selectedchemicals/delete/1');
        $this->assertRedirect(['controller' => 'Selectedchemicals', 'action' => 'index']);
    }

    public function testAddPostData()
    {
        $this->markTestIncomplete('Not implemented yet.');

        /*
        $data = [];
        $this->post('/selectedchemicals/add', $data);

        $this->assertResponseSuccess();
        $selectedchemicals = TableRegistry::getTableLocator()->get('Selectedchemicals');
        $query = $selectedchemicals->find()->where(['' => $data['']]);
        $this->assertEquals(1, $query->count());
        */
    }

    public function testEditPostData()
    {
        $this->markTestIncomplete('Not implemented yet.');

        /*
        $data = [];
        $this->post('/selectedchemicals/edit/1', $data);

        $this->assertResponseSuccess();
        $selectedchemicals = TableRegistry::getTableLocator()->get('Selectedchemicals');
        $query = $selectedchemicals->find()->where(['' => $data['']]);
        $this->assertEquals(1, $query->count());
        */
    }
}
