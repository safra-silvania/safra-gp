<?php
declare(strict_types=1);

namespace App\Test\TestCase\Model\Table;

use App\Model\Table\ImmobilesTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\ImmobilesTable Test Case
 */
class ImmobilesTableTest extends TestCase
{
    /**
     * @var \App\Model\Table\ImmobilesTable
     */
    protected $Immobiles;

    /**
     * @var array
     */
    protected $fixtures = [
        'app.Immobiles',
        'app.Producers',
        'app.Cities',
        'app.Fields',
        'app.Plans',
    ];

    public function setUp(): void
    {
        parent::setUp();
        $config = TableRegistry::getTableLocator()->exists('Immobiles') ? [] : ['className' => ImmobilesTable::class];
        $this->Immobiles = TableRegistry::getTableLocator()->get('Immobiles', $config);
    }

    public function tearDown(): void
    {
        unset($this->Immobiles);

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
