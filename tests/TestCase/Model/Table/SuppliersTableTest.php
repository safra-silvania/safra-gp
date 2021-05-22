<?php
declare(strict_types=1);

namespace App\Test\TestCase\Model\Table;

use App\Model\Table\SuppliersTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\SuppliersTable Test Case
 */
class SuppliersTableTest extends TestCase
{
    /**
     * @var \App\Model\Table\SuppliersTable
     */
    protected $Suppliers;

    /**
     * @var array
     */
    protected $fixtures = [
        'app.Suppliers',
        'app.Cities',
        'app.Chemicals',
        'app.Fertilities',
        'app.Fertilizers',
        'app.Seeds',
        'app.SupplierTypes',
    ];

    public function setUp(): void
    {
        parent::setUp();
        $config = TableRegistry::getTableLocator()->exists('Suppliers') ? [] : ['className' => SuppliersTable::class];
        $this->Suppliers = TableRegistry::getTableLocator()->get('Suppliers', $config);
    }

    public function tearDown(): void
    {
        unset($this->Suppliers);

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
