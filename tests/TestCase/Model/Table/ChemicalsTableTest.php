<?php
declare(strict_types=1);

namespace App\Test\TestCase\Model\Table;

use App\Model\Table\ChemicalsTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\ChemicalsTable Test Case
 */
class ChemicalsTableTest extends TestCase
{
    /**
     * @var \App\Model\Table\ChemicalsTable
     */
    protected $Chemicals;

    /**
     * @var array
     */
    protected $fixtures = [
        'app.Chemicals',
        'app.ChemicalNotes',
        'app.ChemicalClasses',
        'app.Suppliers',
        'app.ChemicalMeasureUnits',
        'app.ChemicalTargets',
        'app.ApplicationSeasons',
        'app.ChemicalActionModes',
        'app.Cultures',
    ];

    public function setUp(): void
    {
        parent::setUp();
        $config = TableRegistry::getTableLocator()->exists('Chemicals') ? [] : ['className' => ChemicalsTable::class];
        $this->Chemicals = TableRegistry::getTableLocator()->get('Chemicals', $config);
    }

    public function tearDown(): void
    {
        unset($this->Chemicals);

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
