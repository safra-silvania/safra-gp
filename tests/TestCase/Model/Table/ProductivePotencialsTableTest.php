<?php
declare(strict_types=1);

namespace App\Test\TestCase\Model\Table;

use App\Model\Table\ProductivePotencialsTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\ProductivePotencialsTable Test Case
 */
class ProductivePotencialsTableTest extends TestCase
{
    /**
     * @var \App\Model\Table\ProductivePotencialsTable
     */
    protected $ProductivePotencials;

    /**
     * @var array
     */
    protected $fixtures = [
        'app.ProductivePotencials',
        'app.Seeds',
    ];

    public function setUp(): void
    {
        parent::setUp();
        $config = TableRegistry::getTableLocator()->exists('ProductivePotencials') ? [] : ['className' => ProductivePotencialsTable::class];
        $this->ProductivePotencials = TableRegistry::getTableLocator()->get('ProductivePotencials', $config);
    }

    public function tearDown(): void
    {
        unset($this->ProductivePotencials);

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
