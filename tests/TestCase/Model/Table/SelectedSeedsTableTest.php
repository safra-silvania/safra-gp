<?php
declare(strict_types=1);

namespace App\Test\TestCase\Model\Table;

use App\Model\Table\SelectedSeedsTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\SelectedSeedsTable Test Case
 */
class SelectedSeedsTableTest extends TestCase
{
    /**
     * @var \App\Model\Table\SelectedSeedsTable
     */
    protected $SelectedSeeds;

    /**
     * @var array
     */
    protected $fixtures = [
        'app.SelectedSeeds',
        'app.Seeds',
        'app.Plans',
        'app.PlanFieldDetails',
    ];

    public function setUp(): void
    {
        parent::setUp();
        $config = TableRegistry::getTableLocator()->exists('SelectedSeeds') ? [] : ['className' => SelectedSeedsTable::class];
        $this->SelectedSeeds = TableRegistry::getTableLocator()->get('SelectedSeeds', $config);
    }

    public function tearDown(): void
    {
        unset($this->SelectedSeeds);

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
