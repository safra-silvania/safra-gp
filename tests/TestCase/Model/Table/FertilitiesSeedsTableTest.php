<?php
declare(strict_types=1);

namespace App\Test\TestCase\Model\Table;

use App\Model\Table\FertilitiesSeedsTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\FertilitiesSeedsTable Test Case
 */
class FertilitiesSeedsTableTest extends TestCase
{
    /**
     * @var \App\Model\Table\FertilitiesSeedsTable
     */
    protected $FertilitiesSeeds;

    /**
     * @var array
     */
    protected $fixtures = [
        'app.FertilitiesSeeds',
        'app.Seeds',
        'app.Fertilities',
    ];

    public function setUp(): void
    {
        parent::setUp();
        $config = TableRegistry::getTableLocator()->exists('FertilitiesSeeds') ? [] : ['className' => FertilitiesSeedsTable::class];
        $this->FertilitiesSeeds = TableRegistry::getTableLocator()->get('FertilitiesSeeds', $config);
    }

    public function tearDown(): void
    {
        unset($this->FertilitiesSeeds);

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
