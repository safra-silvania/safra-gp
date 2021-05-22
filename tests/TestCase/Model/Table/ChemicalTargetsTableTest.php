<?php
declare(strict_types=1);

namespace App\Test\TestCase\Model\Table;

use App\Model\Table\ChemicalTargetsTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\ChemicalTargetsTable Test Case
 */
class ChemicalTargetsTableTest extends TestCase
{
    /**
     * @var \App\Model\Table\ChemicalTargetsTable
     */
    protected $ChemicalTargets;

    /**
     * @var array
     */
    protected $fixtures = [
        'app.ChemicalTargets',
        'app.Chemicals',
    ];

    public function setUp(): void
    {
        parent::setUp();
        $config = TableRegistry::getTableLocator()->exists('ChemicalTargets') ? [] : ['className' => ChemicalTargetsTable::class];
        $this->ChemicalTargets = TableRegistry::getTableLocator()->get('ChemicalTargets', $config);
    }

    public function tearDown(): void
    {
        unset($this->ChemicalTargets);

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
