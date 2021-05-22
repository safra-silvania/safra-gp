<?php
declare(strict_types=1);

namespace App\Test\TestCase\Model\Table;

use App\Model\Table\ChemicalClassesTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\ChemicalClassesTable Test Case
 */
class ChemicalClassesTableTest extends TestCase
{
    /**
     * @var \App\Model\Table\ChemicalClassesTable
     */
    protected $ChemicalClasses;

    /**
     * @var array
     */
    protected $fixtures = [
        'app.ChemicalClasses',
        'app.Chemicals',
    ];

    public function setUp(): void
    {
        parent::setUp();
        $config = TableRegistry::getTableLocator()->exists('ChemicalClasses') ? [] : ['className' => ChemicalClassesTable::class];
        $this->ChemicalClasses = TableRegistry::getTableLocator()->get('ChemicalClasses', $config);
    }

    public function tearDown(): void
    {
        unset($this->ChemicalClasses);

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
