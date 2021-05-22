<?php
declare(strict_types=1);

namespace App\Test\TestCase\Model\Table;

use App\Model\Table\PlansTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\PlansTable Test Case
 */
class PlansTableTest extends TestCase
{
    /**
     * @var \App\Model\Table\PlansTable
     */
    protected $Plans;

    /**
     * @var array
     */
    protected $fixtures = [
        'app.Plans',
        'app.Immobiles',
        'app.PlanStatuses',
        'app.PlanFieldDetails',
        'app.SelectedChemicals',
        'app.SelectedFertilizers',
        'app.SelectedSeeds',
    ];

    public function setUp(): void
    {
        parent::setUp();
        $config = TableRegistry::getTableLocator()->exists('Plans') ? [] : ['className' => PlansTable::class];
        $this->Plans = TableRegistry::getTableLocator()->get('Plans', $config);
    }

    public function tearDown(): void
    {
        unset($this->Plans);

        parent::tearDown();
    }

    public function testValidationDefault(): void
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    public function testBuildRules(): void
    {
        $this->markTestIncomplete('Not implemented yet.');
    }
}
