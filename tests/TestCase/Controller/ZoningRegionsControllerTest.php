<?php
declare(strict_types=1);

namespace App\Test\TestCase\Controller;

use App\Controller\ZoningRegionsController;
use Cake\TestSuite\IntegrationTestTrait;
use Cake\TestSuite\TestCase;
use Cake\ORM\TableRegistry;

/**
 * App\Controller\ZoningRegionsController Test Case
 *
 * @uses \App\Controller\ZoningRegionsController
 */
class ZoningRegionsControllerTest extends TestCase
{
    use IntegrationTestTrait;

    /**
     * @var array
     */
    protected $fixtures = [
        'app.ZoningRegions',
        'app.Seeds',
    ];
    
    /**
     * @var \App\Model\Table\ZoningregionsTable
     */
    protected $Zoningregions;

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

        $this->Zoningregions = TableRegistry::getTableLocator()->get('Zoningregions');
    }

    public function testBeforeFilter(): void
    {
        $this->get('/zoningregions');
        $this->assertResponseOk();
    }

    public function testIndex(): void
    {
        $this->get('/zoningregions');
        $this->assertResponseOk();
    }

    public function testView(): void
    {
        $this->get('/zoningregions/view/1');
        $this->assertResponseOk();
    }

    public function testAdd(): void
    {
        $this->get('/zoningregions');
        $this->assertResponseOk();
    }

    public function testEdit(): void
    {
        $this->get('/zoningregions/edit/1');
        $this->assertResponseOk();
    }

    public function testDelete(): void
    {
        $this->delete('/zoningregions/delete/1');
        $this->assertRedirect(['controller' => 'Zoningregions', 'action' => 'index']);
    }

    public function testAddPostData()
    {
        $this->markTestIncomplete('Not implemented yet.');

        /*
        $data = [];
        $this->post('/zoningregions/add', $data);

        $this->assertResponseSuccess();
        $zoningregions = TableRegistry::getTableLocator()->get('Zoningregions');
        $query = $zoningregions->find()->where(['' => $data['']]);
        $this->assertEquals(1, $query->count());
        */
    }

    public function testEditPostData()
    {
        $this->markTestIncomplete('Not implemented yet.');

        /*
        $data = [];
        $this->post('/zoningregions/edit/1', $data);

        $this->assertResponseSuccess();
        $zoningregions = TableRegistry::getTableLocator()->get('Zoningregions');
        $query = $zoningregions->find()->where(['' => $data['']]);
        $this->assertEquals(1, $query->count());
        */
    }
}
