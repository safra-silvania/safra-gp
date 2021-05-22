<?php
declare(strict_types=1);

namespace App\Test\TestCase\Model\Table;

use App\Model\Table\StatesTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\StatesTable Test Case
 */
class StatesTableTest extends TestCase
{
    /**
     * @var \App\Model\Table\StatesTable
     */
    protected $States;

    /**
     * @var array
     */
    protected $fixtures = [
        'app.States',
        'app.Cities',
    ];

    public function setUp(): void
    {
        parent::setUp();
        $config = TableRegistry::getTableLocator()->exists('States') ? [] : ['className' => StatesTable::class];
        $this->States = TableRegistry::getTableLocator()->get('States', $config);
    }

    public function tearDown(): void
    {
        unset($this->States);

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
