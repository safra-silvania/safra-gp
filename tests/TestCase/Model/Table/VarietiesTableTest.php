<?php
declare(strict_types=1);

namespace App\Test\TestCase\Model\Table;

use App\Model\Table\VarietiesTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\VarietiesTable Test Case
 */
class VarietiesTableTest extends TestCase
{
    /**
     * @var \App\Model\Table\VarietiesTable
     */
    protected $Varieties;

    /**
     * @var array
     */
    protected $fixtures = [
        'app.Varieties',
        'app.Seeds',
    ];

    public function setUp(): void
    {
        parent::setUp();
        $config = TableRegistry::getTableLocator()->exists('Varieties') ? [] : ['className' => VarietiesTable::class];
        $this->Varieties = TableRegistry::getTableLocator()->get('Varieties', $config);
    }

    public function tearDown(): void
    {
        unset($this->Varieties);

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
