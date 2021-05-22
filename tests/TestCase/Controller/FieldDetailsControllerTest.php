<?php
declare(strict_types=1);

namespace App\Test\TestCase\Controller;

use App\Controller\FieldDetailsController;
use Cake\TestSuite\IntegrationTestTrait;
use Cake\TestSuite\TestCase;
use Cake\ORM\TableRegistry;

/**
 * App\Controller\FieldDetailsController Test Case
 *
 * @uses \App\Controller\FieldDetailsController
 */
class FieldDetailsControllerTest extends TestCase
{
    use IntegrationTestTrait;

    /**
     * @var array
     */
    protected $fixtures = [
        'app.FieldDetails',
        'app.Fields',
        'app.Cultures',
        'app.Fertilities',
        'app.MeasureUnits',
        'app.PlanFieldDetails',
    ];
    
    /**
     * @var \App\Model\Table\FielddetailsTable
     */
    protected $Fielddetails;

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

        $this->Fielddetails = TableRegistry::getTableLocator()->get('Fielddetails');
    }

    public function testBeforeFilter(): void
    {
        $this->get('/fielddetails');
        $this->assertResponseOk();
    }

    public function testIndex(): void
    {
        $this->get('/fielddetails');
        $this->assertResponseOk();
    }

    public function testView(): void
    {
        $this->get('/fielddetails/view/1');
        $this->assertResponseOk();
    }

    public function testAdd(): void
    {
        $this->get('/fielddetails');
        $this->assertResponseOk();
    }

    public function testEdit(): void
    {
        $this->get('/fielddetails/edit/1');
        $this->assertResponseOk();
    }

    public function testDelete(): void
    {
        $this->delete('/fielddetails/delete/1');
        $this->assertRedirect(['controller' => 'Fielddetails', 'action' => 'index']);
    }

    public function testAddPostData()
    {
        $this->markTestIncomplete('Not implemented yet.');

        /*
        $data = [];
        $this->post('/fielddetails/add', $data);

        $this->assertResponseSuccess();
        $fielddetails = TableRegistry::getTableLocator()->get('Fielddetails');
        $query = $fielddetails->find()->where(['' => $data['']]);
        $this->assertEquals(1, $query->count());
        */
    }

    public function testEditPostData()
    {
        $this->markTestIncomplete('Not implemented yet.');

        /*
        $data = [];
        $this->post('/fielddetails/edit/1', $data);

        $this->assertResponseSuccess();
        $fielddetails = TableRegistry::getTableLocator()->get('Fielddetails');
        $query = $fielddetails->find()->where(['' => $data['']]);
        $this->assertEquals(1, $query->count());
        */
    }
}
