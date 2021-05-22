<?php
declare(strict_types=1);

namespace App\Test\TestCase\Model\Table;

use App\Model\Table\ZoningRegionsTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\ZoningRegionsTable Test Case
 */
class ZoningRegionsTableTest extends TestCase
{
    /**
     * @var \App\Model\Table\ZoningRegionsTable
     */
    protected $ZoningRegions;

    /**
     * @var array
     */
    protected $fixtures = [
        'app.ZoningRegions',
        'app.Seeds',
    ];

    public function setUp(): void
    {
        parent::setUp();
        $config = TableRegistry::getTableLocator()->exists('ZoningRegions') ? [] : ['className' => ZoningRegionsTable::class];
        $this->ZoningRegions = TableRegistry::getTableLocator()->get('ZoningRegions', $config);
    }

    public function tearDown(): void
    {
        unset($this->ZoningRegions);

        parent::tearDown();
    }

    public function testValidationDefault(): void
    {
        $this->markTestIncomplete('Not implemented yet.');
    }
}
