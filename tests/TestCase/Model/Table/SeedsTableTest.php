<?php
declare(strict_types=1);

namespace App\Test\TestCase\Model\Table;

use App\Model\Table\SeedsTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\SeedsTable Test Case
 */
class SeedsTableTest extends TestCase
{
    /**
     * @var \App\Model\Table\SeedsTable
     */
    protected $Seeds;

    /**
     * @var array
     */
    protected $fixtures = [
        'app.Seeds',
        'app.SeedNotes',
        'app.Cultures',
        'app.Varieties',
        'app.Technologies',
        'app.Cycles',
        'app.ZoningRegions',
        'app.ProductivePotencials',
        'app.Cities',
        'app.Suppliers',
        'app.Fertilities',
    ];

    public function setUp(): void
    {
        parent::setUp();
        $config = TableRegistry::getTableLocator()->exists('Seeds') ? [] : ['className' => SeedsTable::class];
        $this->Seeds = TableRegistry::getTableLocator()->get('Seeds', $config);
    }

    public function tearDown(): void
    {
        unset($this->Seeds);

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
