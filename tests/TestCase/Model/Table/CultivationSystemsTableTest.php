<?php
declare(strict_types=1);

namespace App\Test\TestCase\Model\Table;

use App\Model\Table\CultivationSystemsTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\CultivationSystemsTable Test Case
 */
class CultivationSystemsTableTest extends TestCase
{
    /**
     * @var \App\Model\Table\CultivationSystemsTable
     */
    protected $CultivationSystems;

    /**
     * @var array
     */
    protected $fixtures = [
        'app.CultivationSystems',
        'app.Fields',
    ];

    public function setUp(): void
    {
        parent::setUp();
        $config = TableRegistry::getTableLocator()->exists('CultivationSystems') ? [] : ['className' => CultivationSystemsTable::class];
        $this->CultivationSystems = TableRegistry::getTableLocator()->get('CultivationSystems', $config);
    }

    public function tearDown(): void
    {
        unset($this->CultivationSystems);

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
