<?php
declare(strict_types=1);

namespace App\Test\TestCase\Model\Table;

use App\Model\Table\ProducersTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\ProducersTable Test Case
 */
class ProducersTableTest extends TestCase
{
    /**
     * @var \App\Model\Table\ProducersTable
     */
    protected $Producers;

    /**
     * @var array
     */
    protected $fixtures = [
        'app.Producers',
        'app.Cities',
        'app.Immobiles',
    ];

    public function setUp(): void
    {
        parent::setUp();
        $config = TableRegistry::getTableLocator()->exists('Producers') ? [] : ['className' => ProducersTable::class];
        $this->Producers = TableRegistry::getTableLocator()->get('Producers', $config);
    }

    public function tearDown(): void
    {
        unset($this->Producers);

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
