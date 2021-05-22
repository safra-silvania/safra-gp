<?php
declare(strict_types=1);

namespace App\Test\TestCase\Controller;

use App\Controller\MeasureUnitsController;
use Cake\TestSuite\IntegrationTestTrait;
use Cake\TestSuite\TestCase;
use Cake\ORM\TableRegistry;

/**
 * App\Controller\MeasureUnitsController Test Case
 *
 * @uses \App\Controller\MeasureUnitsController
 */
class MeasureUnitsControllerTest extends TestCase
{
    use IntegrationTestTrait;

    /**
     * @var array
     */
    protected $fixtures = [
        'app.MeasureUnits',
        'app.Fields',
    ];
    
    /**
     * @var \App\Model\Table\MeasureunitsTable
     */
    protected $Measureunits;

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

        $this->Measureunits = TableRegistry::getTableLocator()->get('Measureunits');
    }

    public function testBeforeFilter(): void
    {
        $this->get('/measureunits');
        $this->assertResponseOk();
    }

    public function testIndex(): void
    {
        $this->get('/measureunits');
        $this->assertResponseOk();
    }

    public function testView(): void
    {
        $this->get('/measureunits/view/1');
        $this->assertResponseOk();
    }

    public function testAdd(): void
    {
        $this->get('/measureunits');
        $this->assertResponseOk();
    }

    public function testEdit(): void
    {
        $this->get('/measureunits/edit/1');
        $this->assertResponseOk();
    }

    public function testDelete(): void
    {
        $this->delete('/measureunits/delete/1');
        $this->assertRedirect(['controller' => 'Measureunits', 'action' => 'index']);
    }

    public function testAddPostData()
    {
        $data = [
            'name' => 'Lorem ipsum dolor sit amet',
            'initial' => 'Lorem ipsum dolor sit amet',
        ];
        $this->post('/measureunits/add', $data);

        $this->assertResponseSuccess();
        $measureunits = TableRegistry::getTableLocator()->get('Measureunits');
        $query = $measureunits->find()->where(['name' => $data['name']]);
        $this->assertEquals(1, $query->count());
    }

    public function testEditPostData()
    {
        $data = [
            'id' => 1,
            'name' => 'Lorem ipsum dolor sit amet',
            'initial' => 'Lorem ipsum dolor sit amet',
        ];
        $this->post('/measureunits/edit/1', $data);

        $this->assertResponseSuccess();
        $measureunits = TableRegistry::getTableLocator()->get('Measureunits');
        $query = $measureunits->find()->where(['id' => $data['id']]);
        $this->assertEquals(1, $query->count());
    }
}
