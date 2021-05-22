<?php
declare(strict_types=1);

namespace App\Test\TestCase\Model\Table;

use App\Model\Table\SelectedFertilizersTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\SelectedFertilizersTable Test Case
 */
class SelectedFertilizersTableTest extends TestCase
{
    /**
     * @var \App\Model\Table\SelectedFertilizersTable
     */
    protected $SelectedFertilizers;

    /**
     * @var array
     */
    protected $fixtures = [
        'app.SelectedFertilizers',
        'app.Fertilizers',
        'app.Plans',
    ];

    public function setUp(): void
    {
        parent::setUp();
        $config = TableRegistry::getTableLocator()->exists('SelectedFertilizers') ? [] : ['className' => SelectedFertilizersTable::class];
        $this->SelectedFertilizers = TableRegistry::getTableLocator()->get('SelectedFertilizers', $config);
    }

    public function tearDown(): void
    {
        unset($this->SelectedFertilizers);

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
