<?php
declare(strict_types=1);

namespace App\Test\TestCase\Controller;

use App\Controller\ApplicationSeasonsController;
use Cake\TestSuite\IntegrationTestTrait;
use Cake\TestSuite\TestCase;
use Cake\ORM\TableRegistry;

/**
 * App\Controller\ApplicationSeasonsController Test Case
 *
 * @uses \App\Controller\ApplicationSeasonsController
 */
class ApplicationSeasonsControllerTest extends TestCase
{
    use IntegrationTestTrait;

    /**
     * @var array
     */
    protected $fixtures = [
        'app.ApplicationSeasons',
        'app.Chemicals',
        'app.ChemicalsApplicationSeasons',
    ];
    
    /**
     * @var \App\Model\Table\ApplicationseasonsTable
     */
    protected $Applicationseasons;

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

        $this->Applicationseasons = TableRegistry::getTableLocator()->get('Applicationseasons');
    }

    public function testBeforeFilter(): void
    {
        $this->get('/applicationseasons');
        $this->assertResponseOk();
    }

    public function testIndex(): void
    {
        $this->get('/applicationseasons');
        $this->assertResponseOk();
    }

    public function testView(): void
    {
        $this->get('/applicationseasons/view/1');
        $this->assertResponseOk();
    }

    public function testAdd(): void
    {
        $this->get('/applicationseasons');
        $this->assertResponseOk();
    }

    public function testEdit(): void
    {
        $this->get('/applicationseasons/edit/1');
        $this->assertResponseOk();
    }

    public function testDelete(): void
    {
        $this->delete('/applicationseasons/delete/1');
        $this->assertRedirect(['controller' => 'Applicationseasons', 'action' => 'index']);
    }

    public function testAddPostData()
    {
        $this->markTestIncomplete('Not implemented yet.');

        /*
        $data = [];
        $this->post('/applicationseasons/add', $data);

        $this->assertResponseSuccess();
        $applicationseasons = TableRegistry::getTableLocator()->get('Applicationseasons');
        $query = $applicationseasons->find()->where(['' => $data['']]);
        $this->assertEquals(1, $query->count());
        */
    }

    public function testEditPostData()
    {
        $this->markTestIncomplete('Not implemented yet.');

        /*
        $data = [];
        $this->post('/applicationseasons/edit/1', $data);

        $this->assertResponseSuccess();
        $applicationseasons = TableRegistry::getTableLocator()->get('Applicationseasons');
        $query = $applicationseasons->find()->where(['' => $data['']]);
        $this->assertEquals(1, $query->count());
        */
    }
}
