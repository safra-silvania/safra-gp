<?php
declare(strict_types=1);

namespace App\Test\TestCase\Model\Table;

use App\Model\Table\ChemicalGroupsTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\ChemicalGroupsTable Test Case
 */
class ChemicalGroupsTableTest extends TestCase
{
    /**
     * @var \App\Model\Table\ChemicalGroupsTable
     */
    protected $ChemicalGroups;

    /**
     * @var array
     */
    protected $fixtures = [
        'app.ChemicalGroups',
    ];

    public function setUp(): void
    {
        parent::setUp();
        $config = TableRegistry::getTableLocator()->exists('ChemicalGroups') ? [] : ['className' => ChemicalGroupsTable::class];
        $this->ChemicalGroups = TableRegistry::getTableLocator()->get('ChemicalGroups', $config);
    }

    public function tearDown(): void
    {
        unset($this->ChemicalGroups);

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
