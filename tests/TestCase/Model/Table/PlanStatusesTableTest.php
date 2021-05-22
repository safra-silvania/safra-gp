<?php
declare(strict_types=1);

namespace App\Test\TestCase\Model\Table;

use App\Model\Table\PlanStatusesTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\PlanStatusesTable Test Case
 */
class PlanStatusesTableTest extends TestCase
{
    /**
     * @var \App\Model\Table\PlanStatusesTable
     */
    protected $PlanStatuses;

    /**
     * @var array
     */
    protected $fixtures = [
        'app.PlanStatuses',
        'app.Plans',
    ];

    public function setUp(): void
    {
        parent::setUp();
        $config = TableRegistry::getTableLocator()->exists('PlanStatuses') ? [] : ['className' => PlanStatusesTable::class];
        $this->PlanStatuses = TableRegistry::getTableLocator()->get('PlanStatuses', $config);
    }

    public function tearDown(): void
    {
        unset($this->PlanStatuses);

        parent::tearDown();
    }

    public function testValidationDefault(): void
    {
        $this->markTestIncomplete('Not implemented yet.');
    }
}
