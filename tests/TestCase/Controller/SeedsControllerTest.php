<?php
declare(strict_types=1);

namespace App\Test\TestCase\Controller;

use App\Controller\SeedsController;
use Cake\TestSuite\IntegrationTestTrait;
use Cake\TestSuite\TestCase;
use Cake\ORM\TableRegistry;

/**
 * App\Controller\SeedsController Test Case
 *
 * @uses \App\Controller\SeedsController
 */
class SeedsControllerTest extends TestCase
{
    use IntegrationTestTrait;

    /**
     * @var array
     */
    protected $fixtures = [
        'app.Seeds',
        'app.SeedNotes',
        'app.Cultures',
        'app.Varieties',
        'app.Technologies',
        'app.Cycles',
        'app.ZoningRegions',
        'app.ProductivePotencials',
        'app.Cities',
        'app.Suppliers',
        'app.Fertilities',
        'app.FertilitiesSeeds',
    ];
    
    /**
     * @var \App\Model\Table\SeedsTable
     */
    protected $Seeds;

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

        $this->Seeds = TableRegistry::getTableLocator()->get('Seeds');
    }

    public function testBeforeFilter(): void
    {
        $this->get('/seeds');
        $this->assertResponseOk();
    }

    public function testIndex(): void
    {
        $this->get('/seeds');
        $this->assertResponseOk();
    }

    public function testView(): void
    {
        $this->get('/seeds/view/1');
        $this->assertResponseOk();
    }

    public function testAdd(): void
    {
        $this->get('/seeds');
        $this->assertResponseOk();
    }

    public function testEdit(): void
    {
        $this->get('/seeds/edit/1');
        $this->assertResponseOk();
    }

    public function testDelete(): void
    {
        $this->delete('/seeds/delete/1');
        $this->assertRedirect(['controller' => 'Seeds', 'action' => 'index']);
    }

    public function testAddPostData()
    {
        $this->markTestIncomplete('Not implemented yet.');

        /*
        $data = [];
        $this->post('/seeds/add', $data);

        $this->assertResponseSuccess();
        $seeds = TableRegistry::getTableLocator()->get('Seeds');
        $query = $seeds->find()->where(['' => $data['']]);
        $this->assertEquals(1, $query->count());
        */
    }

    public function testEditPostData()
    {
        $this->markTestIncomplete('Not implemented yet.');

        /*
        $data = [];
        $this->post('/seeds/edit/1', $data);

        $this->assertResponseSuccess();
        $seeds = TableRegistry::getTableLocator()->get('Seeds');
        $query = $seeds->find()->where(['' => $data['']]);
        $this->assertEquals(1, $query->count());
        */
    }
}
