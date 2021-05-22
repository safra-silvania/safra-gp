<?php
declare(strict_types=1);

namespace App\Test\TestCase\Model\Table;

use App\Model\Table\ChemicalMeasureUnitsTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\ChemicalMeasureUnitsTable Test Case
 */
class ChemicalMeasureUnitsTableTest extends TestCase
{
    /**
     * @var \App\Model\Table\ChemicalMeasureUnitsTable
     */
    protected $ChemicalMeasureUnits;

    /**
     * @var array
     */
    protected $fixtures = [
        'app.ChemicalMeasureUnits',
        'app.Chemicals',
    ];

    public function setUp(): void
    {
        parent::setUp();
        $config = TableRegistry::getTableLocator()->exists('ChemicalMeasureUnits') ? [] : ['className' => ChemicalMeasureUnitsTable::class];
        $this->ChemicalMeasureUnits = TableRegistry::getTableLocator()->get('ChemicalMeasureUnits', $config);
    }

    public function tearDown(): void
    {
        unset($this->ChemicalMeasureUnits);

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
