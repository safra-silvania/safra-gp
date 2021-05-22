<?php
declare(strict_types=1);

namespace App\Test\TestCase\Model\Table;

use App\Model\Table\ChemicalActionModesTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\ChemicalActionModesTable Test Case
 */
class ChemicalActionModesTableTest extends TestCase
{
    /**
     * @var \App\Model\Table\ChemicalActionModesTable
     */
    protected $ChemicalActionModes;

    /**
     * @var array
     */
    protected $fixtures = [
        'app.ChemicalActionModes',
        'app.Chemicals',
    ];

    public function setUp(): void
    {
        parent::setUp();
        $config = TableRegistry::getTableLocator()->exists('ChemicalActionModes') ? [] : ['className' => ChemicalActionModesTable::class];
        $this->ChemicalActionModes = TableRegistry::getTableLocator()->get('ChemicalActionModes', $config);
    }

    public function tearDown(): void
    {
        unset($this->ChemicalActionModes);

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
