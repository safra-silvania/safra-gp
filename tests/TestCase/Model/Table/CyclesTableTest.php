<?php
declare(strict_types=1);

namespace App\Test\TestCase\Model\Table;

use App\Model\Table\CyclesTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\CyclesTable Test Case
 */
class CyclesTableTest extends TestCase
{
    /**
     * @var \App\Model\Table\CyclesTable
     */
    protected $Cycles;

    /**
     * @var array
     */
    protected $fixtures = [
        'app.Cycles',
        'app.Seeds',
    ];

    public function setUp(): void
    {
        parent::setUp();
        $config = TableRegistry::getTableLocator()->exists('Cycles') ? [] : ['className' => CyclesTable::class];
        $this->Cycles = TableRegistry::getTableLocator()->get('Cycles', $config);
    }

    public function tearDown(): void
    {
        unset($this->Cycles);

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
