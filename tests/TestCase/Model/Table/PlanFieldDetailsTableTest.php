<?php
declare(strict_types=1);

namespace App\Test\TestCase\Model\Table;

use App\Model\Table\PlanFieldDetailsTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\PlanFieldDetailsTable Test Case
 */
class PlanFieldDetailsTableTest extends TestCase
{
    /**
     * @var \App\Model\Table\PlanFieldDetailsTable
     */
    protected $PlanFieldDetails;

    /**
     * @var array
     */
    protected $fixtures = [
        'app.PlanFieldDetails',
        'app.FieldDetails',
        'app.Plans',
        'app.SelectedSeeds',
    ];

    public function setUp(): void
    {
        parent::setUp();
        $config = TableRegistry::getTableLocator()->exists('PlanFieldDetails') ? [] : ['className' => PlanFieldDetailsTable::class];
        $this->PlanFieldDetails = TableRegistry::getTableLocator()->get('PlanFieldDetails', $config);
    }

    public function tearDown(): void
    {
        unset($this->PlanFieldDetails);

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
