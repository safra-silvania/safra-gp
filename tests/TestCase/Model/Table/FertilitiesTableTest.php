<?php
declare(strict_types=1);

namespace App\Test\TestCase\Model\Table;

use App\Model\Table\FertilitiesTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\FertilitiesTable Test Case
 */
class FertilitiesTableTest extends TestCase
{
    /**
     * @var \App\Model\Table\FertilitiesTable
     */
    protected $Fertilities;

    /**
     * @var array
     */
    protected $fixtures = [
        'app.Fertilities',
        'app.FieldDetails',
        'app.Fields',
        'app.Seeds',
    ];

    public function setUp(): void
    {
        parent::setUp();
        $config = TableRegistry::getTableLocator()->exists('Fertilities') ? [] : ['className' => FertilitiesTable::class];
        $this->Fertilities = TableRegistry::getTableLocator()->get('Fertilities', $config);
    }

    public function tearDown(): void
    {
        unset($this->Fertilities);

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
