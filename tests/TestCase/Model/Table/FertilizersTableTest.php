<?php
declare(strict_types=1);

namespace App\Test\TestCase\Model\Table;

use App\Model\Table\FertilizersTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\FertilizersTable Test Case
 */
class FertilizersTableTest extends TestCase
{
    /**
     * @var \App\Model\Table\FertilizersTable
     */
    protected $Fertilizers;

    /**
     * @var array
     */
    protected $fixtures = [
        'app.Fertilizers',
        'app.Suppliers',
        'app.FertilizerMeasureUnits',
    ];

    public function setUp(): void
    {
        parent::setUp();
        $config = TableRegistry::getTableLocator()->exists('Fertilizers') ? [] : ['className' => FertilizersTable::class];
        $this->Fertilizers = TableRegistry::getTableLocator()->get('Fertilizers', $config);
    }

    public function tearDown(): void
    {
        unset($this->Fertilizers);

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
