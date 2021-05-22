<?php
declare(strict_types=1);

namespace App\Test\TestCase\Controller;

use App\Controller\FertilizerMeasureUnitsController;
use Cake\TestSuite\IntegrationTestTrait;
use Cake\TestSuite\TestCase;
use Cake\ORM\TableRegistry;

/**
 * App\Controller\FertilizerMeasureUnitsController Test Case
 *
 * @uses \App\Controller\FertilizerMeasureUnitsController
 */
class FertilizerMeasureUnitsControllerTest extends TestCase
{
    use IntegrationTestTrait;

    /**
     * @var array
     */
    protected $fixtures = [
        'app.FertilizerMeasureUnits',
        'app.Fertilizers',
    ];
    
    /**
     * @var \App\Model\Table\FertilizermeasureunitsTable
     */
    protected $Fertilizermeasureunits;

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

        $this->Fertilizermeasureunits = TableRegistry::getTableLocator()->get('Fertilizermeasureunits');
    }

    public function testBeforeFilter(): void
    {
        $this->get('/fertilizermeasureunits');
        $this->assertResponseOk();
    }

    public function testIndex(): void
    {
        $this->get('/fertilizermeasureunits');
        $this->assertResponseOk();
    }

    public function testView(): void
    {
        $this->get('/fertilizermeasureunits/view/1');
        $this->assertResponseOk();
    }

    public function testAdd(): void
    {
        $this->get('/fertilizermeasureunits');
        $this->assertResponseOk();
    }

    public function testEdit(): void
    {
        $this->get('/fertilizermeasureunits/edit/1');
        $this->assertResponseOk();
    }

    public function testDelete(): void
    {
        $this->delete('/fertilizermeasureunits/delete/1');
        $this->assertRedirect(['controller' => 'Fertilizermeasureunits', 'action' => 'index']);
    }

    public function testAddPostData()
    {
        $this->markTestIncomplete('Not implemented yet.');

        /*
        $data = [];
        $this->post('/fertilizermeasureunits/add', $data);

        $this->assertResponseSuccess();
        $fertilizermeasureunits = TableRegistry::getTableLocator()->get('Fertilizermeasureunits');
        $query = $fertilizermeasureunits->find()->where(['' => $data['']]);
        $this->assertEquals(1, $query->count());
        */
    }

    public function testEditPostData()
    {
        $this->markTestIncomplete('Not implemented yet.');

        /*
        $data = [];
        $this->post('/fertilizermeasureunits/edit/1', $data);

        $this->assertResponseSuccess();
        $fertilizermeasureunits = TableRegistry::getTableLocator()->get('Fertilizermeasureunits');
        $query = $fertilizermeasureunits->find()->where(['' => $data['']]);
        $this->assertEquals(1, $query->count());
        */
    }
}
