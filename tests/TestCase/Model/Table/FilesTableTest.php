<?php
declare(strict_types=1);

namespace App\Test\TestCase\Model\Table;

use App\Model\Table\FilesTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\FilesTable Test Case
 */
class FilesTableTest extends TestCase
{
    /**
     * @var \App\Model\Table\FilesTable
     */
    protected $Files;

    /**
     * @var array
     */
    protected $fixtures = [
        'app.Files',
        'app.Sketches',
    ];

    public function setUp(): void
    {
        parent::setUp();
        $config = TableRegistry::getTableLocator()->exists('Files') ? [] : ['className' => FilesTable::class];
        $this->Files = TableRegistry::getTableLocator()->get('Files', $config);
    }

    public function tearDown(): void
    {
        unset($this->Files);

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
