<?php
declare(strict_types=1);

namespace App\Test\TestCase\Model\Table;

use App\Model\Table\FertilizerMeasureUnitsTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\FertilizerMeasureUnitsTable Test Case
 */
class FertilizerMeasureUnitsTableTest extends TestCase
{
    /**
     * @var \App\Model\Table\FertilizerMeasureUnitsTable
     */
    protected $FertilizerMeasureUnits;

    /**
     * @var array
     */
    protected $fixtures = [
        'app.FertilizerMeasureUnits',
        'app.Fertilizers',
    ];

    public function setUp(): void
    {
        parent::setUp();
        $config = TableRegistry::getTableLocator()->exists('FertilizerMeasureUnits') ? [] : ['className' => FertilizerMeasureUnitsTable::class];
        $this->FertilizerMeasureUnits = TableRegistry::getTableLocator()->get('FertilizerMeasureUnits', $config);
    }

    public function tearDown(): void
    {
        unset($this->FertilizerMeasureUnits);

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
