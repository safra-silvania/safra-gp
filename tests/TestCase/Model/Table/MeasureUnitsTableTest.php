<?php
declare(strict_types=1);

namespace App\Test\TestCase\Model\Table;

use App\Model\Table\MeasureUnitsTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\MeasureUnitsTable Test Case
 */
class MeasureUnitsTableTest extends TestCase
{
    /**
     * @var \App\Model\Table\MeasureUnitsTable
     */
    protected $MeasureUnits;

    /**
     * @var array
     */
    protected $fixtures = [
        'app.MeasureUnits',
        'app.Fields',
    ];

    public function setUp(): void
    {
        parent::setUp();
        $config = TableRegistry::getTableLocator()->exists('MeasureUnits') ? [] : ['className' => MeasureUnitsTable::class];
        $this->MeasureUnits = TableRegistry::getTableLocator()->get('MeasureUnits', $config);
    }

    public function tearDown(): void
    {
        unset($this->MeasureUnits);

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
