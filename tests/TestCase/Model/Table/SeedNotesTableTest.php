<?php
declare(strict_types=1);

namespace App\Test\TestCase\Model\Table;

use App\Model\Table\SeedNotesTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\SeedNotesTable Test Case
 */
class SeedNotesTableTest extends TestCase
{
    /**
     * @var \App\Model\Table\SeedNotesTable
     */
    protected $SeedNotes;

    /**
     * @var array
     */
    protected $fixtures = [
        'app.SeedNotes',
        'app.Seeds',
    ];

    public function setUp(): void
    {
        parent::setUp();
        $config = TableRegistry::getTableLocator()->exists('SeedNotes') ? [] : ['className' => SeedNotesTable::class];
        $this->SeedNotes = TableRegistry::getTableLocator()->get('SeedNotes', $config);
    }

    public function tearDown(): void
    {
        unset($this->SeedNotes);

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
