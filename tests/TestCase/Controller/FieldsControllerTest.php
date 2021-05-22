<?php
declare(strict_types=1);

namespace App\Test\TestCase\Controller;

use App\Controller\FieldsController;
use Cake\TestSuite\IntegrationTestTrait;
use Cake\TestSuite\TestCase;
use Cake\ORM\TableRegistry;

/**
 * App\Controller\FieldsController Test Case
 *
 * @uses \App\Controller\FieldsController
 */
class FieldsControllerTest extends TestCase
{
    use IntegrationTestTrait;

    /**
     * @var array
     */
    protected $fixtures = [
        'app.Fields',
        'app.Immobiles',
        'app.MeasureUnits',
        'app.CultivationSystems',
        'app.Fertilities',
        'app.Cities',
        'app.FieldDetails',
        'app.PlanFields',
        'app.Sketches',
    ];
    
    /**
     * @var \App\Model\Table\FieldsTable
     */
    protected $Fields;

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

        $this->Fields = TableRegistry::getTableLocator()->get('Fields');
    }

    public function testBeforeFilter(): void
    {
        $this->get('/fields');
        $this->assertResponseOk();
    }

    public function testIndex(): void
    {
        $this->get('/fields');
        $this->assertResponseOk();
    }

    public function testView(): void
    {
        $this->get('/fields/view/1');
        $this->assertResponseOk();
    }

    public function testAdd(): void
    {
        $this->get('/fields');
        $this->assertResponseOk();
    }

    public function testEdit(): void
    {
        $this->get('/fields/edit/1');
        $this->assertResponseOk();
    }

    public function testDelete(): void
    {
        $this->delete('/fields/delete/1');
        $this->assertRedirect(['controller' => 'Fields', 'action' => 'index']);
    }

    public function testAddPostData()
    {
        $this->markTestIncomplete('Not implemented yet.');

        /*
        $data = [];
        $this->post('/fields/add', $data);

        $this->assertResponseSuccess();
        $fields = TableRegistry::getTableLocator()->get('Fields');
        $query = $fields->find()->where(['' => $data['']]);
        $this->assertEquals(1, $query->count());
        */
    }

    public function testEditPostData()
    {
        $this->markTestIncomplete('Not implemented yet.');

        /*
        $data = [];
        $this->post('/fields/edit/1', $data);

        $this->assertResponseSuccess();
        $fields = TableRegistry::getTableLocator()->get('Fields');
        $query = $fields->find()->where(['' => $data['']]);
        $this->assertEquals(1, $query->count());
        */
    }
}
