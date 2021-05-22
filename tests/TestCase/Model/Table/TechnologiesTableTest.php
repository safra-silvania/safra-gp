<?php
declare(strict_types=1);

namespace App\Test\TestCase\Model\Table;

use App\Model\Table\TechnologiesTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\TechnologiesTable Test Case
 */
class TechnologiesTableTest extends TestCase
{
    /**
     * @var \App\Model\Table\TechnologiesTable
     */
    protected $Technologies;

    /**
     * @var array
     */
    protected $fixtures = [
        'app.Technologies',
        'app.Seeds',
    ];

    public function setUp(): void
    {
        parent::setUp();
        $config = TableRegistry::getTableLocator()->exists('Technologies') ? [] : ['className' => TechnologiesTable::class];
        $this->Technologies = TableRegistry::getTableLocator()->get('Technologies', $config);
    }

    public function tearDown(): void
    {
        unset($this->Technologies);

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
